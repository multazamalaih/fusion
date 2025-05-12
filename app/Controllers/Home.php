<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\LapanganModel;
use App\Models\FasilitasModel;
use App\Models\JamOperasionalModel;
use App\Models\FotoModel;
use App\Models\HasilModel;
use App\Models\KontakModel;
use App\Models\UlasanModel;
use App\Models\KriteriaAhpModel;
use App\Models\Users;
use App\Models\PenilaianModel;
use App\Models\PesanModel;
use App\Models\RekomendasiModel;

class Home extends BaseController
{
    protected $kriteriaModel;
    protected $lapanganModel;
    protected $fotoLapanganModel;
    protected $fasilitasModel;
    protected $jamOperasionalModel;
    protected $kriteriaAhpModel;
    protected $hasilModel;
    protected $kontakModel;
    protected $ulasanModel;
    protected $userModel;
    protected $penilaianModel;
    protected $pesanModel;
    protected $rekomendasiModel;
    protected $helpers = ['form'];

    public function __construct()

    {
        $this->kriteriaModel = new KriteriaModel();
        $this->lapanganModel = new LapanganModel();
        $this->fotoLapanganModel = new FotoModel();
        $this->fasilitasModel = new FasilitasModel();
        $this->jamOperasionalModel = new JamOperasionalModel();
        $this->kriteriaAhpModel = new KriteriaAhpModel();
        $this->hasilModel = new HasilModel();
        $this->kontakModel = new KontakModel();
        $this->ulasanModel = new UlasanModel();
        $this->userModel = new Users();
        $this->penilaianModel = new PenilaianModel();
        $this->pesanModel = new PesanModel();
        $this->rekomendasiModel = new RekomendasiModel();
    }

    public function index(): string
    {
        $userSession = session()->get('user');
        $kriteria = $this->kriteriaModel->orderBy('bobot', 'DESC')->limit(3)->find();
        $lapanganList = $this->lapanganModel->select('id_lapangan, nama, latitude, longitude')->findAll();
        $lapanganterbaik = $this->lapanganModel->select('lapangan.*, hasil.nilai, foto_lapangan.file AS foto')
            ->join('hasil', 'hasil.id_lapangan = lapangan.id_lapangan')
            ->join('foto_lapangan', 'foto_lapangan.id_lapangan = lapangan.id_lapangan AND foto_lapangan.jenis_foto = "Lapangan"', 'left')
            ->orderBy('hasil.nilai', 'DESC')->limit(4)->findAll();
        $ulasan = $this->ulasanModel->join('lapangan', 'lapangan.id_lapangan = ulasan.id_lapangan')->select('ulasan.ulasan, ulasan.nama as nama_manajemen, lapangan.nama as nama')->findAll();
        $kontak = $this->kontakModel->first();
        $data = [
            'isLogin' => $userSession ? true : false,
            'kriteriaTerbaik' => $kriteria,
            'ulasan' => $ulasan,
            'kontak' => $kontak,
            'lapanganList' => $lapanganList,
            'lapanganTerbaik' => $lapanganterbaik
        ];
        return view('pages/home', $data);
    }

    public function hasilRekomendasi()
    {
        $hasil = $this->hasilModel->join('lapangan', 'lapangan.id_lapangan = hasil.id_lapangan')->orderBy('nilai', 'DESC')->findAll();
        $lapangan = $this->fotoLapanganModel->where('id_lapangan', $hasil[0]['id_lapangan'])->where('jenis_foto', 'Lapangan')->first();
        $kriteria = $this->kriteriaModel->orderBy('bobot', 'DESC')->findAll();
        return view('pages/hasil-rekomendasi', [
            'data' => $hasil,
            'lapangan' => $lapangan,
            'dataKriteria' => $kriteria,
        ]);
    }

    public function cetakHasilRekomendasi()

    {
        $hasil = $this->hasilModel->join('lapangan', 'lapangan.id_lapangan = hasil.id_lapangan')->orderBy('nilai', 'DESC')->findAll();
        return view('pages/cetak-rekomendasi', [
            'data' => $hasil,
        ]);
    }

    public function cariLapangan()
    {
        $kriteria = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();
        $inputUser = session()->getFlashdata('nilai_input_sementara') ?? [];
        $hasilAhp = session()->getFlashdata('hasil_ahp');
        $error = session()->getFlashdata('error');

        return view('pages/cari-lapangan', [
            'kriteria' => $kriteria,
            'inputUser' => $inputUser,
            'hasil_ahp' => $hasilAhp,
            'error' => $error
        ]);
    }


    public function hasilPerhitungan()
    {
        $kriteria = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();
        [$matrik, $inputUser] = $this->buatMatrikDariInput($kriteria);
        $hasilAhp = $this->hitungAhp($matrik);

        // Validasi CR
        if ($hasilAhp['cr'] > 0.1) {
            session()->setFlashdata('nilai_input_sementara', $inputUser);
            session()->setFlashdata('hasil_ahp', $hasilAhp);
            session()->setFlashdata('error', 'Data tidak konsisten (CR > 0.1). Silakan perbaiki.');

            return redirect()->to(base_url('cari-lapangan'));
        }

        // Ambil data penilaian lapangan
        $penilaian = $this->penilaianModel
            ->join('lapangan', 'lapangan.id_lapangan = penilaian.id_lapangan')
            ->orderBy('lapangan.nama')
            ->findAll();
        $tipe = array_column($kriteria, 'tipe');
        $hasilTopsis = $this->hitungTopsis($penilaian, $hasilAhp['prioritas'], $tipe);
        $lapangan = $this->lapanganModel
            ->select('lapangan.*, foto_lapangan.file')
            ->join('foto_lapangan', 'foto_lapangan.id_lapangan = lapangan.id_lapangan AND foto_lapangan.jenis_foto = "Lapangan"', 'left')
            ->where('lapangan.id_lapangan', $hasilTopsis[0]['id_lapangan'])
            ->first();
        // Format ulang data kriteria
        $dataKriteria = [];
        foreach ($kriteria as $i => $k) {
            $dataKriteria[] = [
                'nama' => $k['nama'],
                'tipe' => $k['tipe'],
                'bobot' => $hasilAhp['prioritas'][$i],
            ];
        }

        return view('pages/hasil-perhitungan', [
            'data' => $hasilTopsis,
            'lapangan' => $lapangan,
            'dataKriteria' => $dataKriteria,
        ]);
    }

    private function buatMatrikDariInput($kriteria)
    {
        $matrik = [];
        $input_user = [];

        foreach ($kriteria as $i => $k1) {
            foreach ($kriteria as $j => $k2) {
                if ($i == $j) {
                    $matrik[$i][$j] = 1;
                } elseif ($i < $j) {
                    $inputName = 'nilai_' . $k1['id_kriteria'] . '_' . $k2['id_kriteria'];
                    $nilai = $this->request->getPost($inputName);

                    if ($nilai !== null) {
                        $nilai = (float)$nilai;

                        if ($nilai < 0) {
                            $nilai1 = round(1 / abs($nilai), 5); // nilai k1 terhadap k2
                            $nilai2 = abs($nilai);               // nilai k2 terhadap k1
                        } elseif ($nilai > 0) {
                            $nilai1 = abs($nilai);
                            $nilai2 = round(1 / abs($nilai), 5);
                        } else {
                            $nilai1 = $nilai2 = 1;
                        }


                        $matrik[$i][$j] = $nilai1;
                        $matrik[$j][$i] = $nilai2;

                        $input_user[$k1['id_kriteria']][$k2['id_kriteria']] = $nilai;
                    }
                }
            }
        }

        return [$matrik, $input_user];
    }
    private function hitungAhp($matrik)
    {
        $n = count($matrik);

        // Jumlah tiap kolom
        $jumlahKolom = [];
        for ($j = 0; $j < $n; $j++) {
            $jumlahKolom[$j] = array_sum(array_column($matrik, $j));
        }

        // Normalisasi & bobot prioritas
        $normalisasi = [];
        $prioritas = [];
        for ($i = 0; $i < $n; $i++) {
            $total = 0;
            for ($j = 0; $j < $n; $j++) {
                $val = $matrik[$i][$j] / $jumlahKolom[$j];
                $normalisasi[$i][$j] = round($val, 5);
                $total += $val;
            }
            $prioritas[$i] = round($total / $n, 5);
        }

        // Matriks terbobot & jumlah baris
        $matrikBaris = [];
        $jumlahBaris = [];
        for ($i = 0; $i < $n; $i++) {
            $jumlahBaris[$i] = 0;
            for ($j = 0; $j < $n; $j++) {
                $matrikBaris[$i][$j] = round($matrik[$i][$j] * $prioritas[$j], 5);
                $jumlahBaris[$i] += $matrikBaris[$i][$j];
            }
        }

        // Konsistensi
        $hasilKonsistensi = [];
        $lambda = 0;
        for ($i = 0; $i < $n; $i++) {
            $hasilKonsistensi[$i] = round($jumlahBaris[$i] / $prioritas[$i], 5);
            $lambda += $hasilKonsistensi[$i];
        }

        $lambdaMax = $lambda / $n;
        $ci = ($lambdaMax - $n) / ($n - 1);
        $ir = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49]; // RI untuk n = 1 s/d 10
        $cr = ($n <= 10) ? round($ci / $ir[$n - 1], 5) : 0;

        return compact(
            'matrik',
            'jumlahKolom',
            'normalisasi',
            'prioritas',
            'matrikBaris',
            'jumlahBaris',
            'hasilKonsistensi',
            'lambdaMax',
            'ci',
            'cr',
            'ir'
        );
    }
    private function hitungTopsis($data, $bobot, $tipeKriteria = [])
    {
        $matriks = [];
        $lapanganList = [];

        // Susun matriks keputusan dari data penilaian
        foreach ($data as $row) {
            $id = $row['id_lapangan'];
            $k = $row['id_kriteria'];
            $v = $row['nilai'];

            $matriks[$id][$k] = $v;
            $lapanganList[$id] = $row['nama'];
        }

        // Normalisasi matriks
        $pembagi = [];
        foreach ($matriks as $alt) {
            foreach ($alt as $id_kriteria => $nilai) {
                $pembagi[$id_kriteria] = isset($pembagi[$id_kriteria])
                    ? $pembagi[$id_kriteria] + pow($nilai, 2)
                    : pow($nilai, 2);
            }
        }
        foreach ($pembagi as $id => $val) {
            $pembagi[$id] = sqrt($val);
        }

        $normalisasi = [];
        foreach ($matriks as $id_lapangan => $alt) {
            foreach ($alt as $id_kriteria => $nilai) {
                $normalisasi[$id_lapangan][$id_kriteria] = $nilai / $pembagi[$id_kriteria];
            }
        }

        // Matriks terbobot
        $terbobot = [];
        foreach ($normalisasi as $id_lapangan => $alt) {
            foreach ($alt as $id_kriteria => $nilai) {
                $terbobot[$id_lapangan][$id_kriteria] = $nilai * ($bobot[$id_kriteria] ?? 0);
            }
        }

        // Solusi ideal positif dan negatif
        $idealPositif = [];
        $idealNegatif = [];

        foreach (array_keys($bobot) as $id_kriteria) {
            $kolom = array_column($terbobot, $id_kriteria);
            if (!empty($kolom)) {
                if (($tipeKriteria[$id_kriteria] ?? 'Benefit') === 'Cost') {
                    $idealPositif[] = min($kolom);
                    $idealNegatif[] = max($kolom);
                } else {
                    $idealPositif[] = max($kolom);
                    $idealNegatif[] = min($kolom);
                }
            } else {
                $idealPositif[] = 0;
                $idealNegatif[] = 0;
            }
        }

        // Hitung nilai preferensi tiap alternatif
        $hasil = [];
        foreach ($terbobot as $id_lapangan => $nilai) {
            $d_plus = 0;
            $d_min = 0;

            foreach (array_keys($bobot) as $i => $id_kriteria) {
                $val = $nilai[$id_kriteria] ?? 0;
                $d_plus += pow($val - $idealPositif[$i], 2);
                $d_min += pow($val - $idealNegatif[$i], 2);
            }

            $d_plus = sqrt($d_plus);
            $d_min = sqrt($d_min);
            $preferensi = $d_min / ($d_min + $d_plus);

            $hasil[] = [
                'id_lapangan' => $id_lapangan,
                'nama' => $lapanganList[$id_lapangan],
                'nilai' => round($preferensi, 5),
            ];
        }

        // Urutkan berdasarkan nilai preferensi (descending)
        usort($hasil, fn($a, $b) => $b['nilai'] <=> $a['nilai']);

        // Tambahkan peringkat
        foreach ($hasil as $i => &$row) {
            $row['peringkat'] = $i + 1;
        }

        return $hasil;
    }




    public function cetakHasilPerhitungan()
    {
        return view('pages/cetak-hasil');
    }

    // Akses default, tab pertama aktif
    public function daftarKriteria()
    {
        $kriteria = $this->kriteriaModel->findAll();

        return view('pages/daftar-kriteria', [
            'kriteria' => $kriteria
        ]);
    }
    public function daftarLapanganFutsal()
    {
        $perPage = 8;
        $cari = $this->request->getVar('cari');
        $urutan = $this->request->getVar('urutan');

        $dataLapangan = $this->lapanganModel
            ->select('lapangan.*, hasil.nilai, foto_lapangan.file AS foto')
            ->join('hasil', 'hasil.id_lapangan = lapangan.id_lapangan', 'left')
            ->join('foto_lapangan', 'foto_lapangan.id_lapangan = lapangan.id_lapangan AND foto_lapangan.jenis_foto = "Lapangan"', 'left');

        if ($cari) {
            $dataLapangan->like('lapangan.nama', $cari);
        }

        switch ($urutan) {
            case 'harga termurah':
                $dataLapangan->orderBy('lapangan.harga', 'ASC');
                break;
            case 'harga termahal':
                $dataLapangan->orderBy('lapangan.harga', 'DESC');
                break;
            case 'nilai tertinggi':
                $dataLapangan->orderBy('hasil.nilai', 'DESC');
                break;
            case 'nilai terendah':
                $dataLapangan->orderBy('hasil.nilai', 'ASC');
                break;
            default:
                $dataLapangan->orderBy('lapangan.nama', 'ASC');
                break;
        }

        $lapangan = $dataLapangan->paginate($perPage, 'lapangan');
        $pager = $dataLapangan->pager;
        $page = $pager->getCurrentPage('lapangan');
        $start = ($page - 1) * $perPage + 1;
        $end = $start + count($lapangan) - 1;
        $total = $pager->getTotal('lapangan');

        $data = [
            'lapangan' => $lapangan,
            'pager' => $pager,
            'start' => $start,
            'end' => $end,
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page,
            'cari' => $cari,
            'urutan' => $urutan,
        ];

        return view('pages/daftar-lapangan-futsal', $data);
    }

    public function detailLapanganFutsal($id_lapangan)
    {
        $lapangan = $this->lapanganModel->find($id_lapangan);
        $foto = $this->fotoLapanganModel->where('id_lapangan', $id_lapangan)->findAll();
        $fasilitas = $this->fasilitasModel->where('id_lapangan', $id_lapangan)->findAll();
        $jamOperasional = $this->jamOperasionalModel->where('id_lapangan', $id_lapangan)
            ->orderBy('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")')->findAll();
        $data = [
            'lapangan' => $lapangan,
            'foto' => $foto,
            'fasilitas' => $fasilitas,
            'jamOperasional' => $jamOperasional,
        ];
        return view('pages/detail-lapangan-futsal', $data);
    }

    public function Rekomendasikan()
    {
        return view('pages/rekomendasikan');
    }
    public function RekomendasikanProses()
    {
        $user = getUser();
        if (!$user) {
            return redirect()->to(base_url('/login'))->with('error', 'Login terlebih dahulu');
        }
        $jenis_rekomendasi = $this->request->getVar('jenis_rekomendasi');
        $nama_rekomendasi = $this->request->getVar('nama_rekomendasi');
        $keterangan = $this->request->getVar('keterangan');
        if (!$this->validate([
            'jenis_rekomendasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis rekomendasi tidak boleh kosong'
                ]
            ],
            'nama_rekomendasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama rekomendasi tidak boleh kosong'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/rekomendasikan'))->withInput();
        }
        $this->rekomendasiModel->save([
            'id_user' => $user['id_user'],
            'nama_rekomendasi' => $nama_rekomendasi,
            'jenis_rekomendasi' => $jenis_rekomendasi,
            'keterangan' => $keterangan,
        ]);
        return redirect()->to(base_url('/rekomendasikan'));
    }
    public function tentangKami()
    {
        return view('pages/tentang-kami');
    }
    public function kontakKami()
    {
        return view('pages/kontak-kami');
    }
    public function kontakKamiProses()
    {
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $pesan = $this->request->getVar('pesan');
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'min_length' => 'Nama minimal 3 karakter'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'pesan' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Pesan tidak boleh kosong',
                    'min_length' => 'Pesan minimal 10 karakter'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/kontak-kami'))->withInput();
        }

        $this->pesanModel->save([
            'nama' => $nama,
            'email' => $email,
            'pesan' => $pesan,
        ]);
        return redirect()->to(base_url('/kontak-kami'))->with('success', 'Berhasil mengirim pesan');
    }
    public function Profil()
    {
        $user = getUser();
        if (!$user) {
            return redirect()->to(base_url('/login'));
        }
        return view('pages/profil', [
            'user' => $user,
        ]);
    }
    public function updateProfil()
    {
        $user =  getUser();
        if (!$user) {
            return redirect()->to(base_url('/login'));
        }
        $userDatabase = $this->userModel->find($user['id_user']);
        $username = $this->request->getVar('nama');
        $passwordLama = $this->request->getVar('passwordLama');
        $passwordBaru = $this->request->getVar('passwordBaru');
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ]
        ];
        if (!empty($passwordLama) && !empty($passwordBaru)) {
            $rules['konfirmasi'] = [
                'rules' => 'required|matches[passwordBaru]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong',
                    'matches' => 'Password tidak sama'
                ]
            ];
            if (password_verify($passwordLama, $userDatabase['password'])) {
                $rules['passwordBaru'] = [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Password tidak boleh kosong',
                        'min_length' => 'Password minimal 8 karakter'
                    ]
                ];
            } else {
                return redirect()->to(base_url('/profil'))->withInput()->with('error', 'Password lama tidak sesuai');
            }
        }
        if (!$this->validate($rules)) {
            return redirect()->to(base_url('/profil'))->withInput();
        }
        $dataUser = [
            'id_user' => $user['id_user'],
            'nama' => $username,
        ];
        if (!empty($passwordLama) && !empty($passwordBaru)) {
            $dataUser['password'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }
        $userSession = [
            "id_user" => $user["id_user"],
            "nama" => $username,
            "email" => $user["email"],
            "role" => $user["role"],
        ];
        session()->set('user', $userSession);
        $this->userModel->save($dataUser);
        return redirect()->to(base_url('/profil'))->with('success', 'Berhasil update profil');
    }
}
