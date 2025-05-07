<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\KriteriaAhpModel;

class Kriteria extends BaseController
{
    protected $kriteriaModel;
    protected $subKriteriaModel;
    protected $kriteriaAhpModel;

    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
        $this->subKriteriaModel = new SubKriteriaModel();
        $this->kriteriaAhpModel = new KriteriaAhpModel();
    }
    public function listKriteria()
    {
        $kriteria = $this->kriteriaModel->findAll();
        $jumlah = count($kriteria);

        if ($jumlah < 3) {
            session()->setFlashdata('errorkriteria', 'Minimal 3 kriteria diperlukan untuk menghitung bobot preferensi AHP.');
        }

        return view('pages/admin/list-kriteria', [
            'kriteria' => $kriteria,
            'bisa_tambah_bobot' => $jumlah >= 3,
        ]);
    }
    public function tambahKriteria()
    {
        return view('pages/admin/tambah-kriteria');
    }
    public function simpanKriteria()
    {
        $rules = [
            'kode_kriteria' => [
                'rules' => 'min_length[2]|max_length[6]|is_unique[kriteria.kode_kriteria]',
                'errors' => [
                    'min_length' => 'Kode Kriteria minimal 2 karakter',
                    'max_length' => 'Kode Kriteria maksimal 6 karakter',
                    'is_unique'  => 'Kode Kriteria sudah terdaftar',
                ]
            ],
            'nama' => [
                'rules' => 'min_length[5]|max_length[100]|is_unique[kriteria.nama]',
                'errors' => [
                    'min_length' => 'Nama Kriteria minimal 5 karakter',
                    'max_length' => 'Nama Kriteria maksimal 100 karakter',
                    'is_unique'  => 'Nama Kriteria sudah terdaftar',
                ]
            ],
            'tipe' => [
                'rules' => 'in_list[Benefit,Cost]',
                'errors' => [
                    'in_list'  => 'Tipe Kriteria harus benefit atau cost',
                ]
            ],
            'pilihan' => [
                'rules' => 'in_list[Langsung,Sub Kriteria]',
                'errors' => [
                    'in_list'  => 'Cara Penilaian harus Input Langsung atau Pilih Sub kriteria',
                ]
            ],
            'slogan' => [
                'rules' => 'min_length[10]',
                'errors' => [
                    'min_length' => 'Slogan Kriteria minimal 10 karakter',
                ]
            ],
            'keterangan' => [
                'rules' => 'min_length[30]',
                'errors' => [
                    'min_length' => 'Keterangan Kriteria minimal 30 karakter',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kriteriaModel->insert([
            'kode_kriteria' => $this->request->getPost('kode_kriteria'),
            'nama'          => $this->request->getPost('nama'),
            'tipe'          => $this->request->getPost('tipe'),
            'pilihan'       => $this->request->getPost('pilihan'),
            'slogan'        => $this->request->getPost('slogan'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ]);

        session()->setFlashdata('success', 'Data Kriteria berhasil ditambahkan.');
        return redirect()->to(base_url('admin/list-kriteria'));
    }
    public function detailKriteria($id)
    {
        $kriteria = $this->kriteriaModel->find($id);
        if (!$kriteria) {
            return redirect()->to(base_url('admin/list-kriteria'))->with('error', 'Kriteria tidak ditemukan.');
        }
        $data = [
            'kriteria' => $kriteria
        ];
        return view('pages/admin/detail-kriteria', $data);
    }

    public function editKriteria($id)
    {
        $kriteria = $this->kriteriaModel->find($id);

        if (!$kriteria) {
            return redirect()->to(base_url('admin/list-kriteria'))->with('error', 'Kriteria tidak ditemukan.');
        }
        $data = [
            'kriteria' => $kriteria,
            'pilihan'  => $kriteria['pilihan'],
        ];
        return view('pages/admin/edit-kriteria', $data);
    }

    public function updateKriteria($id)
    {
        $kriteria = $this->kriteriaModel->find($id);
        if (!$kriteria) {
            return redirect()->to(base_url('admin/list-kriteria'))->with('error', 'Data Kriteria tidak ditemukan.');
        }

        $rules = [
            'kode_kriteria' => [
                'rules' => "min_length[2]|max_length[6]|is_unique[kriteria.kode_kriteria,id_kriteria,{$id}]",
                'errors' => [
                    'min_length'  => 'Kode Kriteria minimal 2 karakter',
                    'max_length'  => 'Kode Kriteria maksimal 6 karakter',
                    'is_unique'   => 'Kode Kriteria sudah terdaftar'
                ]
            ],
            'nama' => [
                'rules' => "min_length[5]|max_length[100]|is_unique[kriteria.nama,id_kriteria,{$id}]",
                'errors' => [
                    'min_length'  => 'Nama Kriteria minimal 5 karakter',
                    'max_length'  => 'Nama Kriteria maksimal 100 karakter',
                    'is_unique'   => 'Nama Kriteria sudah terdaftar'
                ]
            ],
            'tipe' => [
                'rules' => 'in_list[Benefit,Cost]',
                'errors' => [
                    'in_list'  => 'Tipe Kriteria tidak valid'
                ]
            ],
            'pilihan' => [
                'rules' => 'in_list[Langsung,Sub Kriteria]',
                'errors' => [
                    'in_list'  => 'Cara Penilaian tidak valid'
                ]
            ],
            'slogan' => [
                'rules' => 'min_length[10]',
                'errors' => [
                    'min_length' => 'Slogan Kriteria minimal 10 karakter'
                ]
            ],
            'keterangan' => [
                'rules' => 'min_length[30]',
                'errors' => [
                    'min_length' => 'Keterangan Kriteria minimal 30 karakter'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('admin/edit-kriteria/' . $id))->withInput()->with('errors', $this->validator->getErrors());
        }

        // Hapus sub jika pilihan berubah
        if ($kriteria['pilihan'] === 'Sub Kriteria' && $this->request->getPost('pilihan') !== 'Sub Kriteria') {
            $this->subKriteriaModel->where('id_kriteria', $id)->delete();
            session()->setFlashdata('warning', 'Sub Kriteria dihapus karena metode penilaian berubah.');
        }

        $this->kriteriaModel->update($id, [
            'kode_kriteria' => $this->request->getPost('kode_kriteria'),
            'nama'          => $this->request->getPost('nama'),
            'tipe'          => $this->request->getPost('tipe'),
            'pilihan'       => $this->request->getPost('pilihan'),
            'slogan'        => $this->request->getPost('slogan'),
            'keterangan'    => $this->request->getPost('keterangan')
        ]);

        session()->setFlashdata('success', 'Data berhasil diperbarui.');
        return redirect()->to(base_url('admin/list-kriteria'));
    }


    public function hapusKriteria($id)
    {
        $kriteria = $this->kriteriaModel->find($id);
        if (!$kriteria) {
            return redirect()->to(base_url('admin/list-kriteria'))->with('error', 'Data Kriteria tidak ditemukan.');
        }

        // Hapus sub-kriteria terkait
        $this->subKriteriaModel->where('id_kriteria', $id)->delete();

        // Hapus data kriteria
        $this->kriteriaModel->delete($id);

        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/list-kriteria'));
    }

    public function tambahBobot()
    {
        $kriteria = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();
        $ahpList = $this->kriteriaAhpModel->findAll();

        $nilai_input_sementara = session()->getFlashdata('nilai_input_sementara');
        if (empty($nilai_input_sementara)) {
            foreach ($ahpList as $row) {
                $id1 = $row['id_kriteria_1'];
                $id2 = $row['id_kriteria_2'];
                if ($row['nilai_1'] < 1) {
                    $nilai_input_sementara[$id1][$id2] = $row['nilai_2'];
                } elseif ($row['nilai_1'] > 1) {
                    $nilai_input_sementara[$id1][$id2] = -$row['nilai_1'];
                } else {
                    $nilai_input_sementara[$id1][$id2] = 1;
                }
            }
        }

        $data = [
            'kriteria' => $kriteria,
            'ahpList'  => $ahpList,
            'nilai_input_sementara' => $nilai_input_sementara,
            'hasil_ahp' => session()->getFlashdata('hasil_ahp'),
            'from_cek_konsistensi' => session()->getFlashdata('from_cek_konsistensi'),
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error'),
        ];

        return view('pages/admin/tambah-bobot', $data);
    }

    public function simpanBobot()
    {
        $kriteria = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();
        $this->kriteriaAhpModel->truncate();

        [$matrik, $nilai_input_sementara] = $this->buatMatrikDariInput($kriteria);
        $hasil = $this->hitungAhp($matrik);

        if (count($kriteria) < 3) {
            return redirect()->back()->with('error', 'Minimal harus ada 3 kriteria untuk melakukan perbandingan.');
        }

        if ($hasil['cr'] > 0.1) {
            session()->setFlashdata('error', 'Data tidak konsisten (CR > 0.1), data tidak dapat disimpan.');
        } else {
            foreach ($kriteria as $i => $k) {
                $this->kriteriaModel->update($k['id_kriteria'], ['bobot' => $hasil['prioritas'][$i]]);
            }
            session()->setFlashdata('success', 'Data berhasil disimpan dan Bobot Kriteria diperbarui.');
        }

        session()->setFlashdata('nilai_input_sementara', $nilai_input_sementara);

        return redirect()->to(base_url('admin/tambah-bobot'));
    }

    public function cekKonsistensi()
    {
        $kriteria = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();
        $matrik = [];
        $nilai_input_sementara = [];

        foreach ($kriteria as $i => $row1) {
            foreach ($kriteria as $j => $row2) {
                if ($i == $j) {
                    $matrik[$i][$j] = 1;
                } elseif ($i < $j) {
                    $key = 'nilai_' . $row1['id_kriteria'] . '_' . $row2['id_kriteria'];
                    $nilai = $this->request->getPost($key);

                    if ($nilai !== null) {
                        $nilai = (float)$nilai;
                        $nilai_input_sementara[$row1['id_kriteria']][$row2['id_kriteria']] = $nilai;

                        $nilai_1 = $nilai < 1 ? abs($nilai) : round(1 / abs($nilai), 5);
                        $nilai_2 = $nilai < 1 ? round(1 / abs($nilai), 5) : abs($nilai);

                        $matrik[$i][$j] = $nilai_1;
                        $matrik[$j][$i] = $nilai_2;
                    }
                }
            }
        }

        $hasil = $this->hitungAhp($matrik);

        $data = [
            'kriteria' => $kriteria,
            'nilai_input_sementara' => $nilai_input_sementara,
            'hasil_ahp' => $hasil,
            'from_cek_konsistensi' => true,
        ];

        if ($hasil['cr'] > 0.1) {
            $data['error'] = 'Data tidak konsisten (CR > 0.1). Silakan perbaiki nilai perbandingan';
        } else {
            $data['success'] = 'Data konsisten. Silakan simpan hasil perbandingan.';
        }

        return view('pages/admin/tambah-bobot', $data);
    }

    private function buatMatrikDariInput($kriteria)
    {
        $matrik = [];
        $nilai_input_sementara = []; // tambahkan ini

        foreach ($kriteria as $i => $k1) {
            foreach ($kriteria as $j => $k2) {
                if ($i == $j) {
                    $matrik[$i][$j] = 1;
                } elseif ($i < $j) {
                    $inputName = 'nilai_' . $k1['id_kriteria'] . '_' . $k2['id_kriteria'];
                    $nilai = $this->request->getPost($inputName);

                    if ($nilai !== null) {
                        // Hitung nilai 1 dan 2
                        $nilai1 = ($nilai < 1) ? abs($nilai) : (($nilai > 1) ? round(1 / abs($nilai), 5) : 1);
                        $nilai2 = ($nilai < 1) ? round(1 / abs($nilai), 5) : (($nilai > 1) ? abs($nilai) : 1);

                        $matrik[$i][$j] = $nilai1;
                        $matrik[$j][$i] = $nilai2;

                        // Simpan input user
                        $nilai_input_sementara[$k1['id_kriteria']][$k2['id_kriteria']] = (float)$nilai;

                        // Simpan ke DB
                        $this->kriteriaAhpModel->save([
                            'id_kriteria_1' => $k1['id_kriteria'],
                            'id_kriteria_2' => $k2['id_kriteria'],
                            'nilai_1'       => $nilai1,
                            'nilai_2'       => $nilai2,
                        ]);
                    }
                }
            }
        }

        return [$matrik, $nilai_input_sementara];
    }


    private function buatMatrikDariDatabase($kriteria, $ahpList)
    {
        $matrik = [];
        $idMap = array_column($kriteria, 'id_kriteria');

        foreach ($idMap as $i => $id1) {
            foreach ($idMap as $j => $id2) {
                if ($i == $j) {
                    $matrik[$i][$j] = 1;
                } elseif ($i < $j) {
                    foreach ($ahpList as $item) {
                        if ($item['id_kriteria_1'] == $id1 && $item['id_kriteria_2'] == $id2) {
                            $matrik[$i][$j] = $item['nilai_1'];
                            $matrik[$j][$i] = $item['nilai_2'];
                            break;
                        }
                    }
                }
            }
        }
        return $matrik;
    }

    private function hitungAhp($matrik)
    {
        $n = count($matrik);

        // Hitung jumlah tiap kolom matriks
        $jumlahKolom = [];
        foreach ($matrik as $j => $col) {
            $jumlahKolom[$j] = array_sum(array_column($matrik, $j));
        }

        // Normalisasi matriks dan hitung prioritas
        $normalisasi = [];
        $prioritas = [];
        foreach ($matrik as $i => $baris) {
            $total = 0;
            foreach ($baris as $j => $nilai) {
                $val = $nilai / $jumlahKolom[$j];
                $normalisasi[$i][$j] = round($val, 5);
                $total += $val;
            }
            $prioritas[$i] = round($total / $n, 5);
        }

        // Hitung matriks baris dan jumlah baris
        $matrikBaris = [];
        $jumlahBaris = [];
        foreach ($matrik as $i => $baris) {
            $jumlahBaris[$i] = 0;
            foreach ($baris as $j => $nilai) {
                $matrikBaris[$i][$j] = round($nilai * $prioritas[$j], 5);
                $jumlahBaris[$i] += $matrikBaris[$i][$j];
            }
        }

        // Hitung hasil konsistensi tiap baris
        $hasilKonsistensi = [];
        $lambda = 0;
        foreach ($jumlahBaris as $i => $val) {
            $hasilKonsistensi[$i] = round($val / $prioritas[$i], 5);
            $lambda += $hasilKonsistensi[$i];
        }

        // Hitung CI dan CR
        $lambdaMax = $lambda / $n;
        $ci = ($lambdaMax - $n) / ($n - 1);
        $ir = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $cr = ($n <= 10) ? round($ci / $ir[$n - 1], 5) : 0;

        // Return semua data mentah ke view
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
}
