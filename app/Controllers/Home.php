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
        // Ambil semua kriteria untuk ditampilkan di form
        $kriteria = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();

        // Ambil input user sebelumnya (jika ada), hasil AHP sementara, dan error konsistensi
        $inputUser = session()->getFlashdata('nilai_input_sementara') ?? [];
        $hasilAhp = session()->getFlashdata('hasil_ahp') ?? [];
        $error = session()->getFlashdata('error');

        // Kirim ke view
        return view('pages/cari-lapangan', [
            'kriteria' => $kriteria,
            'inputUser' => $inputUser,
            'hasil_ahp' => $hasilAhp,
            'error' => $error,
        ]);
    }

    public function hasilPerhitungan()
    {
        // Ambil kriteria dari database
        $kriteria = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();

        // Bentuk matriks perbandingan AHP dari input user
        [$matrik, $inputUser] = $this->buatMatrikDariInput($kriteria);

        // Hitung hasil AHP
        $hasilAhp = $this->hitungAhp($matrik);
        $user = getUser();
        if (!$user) {
            return redirect()->to(base_url('/login'))->with('error', 'Silahkan login terlebih dahulu');
        }

        // Cek konsistensi
        if ($hasilAhp['cr'] > 0.1) {
            session()->setFlashdata('nilai_input_sementara', $inputUser);
            session()->setFlashdata('hasil_ahp', $hasilAhp);
            session()->setFlashdata('error', 'Data tidak konsisten (CR > 0.1). Silahkan perbaiki nilai perbandingan.');
            return redirect()->to(base_url('cari-lapangan'));
        }


        // Konversi bobot AHP (numerik) ke format [id_kriteria => bobot]
        $bobot = [];
        $tipe = [];
        foreach ($kriteria as $i => $k) {
            $bobot[$k['id_kriteria']] = $hasilAhp['prioritas'][$i];
            $tipe[$k['id_kriteria']] = $k['tipe'];
        }

        // Ambil nilai penilaian lapangan dari database
        $penilaian = $this->penilaianModel
            ->join('lapangan', 'lapangan.id_lapangan = penilaian.id_lapangan')
            ->orderBy('penilaian.id_lapangan')
            ->orderBy('penilaian.id_kriteria')
            ->findAll();

        // Jalankan perhitungan TOPSIS berdasarkan bobot user
        $hasilTopsis = $this->hitungTopsis($penilaian, $bobot, $tipe);

        // Ambil lapangan terbaik dari hasil ranking
        $lapangan = $this->lapanganModel
            ->select('lapangan.*, foto_lapangan.file')
            ->join('foto_lapangan', 'foto_lapangan.id_lapangan = lapangan.id_lapangan AND foto_lapangan.jenis_foto = "Lapangan"', 'left')
            ->where('lapangan.id_lapangan', $hasilTopsis[0]['id_lapangan'])->first();

        // Format ulang bobot untuk tabel view
        $dataKriteria = [];
        foreach ($kriteria as $k) {
            $dataKriteria[] = [
                'nama' => $k['nama'],
                'tipe' => $k['tipe'],
                'bobot' => $bobot[$k['id_kriteria']],
            ];
        }

        usort($dataKriteria, function ($a, $b) {
            return $b['bobot'] <=> $a['bobot'];
        });

        session()->set('hasil_ahp', $hasilAhp); // untuk halaman cetak
        session()->set('data_topsis', $hasilTopsis);
        session()->setFlashdata('successHitung', 'Perhitungan berhasil dilakukan!');



        // Tampilkan hasil ke halaman view
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
        $idKriteria = array_column($kriteria, 'id_kriteria');
        $n = count($idKriteria);

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i == $j) {
                    $matrik[$i][$j] = 1;
                } elseif ($i < $j) {
                    $inputName = 'nilai_' . $idKriteria[$i] . '_' . $idKriteria[$j];
                    $nilai = $this->request->getPost($inputName);

                    if ($nilai !== null) {
                        $nilai = (float)$nilai;

                        if ($nilai < 0) {
                            $nilai1 = round(1 / abs($nilai), 5);
                            $nilai2 = abs($nilai);
                        } elseif ($nilai > 0) {
                            $nilai1 = abs($nilai);
                            $nilai2 = round(1 / abs($nilai), 5);
                        } else {
                            $nilai1 = $nilai2 = 1;
                        }

                        $matrik[$i][$j] = $nilai1;
                        $matrik[$j][$i] = $nilai2;

                        $input_user[$idKriteria[$i]][$idKriteria[$j]] = $nilai;
                    }
                }
            }
        }

        return [$matrik, $input_user];
    }

    private function hitungAhp(array $matrik)
    {
        $n = count($matrik);

        // Jumlah kolom
        $jumlahKolom = [];
        for ($j = 0; $j < $n; $j++) {
            $jumlahKolom[$j] = array_sum(array_column($matrik, $j));
        }

        // Normalisasi & prioritas
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

        // Matriks terbobot
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
        $ir = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
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

    private function hitungTopsis(array $data, array $bobot, array $tipeKriteria = [])
    {
        $matriks = [];
        $lapanganList = [];

        // Susun matriks keputusan
        foreach ($data as $row) {
            $idLapangan = $row['id_lapangan'];
            $idKriteria = $row['id_kriteria'];
            $nilai = (float) $row['nilai'];

            $matriks[$idLapangan][$idKriteria] = $nilai;
            $lapanganList[$idLapangan] = $row['nama'];
        }

        // Hitung penyebut normalisasi (akar jumlah kuadrat per kriteria)
        $pembagi = [];
        foreach ($matriks as $alt) {
            foreach ($alt as $idKriteria => $nilai) {
                $pembagi[$idKriteria] = isset($pembagi[$idKriteria])
                    ? $pembagi[$idKriteria] + pow($nilai, 2)
                    : pow($nilai, 2);
            }
        }
        foreach ($pembagi as $id => $val) {
            $pembagi[$id] = round(sqrt($val), 5);
        }

        // Matriks normalisasi (R)
        $normalisasi = [];
        foreach ($matriks as $idLapangan => $alt) {
            foreach ($alt as $idKriteria => $nilai) {
                $normalisasi[$idLapangan][$idKriteria] = round($nilai / $pembagi[$idKriteria], 5);
            }
        }

        // Matriks normalisasi terbobot (Y)
        $terbobot = [];
        foreach ($normalisasi as $idLapangan => $alt) {
            foreach ($alt as $idKriteria => $nilai) {
                $terbobot[$idLapangan][$idKriteria] = round($nilai * ($bobot[$idKriteria] ?? 0), 5);
            }
        }

        // Solusi ideal positif dan negatif
        $idealPositif = [];
        $idealNegatif = [];

        foreach (array_keys($bobot) as $idKriteria) {
            $kolom = array_column($terbobot, $idKriteria);

            if (($tipeKriteria[$idKriteria] ?? 'Benefit') === 'Cost') {
                $idealPositif[$idKriteria] = round(min($kolom), 5);
                $idealNegatif[$idKriteria] = round(max($kolom), 5);
            } else {
                $idealPositif[$idKriteria] = round(max($kolom), 5);
                $idealNegatif[$idKriteria] = round(min($kolom), 5);
            }
        }

        // Hitung preferensi
        $hasil = [];
        foreach ($terbobot as $idLapangan => $alt) {
            $dPlus = 0;
            $dMin = 0;

            foreach (array_keys($bobot) as $idKriteria) {
                $val = $alt[$idKriteria] ?? 0;
                $dPlus += pow($val - $idealPositif[$idKriteria], 2);
                $dMin += pow($val - $idealNegatif[$idKriteria], 2);
            }

            $dPlus = round(sqrt($dPlus), 5);
            $dMin = round(sqrt($dMin), 5);

            $preferensi = ($dPlus + $dMin) != 0
                ? round($dMin / ($dMin + $dPlus), 5)
                : 0;

            $hasil[] = [
                'id_lapangan' => $idLapangan,
                'nama' => $lapanganList[$idLapangan],
                'nilai' => $preferensi,
            ];
        }

        // Urutkan dan beri peringkat
        usort($hasil, fn($a, $b) => $b['nilai'] <=> $a['nilai']);
        foreach ($hasil as $i => &$row) {
            $row['peringkat'] = $i + 1;
        }

        return $hasil;
    }

    public function cetakHasilPerhitungan()
    {
        // Ambil ulang data hasil perhitungan user terakhir dari session
        $kriteria = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();
        $hasilAhp = session()->get('hasil_ahp');
        $dataTopsis = session()->get('data_topsis'); // pastikan diset setelah perhitungan

        if (!$hasilAhp || !$dataTopsis) {
            return redirect()->to(base_url('cari-lapangan'))->with('error', 'Silakan lakukan perhitungan terlebih dahulu.');
        }

        // Format bobot kriteria
        $dataKriteria = [];
        foreach ($kriteria as $i => $k) {
            $dataKriteria[] = [
                'nama' => $k['nama'],
                'tipe' => $k['tipe'],
                'bobot' => $hasilAhp['prioritas'][$i],
            ];
        }

        return view('pages/cetak-hasil', [
            'data' => $dataTopsis,
            'dataKriteria' => $dataKriteria,
        ]);
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
        if (!$lapangan) {
            return redirect()->to(base_url('/daftar-lapangan-futsal'))->with('errorDetail', 'Detail Lapangan Futsal tidak tersedia');
        }
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
                'rules' => 'required|in_list[lapangan,kriteria]',
                'errors' => [
                    'required' => 'Jenis rekomendasi wajib dipilih',
                    'in_list' => 'Jenis rekomendasi tidak valid'
                ]
            ],
            'nama_rekomendasi' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Nama rekomendasi tidak boleh kosong',
                    'min_length' => 'Nama minimal 5 karakter'

                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Keterangan tidak boleh kosong',
                    'min_length' => 'Keterangan minimal 10 karakter'
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
        return redirect()->to(base_url('/rekomendasikan'))->with('successRekomendasi', 'Berhasil Mengirim Rekomendasi');
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
        return redirect()->to(base_url('/kontak-kami'))->with('successPesan', 'Berhasil Mengirim Pesan');
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
        $user = getUser();
        if (!$user) {
            return redirect()->to('/login');
        }

        $userDb = $this->userModel->find($user['id_user']);
        $namaBaru = $this->request->getVar('nama');
        $passLama = $this->request->getVar('passwordLama');
        $passBaru = $this->request->getVar('passwordBaru');
        $konfirmasi = $this->request->getVar('konfirmasi');

        // === 1. Set rules utama
        $rules = [
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[100]|is_unique[users.nama,id_user,' . $user['id_user'] . ']',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                    'min_length' => 'Nama minimal 3 karakter',
                    'max_length' => 'Nama maksimal 100 karakter',
                    'is_unique' => 'Nama sudah terdaftar.',
                ]
            ],
            'passwordBaru' => [
                'rules' => 'permit_empty|min_length[6]',
                'errors' => [
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'konfirmasi' => [
                'rules' => 'permit_empty|matches[passwordBaru]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $validation = \Config\Services::validation();

        if (!empty($passBaru)) {
            if (empty($passLama)) {
                $validation->setError('passwordLama', 'Password lama wajib diisi');
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            if (!password_verify($passLama, $userDb['password'])) {
                $validation->setError('passwordLama', 'Password lama tidak sesuai');
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }

        if (!empty($passLama) && empty($passBaru)) {
            if (!password_verify($passLama, $userDb['password'])) {
                $validation->setError('passwordLama', 'Password lama tidak sesuai');
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            if ($namaBaru === $userDb['nama']) {
                return redirect()->to('/profil')->with('successProfil', 'Tidak ada perubahan data');
            }
        }

        $dataUser = [
            'id_user' => $user['id_user'],
            'nama' => $namaBaru,
        ];

        if (!empty($passBaru)) {
            $dataUser['password'] = password_hash($passBaru, PASSWORD_DEFAULT);
        }

        $this->userModel->save($dataUser);

        // Update session nama jika berubah
        session()->set('user', [
            'id_user' => $user['id_user'],
            'nama' => $namaBaru,
            'email' => $user['email'],
            'role' => $user['role'],
        ]);

        return redirect()->to('/profil')->with('successProfil', 'Berhasil update profil');
    }
}
