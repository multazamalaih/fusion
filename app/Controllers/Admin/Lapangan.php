<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LapanganModel;
use App\Models\FasilitasModel;
use App\Models\FotoModel;
use App\Models\JamOperasionalModel;

class Lapangan extends BaseController
{
    protected $lapanganModel;
    protected $fasilitasModel;
    protected $fotoModel;
    protected $jamOperasionalModel;

    public function __construct()
    {
        $this->lapanganModel         = new LapanganModel();
        $this->fasilitasModel        = new FasilitasModel();
        $this->fotoModel             = new FotoModel();
        $this->jamOperasionalModel   = new JamOperasionalModel();
    }
    public function listLapangan()
    {
        $data['lapangan'] = $this->lapanganModel->findAll();
        return view('pages/admin/list-lapangan', $data);
    }
    public function tambahLapangan()
    {
        return view('pages/admin/tambah-lapangan');
    }
    public function simpanLapangan()
    {
        $fotoKeys = ['lapangan', 'bangku_cadangan', 'toilet_wc', 'mushola', 'tempat_parkir'];

        $rules = [
            'nama' => [
                'rules' => 'min_length[3]|max_length[100]|is_unique[lapangan.nama]\required',
                'errors' => [
                    'min_length' => 'Nama Lapangan minimal 3 karakter',
                    'max_length' => 'Nama Lapangan maksimal 100 karakter',
                    'is_unique' => 'Nama Lapangan sudah terdaftar',
                    'required' => 'Nama Lapangan tidak boleh kosong',

                ]
            ],
            'harga' => [
                'rules' => 'numeric|is_natural_no_zero|required',
                'errors' => [
                    'numeric' => 'Harga Sewa berupa angka',
                    'is_natural_no_zero' => 'Harga Sewa harus angka bulat positif',
                    'required' => 'Harga Lapangan tidak boleh kosong',

                ]
            ],
            'jenis_lantai' => [
                'rules' => 'in_list[Vinyl,Rumput Sintetis,Semen,Parquette,Taraflex,Interlock]',
                'errors' => [
                    'in_list' => 'Jenis Lantai tidak valid',
                ]
            ],
            'no_hp' => [
                'rules' => 'max_length[15]|regex_match[/^[0-9+\-\s]+$/]|required',
                'errors' => [
                    'max_length' => 'Nomor Handphone maksimal 15 karakter',
                    'regex_match' => 'Nomor Handphone tidak valid',
                    'required' => 'Nomor Handphone tidak boleh kosong',

                ]
            ],
            'latitude' => [
                'rules' => 'numeric|greater_than[-91]|less_than[91]|required',
                'errors' => [
                    'numeric' => 'Latitude harus berupa angka',
                    'greater_than' => 'Latitude minimal -90',
                    'less_than' => 'Latitude maksimal 90',
                    'required' => 'Latitude tidak boleh kosong',

                ]
            ],
            'longitude' => [
                'rules' => 'numeric|greater_than[-181]|less_than[181]|required',
                'errors' => [
                    'numeric' => 'Longitude harus berupa angka',
                    'greater_than' => 'Longitude minimal -180',
                    'less_than' => 'Longitude maksimal 180',
                    'required' => 'Longitude tidak boleh kosong',

                ]
            ],
            'alamat' => [
                'rules' => 'min_length[10]|required',
                'errors' => [
                    'min_length' => 'Alamat minimal 10 karakter',
                    'required' => 'Alamat Lapangan tidak boleh kosong',

                ]
            ],
        ];

        // Validasi foto (wajib dan maksimal 2MB)
        foreach ($fotoKeys as $key) {
            $rules["foto.$key"] = [
                'rules' => 'uploaded[foto.' . $key . ']|max_size[foto.' . $key . ',2048]|is_image[foto.' . $key . ']',
                'errors' => [
                    'uploaded' => 'Foto ' . ucwords(str_replace('_', ' ', $key)) . ' wajib diunggah',
                    'max_size' => 'Ukuran foto ' . ucwords(str_replace('_', ' ', $key)) . ' maksimal 2 MB',
                    'is_image' => 'File foto ' . ucwords(str_replace('_', ' ', $key)) . ' tidak valid',
                ]
            ];
        }
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data utama
        $id = $this->lapanganModel->insert([
            'nama'         => $this->request->getPost('nama'),
            'harga'        => $this->request->getPost('harga'),
            'jenis_lantai' => $this->request->getPost('jenis_lantai'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'latitude'     => $this->request->getPost('latitude'),
            'longitude'    => $this->request->getPost('longitude'),
            'alamat'       => $this->request->getPost('alamat'),
        ], true);

        // Simpan foto
        $fotoArray = $this->request->getFiles()['foto'] ?? [];
        $fotoLabel = [
            'lapangan'         => 'Lapangan',
            'bangku_cadangan'  => 'Bangku Cadangan',
            'toilet_wc'        => 'Toilet/WC',
            'mushola'          => 'Mushola',
            'tempat_parkir'    => 'Tempat Parkir',
        ];
        foreach ($fotoLabel as $key => $label) {
            if (isset($fotoArray[$key]) && $fotoArray[$key]->isValid()) {
                $namaFile = $fotoArray[$key]->getRandomName();
                $fotoArray[$key]->move('uploads', $namaFile);
                $this->fotoModel->insert([
                    'id_lapangan' => $id,
                    'jenis_foto'  => $label,
                    'file'        => $namaFile,
                ]);
            }
        }

        // Simpan fasilitas
        $fasilitas = $this->request->getPost('fasilitas');
        if ($fasilitas && is_array($fasilitas)) {
            foreach ($fasilitas as $f) {
                $this->fasilitasModel->insert([
                    'id_lapangan' => $id,
                    'nama'        => $f,
                ]);
            }
        }

        // Simpan jam operasional
        $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        foreach ($hariList as $hari) {
            $status = $this->request->getPost($hari) ? 'Buka' : 'Tutup';
            $jamBuka = $status === 'Buka' ? $this->request->getPost($hari . '_buka') : null;
            $jamTutup = $status === 'Buka' ? $this->request->getPost($hari . '_tutup') : null;

            $this->jamOperasionalModel->insert([
                'id_lapangan' => $id,
                'hari'        => ucfirst($hari),
                'status'      => $status,
                'jam_buka'    => $jamBuka,
                'jam_tutup'   => $jamTutup,
            ]);
        }

        session()->setFlashdata('success', 'Data Lapangan Futsal berhasil ditambahkan.');
        return redirect()->to(base_url('admin/list-lapangan'));
    }

    public function detailLapangan($id)
    {
        $lapangan = $this->lapanganModel->find($id);

        if (!$lapangan) {
            return redirect()->to(base_url('admin/list-lapangan'))->with('error', 'Data Lapangan tidak ditemukan.');
        }

        $foto = $this->fotoModel
            ->where('id_lapangan', $id)
            ->findAll();

        $fasilitas = $this->fasilitasModel
            ->where('id_lapangan', $id)
            ->findAll();

        $jam = $this->jamOperasionalModel
            ->where('id_lapangan', $id)
            ->findAll();

        $fotoMap = [];
        foreach ($foto as $f) {
            $fotoMap[] = [
                'jenis_foto' => $f['jenis_foto'],
                'file'       => $f['file']
            ];
        }

        // Fasilitas: ambil list nama fasilitas
        $fasilitasList = array_column($fasilitas, 'nama');

        // Jam operasional: array asosiatif [hari] => [status, jam_buka, jam_tutup]
        $jamMap = [];
        foreach ($jam as $j) {
            $hari = strtolower($j['hari']);
            $jamMap[$hari] = [
                'status'    => $j['status'],
                'jam_buka'  => $j['jam_buka'],
                'jam_tutup' => $j['jam_tutup']
            ];
        }

        return view('pages/admin/detail-lapangan', [
            'lapangan'       => $lapangan,
            'foto'           => $foto,
            'fasilitas'      => $fasilitasList,
            'jamOperasional' => $jamMap
        ]);
    }

    public function editLapangan($id)
    {
        $lapangan = $this->lapanganModel->find($id);
        if (!$lapangan) {
            return redirect()->to(base_url('admin/list-lapangan'))->with('error', 'Data lapangan tidak ditemukan.');
        }

        $foto = $this->fotoModel
            ->where('id_lapangan', $id)
            ->findAll();

        $fasilitas = $this->fasilitasModel
            ->where('id_lapangan', $id)
            ->findAll();

        $jam = $this->jamOperasionalModel
            ->where('id_lapangan', $id)
            ->findAll();

        // Label default
        $fotoLabel = [
            'lapangan'         => ['label' => 'Lapangan', 'file' => null],
            'bangku_cadangan'  => ['label' => 'Bangku Cadangan', 'file' => null],
            'toilet_wc'        => ['label' => 'Toilet/WC', 'file' => null],
            'mushola'          => ['label' => 'Mushola', 'file' => null],
            'tempat_parkir'    => ['label' => 'Tempat Parkir', 'file' => null],
        ];

        foreach ($foto as $f) {
            $key = strtolower(str_replace([' ', '/'], ['_', '_'], $f['jenis_foto']));
            if (isset($fotoLabel[$key])) {
                $fotoLabel[$key]['file'] = $f['file'];
            }
        }

        $fasilitasList = array_column($fasilitas, 'nama');

        $jamMap = [];
        foreach ($jam as $item) {
            $hari = strtolower($item['hari']);
            $jamMap[$hari] = [
                'status'    => $item['status'],
                'jam_buka'  => $item['jam_buka'],
                'jam_tutup' => $item['jam_tutup']
            ];
        }

        return view('pages/admin/edit-lapangan', [
            'lapangan'      => $lapangan,
            'fotoLabel'     => $fotoLabel,
            'fasilitasList' => $fasilitasList,
            'jamMap'        => $jamMap
        ]);
    }
    public function updateLapangan($id)
    {
        $lapangan = $this->lapanganModel->find($id);
        if (!$lapangan) {
            return redirect()->to(base_url('admin/list-lapangan'))->with('error', 'Data Lapangan Futsal tidak ditemukan.');
        }

        $rules = [
            'nama' => [
                'rules' => 'min_length[3]|max_length[100]|is_unique[lapangan.nama,id_lapangan,' . $id . ']|required',
                'errors' => [
                    'min_length' => 'Nama minimal 3 karakter',
                    'max_length' => 'Nama maksimal 100 karakter',
                    'is_unique'  => 'Nama sudah terdaftar oleh lapangan lain',
                    'required' => 'Nama Lapangan tidak boleh kosong.',

                ]
            ],
            'harga' => [
                'rules' => 'numeric|is_natural_no_zero|required',
                'errors' => [
                    'numeric' => 'Harga Sewa berupa angka',
                    'is_natural_no_zero' => 'Harga Sewa harus angka bulat positif',
                    'required' => 'Harga Lapangan tidak boleh kosong',

                ]
            ],
            'jenis_lantai' => [
                'rules' => 'in_list[Vinyl,Rumput Sintetis,Semen,Parquette,Taraflex,Interlock]',
                'errors' => [
                    'in_list' => 'Jenis Lantai tidak valid',
                ]
            ],
            'no_hp' => [
                'rules' => 'max_length[15]|regex_match[/^[0-9+\-\s]+$/]|required',
                'errors' => [
                    'max_length' => 'Nomor Handphone maksimal 15 karakter',
                    'regex_match' => 'Nomor Handphone tidak valid',
                    'required' => 'Nomor Handphone tidak boleh kosong',

                ]
            ],
            'latitude' => [
                'rules' => 'numeric|greater_than[-91]|less_than[91]|required',
                'errors' => [
                    'numeric' => 'Latitude harus berupa angka',
                    'greater_than' => 'Latitude minimal -90',
                    'less_than' => 'Latitude maksimal 90',
                    'required' => 'Latitude tidak boleh kosong',

                ]
            ],
            'longitude' => [
                'rules' => 'numeric|greater_than[-181]|less_than[181]|required',
                'errors' => [
                    'numeric' => 'Longitude harus berupa angka',
                    'greater_than' => 'Longitude minimal -180',
                    'less_than' => 'Longitude maksimal 180',
                    'required' => 'Longitude tidak boleh kosong',

                ]
            ],
            'alamat' => [
                'rules' => 'min_length[10]|required',
                'errors' => [
                    'min_length' => 'Alamat minimal 10 karakter',
                    'required' => 'Alamat Lapangan tidak boleh kosong',

                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data utama
        $this->lapanganModel->update($id, [
            'nama'         => $this->request->getPost('nama'),
            'harga'        => $this->request->getPost('harga'),
            'jenis_lantai' => $this->request->getPost('jenis_lantai'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'latitude'     => $this->request->getPost('latitude'),
            'longitude'    => $this->request->getPost('longitude'),
            'alamat'       => $this->request->getPost('alamat'),
        ]);

        // Cek dan update file jika diupload ulang
        $fotoArray = $this->request->getFiles()['foto'] ?? [];
        $fotoLabel = [
            'lapangan'         => 'Lapangan',
            'bangku_cadangan'  => 'Bangku Cadangan',
            'toilet_wc'        => 'Toilet/WC',
            'mushola'          => 'Mushola',
            'tempat_parkir'    => 'Tempat Parkir',
        ];

        foreach ($fotoLabel as $key => $label) {
            if (isset($fotoArray[$key]) && $fotoArray[$key]->isValid()) {
                // Validasi ukuran maks 2 MB
                if ($fotoArray[$key]->getSizeByUnit('mb') > 2) {
                    session()->setFlashdata('errors', ["Ukuran file $label maksimal 2 MB"]);
                    return redirect()->back()->withInput();
                }

                $namaFile = $fotoArray[$key]->getRandomName();
                $fotoArray[$key]->move('uploads', $namaFile);

                $cek = $this->fotoModel
                    ->where('id_lapangan', $id)
                    ->where('jenis_foto', $label)
                    ->first();

                if ($cek && file_exists(FCPATH . 'uploads/' . $cek['file'])) {
                    unlink(FCPATH . 'uploads/' . $cek['file']);
                }

                if ($cek) {
                    $this->fotoModel->update($cek['id_foto'], ['file' => $namaFile]);
                } else {
                    $this->fotoModel->insert([
                        'id_lapangan' => $id,
                        'jenis_foto'  => $label,
                        'file'        => $namaFile,
                    ]);
                }
            }
        }

        // Update fasilitas
        $this->fasilitasModel->where('id_lapangan', $id)->delete();
        foreach ($this->request->getPost('fasilitas') ?? [] as $f) {
            $this->fasilitasModel->insert([
                'id_lapangan' => $id,
                'nama'        => $f
            ]);
        }

        // Update jam operasional
        $this->jamOperasionalModel->where('id_lapangan', $id)->delete();
        foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'] as $hari) {
            $status = $this->request->getPost($hari) ? 'Buka' : 'Tutup';
            $jamBuka = $status == 'Buka' ? $this->request->getPost($hari . '_buka') : null;
            $jamTutup = $status == 'Buka' ? $this->request->getPost($hari . '_tutup') : null;

            $this->jamOperasionalModel->insert([
                'id_lapangan' => $id,
                'hari'        => ucfirst($hari),
                'status'      => $status,
                'jam_buka'    => $jamBuka,
                'jam_tutup'   => $jamTutup,
            ]);
        }
        session()->setFlashdata('success', 'Data Lapangan Futsal berhasil diperbarui.');
        return redirect()->to(base_url('admin/list-lapangan'));
    }

    public function hapusLapangan($id)
    {
        // Ambil data lapangan
        $lapangan = $this->lapanganModel->find($id);
        if (!$lapangan) {
            return redirect()->to(base_url('admin/list-lapangan'))->with('error', 'Data Lapangan tidak ditemukan.');
        }

        // Ambil dan hapus file foto
        $fotoList = $this->fotoModel->where('id_lapangan', $id)->findAll();
        foreach ($fotoList as $foto) {
            $filePath = FCPATH . 'uploads/' . $foto['file'];
            if (file_exists($filePath)) {
                unlink($filePath); // hapus file dari folder
            }
        }

        // Hapus data terkait
        $this->fotoModel->where('id_lapangan', $id)->delete();
        $this->fasilitasModel->where('id_lapangan', $id)->delete();
        $this->jamOperasionalModel->where('id_lapangan', $id)->delete();

        // Hapus data utama
        $this->lapanganModel->delete($id);

        session()->setFlashdata('success', 'Data Lapangan Futsal berhasil dihapus.');
        return redirect()->to(base_url('admin/list-lapangan'));
    }
}
