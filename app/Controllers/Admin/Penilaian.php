<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenilaianModel;
use App\Models\LapanganModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;

class Penilaian extends BaseController
{
    protected $penilaianModel;
    protected $lapanganModel;
    protected $kriteriaModel;
    protected $subKriteriaModel;

    public function __construct()
    {
        // Memuat model yang dibutuhkan
        $this->penilaianModel = new PenilaianModel();
        $this->lapanganModel = new LapanganModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->subKriteriaModel = new SubKriteriaModel();
    }

    // Menampilkan daftar penilaian
    public function listPenilaian()
    {
        $lapanganList = $this->lapanganModel->findAll();  // Mendapatkan semua data lapangan
        $kriteriaList = $this->kriteriaModel->orderBy('kode_kriteria')->findAll();  // Mendapatkan semua kriteria

        // Ambil sub-kriteria berdasarkan kriteria dan urutkan berdasarkan nilai (dari besar ke kecil)
        $subKriteriaData = [];
        foreach ($kriteriaList as $kriteria) {
            if ($kriteria['pilihan'] == 'Sub Kriteria') {
                // Urutkan berdasarkan nilai sub-kriteria dari besar ke kecil
                $subKriteriaData[$kriteria['id_kriteria']] = $this->subKriteriaModel
                    ->where('id_kriteria', $kriteria['id_kriteria'])
                    ->orderBy('nilai', 'desc')  // Mengurutkan berdasarkan nilai dari terbesar ke terkecil
                    ->findAll();
            }
        }

        $penilaianData = [];
        foreach ($lapanganList as $lapangan) {
            foreach ($kriteriaList as $kriteria) {
                // Mengecek apakah penilaian untuk lapangan dan kriteria sudah ada
                $penilaian = $this->penilaianModel
                    ->where('id_lapangan', $lapangan['id_lapangan'])
                    ->where('id_kriteria', $kriteria['id_kriteria'])
                    ->first();

                // Simpan data penilaian untuk lapangan dan kriteria
                $penilaianData[$lapangan['id_lapangan']][$kriteria['id_kriteria']] = $penilaian;
            }
        }

        // Kirim data ke view
        return view('pages/admin/list-penilaian', [
            'lapanganList' => $lapanganList,
            'kriteriaList' => $kriteriaList,
            'penilaianData' => $penilaianData,
            'subKriteriaData' => $subKriteriaData,  // Mengirimkan data sub-kriteria yang sudah diurutkan
        ]);
    }
    // Menyimpan penilaian baru
    public function simpanPenilaian()
    {
        $idLapangan = $this->request->getPost('id_lapangan');
        $idKriteriaList = $this->request->getPost('id_kriteria');
        $nilaiList = $this->request->getPost('nilai');

        // Menyimpan penilaian untuk setiap kriteria
        foreach ($idKriteriaList as $i => $idKriteria) {
            $nilai = $nilaiList[$i];  // Mendapatkan nilai dari form

            // Cek apakah kriteria memiliki sub-kriteria
            $kriteria = $this->kriteriaModel->find($idKriteria);

            // Jika kriteria memiliki sub-kriteria, kita ambil nilai sub-kriteria yang dipilih
            if ($kriteria['pilihan'] == 'Sub Kriteria') {
                // Pastikan nilai yang diberikan adalah ID sub-kriteria yang valid
                $subKriteria = $this->subKriteriaModel->find($nilai);
                if ($subKriteria) {
                    $nilai = $subKriteria['nilai'];  // Mengambil nilai dari sub-kriteria yang dipilih
                } else {
                    // Jika sub-kriteria tidak valid, bisa menampilkan error
                    session()->setFlashdata('error', 'Sub Kriteria tidak valid.');
                    return redirect()->to('/admin/list-penilaian');
                }
            } else {
                if (!is_numeric($nilai) || !ctype_digit($nilai) || (int)$nilai <= 0) {
                    session()->setFlashdata('error', 'Nilai untuk kriteria "' . $kriteria['nama'] . '" harus berupa angka bulat lebih dari 0.');
                    return redirect()->to('/admin/list-penilaian')->withInput();
                }
            }

            // Menyimpan data penilaian ke tabel penilaian
            $data = [
                'id_lapangan' => $idLapangan,
                'id_kriteria' => $idKriteria,
                'nilai' => $nilai
            ];

            // Insert data penilaian
            $this->penilaianModel->insert($data);
        }

        // Set pesan sukses dan redirect
        session()->setFlashdata('success', 'Penilaian Lapangan berhasil disimpan.');
        return redirect()->to('/admin/list-penilaian');
    }


    // Mengupdate penilaian yang sudah ada
    public function updatePenilaian($idLapangan)
    {
        $idKriteriaList = $this->request->getPost('id_kriteria');
        $nilaiList = $this->request->getPost('nilai');

        // Hapus penilaian lama untuk lapangan ini
        $this->penilaianModel->where('id_lapangan', $idLapangan)->delete();

        foreach ($idKriteriaList as $i => $idKriteria) {
            $nilai = $nilaiList[$i];  // Mendapatkan nilai dari form

            // Cek apakah kriteria memiliki sub-kriteria
            $kriteria = $this->kriteriaModel->find($idKriteria);

            // Jika kriteria memiliki sub-kriteria, kita ambil nilai sub-kriteria yang dipilih
            if ($kriteria['pilihan'] == 'Sub Kriteria') {
                // Pastikan nilai yang diberikan adalah ID sub-kriteria yang valid
                $subKriteria = $this->subKriteriaModel->find($nilai);
                if ($subKriteria) {
                    $nilai = $subKriteria['nilai'];  // Mengambil nilai dari sub-kriteria yang dipilih
                } else {
                    // Jika sub-kriteria tidak valid, bisa menampilkan error
                    session()->setFlashdata('error', 'Sub Kriteria tidak valid.');
                    return redirect()->to('/admin/list-penilaian');
                }
            } else {
                if (!is_numeric($nilai) || !ctype_digit($nilai) || (int)$nilai <= 0) {
                    session()->setFlashdata('error', 'Nilai untuk kriteria "' . $kriteria['nama'] . '" harus berupa angka bulat lebih dari 0.');
                    return redirect()->to('/admin/list-penilaian')->withInput();
                }
            }

            // Menyimpan data penilaian ke tabel penilaian
            $data = [
                'id_lapangan' => $idLapangan,
                'id_kriteria' => $idKriteria,
                'nilai' => $nilai
            ];

            // Insert data penilaian
            $this->penilaianModel->insert($data);
        }

        // Set pesan sukses dan redirect
        session()->setFlashdata('success', 'Penilaian Lapangan berhasil diperbarui.');
        return redirect()->to('/admin/list-penilaian');
    }
}
