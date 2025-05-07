<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\LapanganModel;
use App\Models\PenilaianModel;
use App\Models\HasilModel;

class Perhitungan extends BaseController
{
    protected $kriteriaModel;
    protected $lapanganModel;
    protected $penilaianModel;
    protected $hasilModel;

    public function __construct()
    {
        // Memuat model yang dibutuhkan
        $this->kriteriaModel = new KriteriaModel();
        $this->lapanganModel = new LapanganModel();
        $this->penilaianModel = new PenilaianModel();
        $this->hasilModel = new HasilModel();
    }

    // Menampilkan halaman perhitungan TOPSIS
    public function perhitungan()
    {
        // Ambil data kriteria dan lapangan
        $kriteriaList = $this->kriteriaModel->orderBy('kode_kriteria', 'ASC')->findAll();
        $lapanganList = $this->lapanganModel->findAll();

        if (empty($kriteriaList) || empty($lapanganList)) {
            session()->setFlashdata('errorperhitungan', 'Data kriteria atau lapangan kosong. Harap lengkapi terlebih dahulu.');
            session()->remove('success');
            return view('pages/admin/perhitungan', [
                'kriteriaList' => $kriteriaList,
                'lapanganList' => $lapanganList,
                'penilaianLengkap' => false
            ]);
        }

        // ✅ Cek kelengkapan data penilaian
        foreach ($lapanganList as $lapangan) {
            foreach ($kriteriaList as $kriteria) {
                $cek = $this->penilaianModel
                    ->where('id_lapangan', $lapangan['id_lapangan'])
                    ->where('id_kriteria', $kriteria['id_kriteria'])
                    ->first();

                if (!$cek) {
                    session()->setFlashdata('errorperhitungan', 'Data penilaian belum lengkap. Harap isi semua penilaian.');
                    session()->remove('success');
                    return view('pages/admin/perhitungan', [
                        'kriteriaList' => $kriteriaList,
                        'lapanganList' => $lapanganList,
                        'penilaianLengkap' => false
                    ]);
                }
            }
        }

        // Matriks Keputusan (X)
        $matriksX = [];
        foreach ($lapanganList as $lapangan) {
            foreach ($kriteriaList as $kriteria) {
                $penilaian = $this->penilaianModel
                    ->where('id_lapangan', $lapangan['id_lapangan'])
                    ->where('id_kriteria', $kriteria['id_kriteria'])
                    ->first();
                $matriksX[$lapangan['id_lapangan']][$kriteria['id_kriteria']] = $penilaian ? $penilaian['nilai'] : 0;
            }
        }

        // Matriks Normalisasi (R)
        $matriksR = [];
        $penyebutR = [];

        foreach ($kriteriaList as $kriteria) {
            $id_kriteria = $kriteria['id_kriteria'];
            $jumlahKuadrat = 0;

            // Hitung penyebut: akar dari jumlah kuadrat semua nilai X pada kolom ini
            foreach ($lapanganList as $lapangan) {
                $x = $matriksX[$lapangan['id_lapangan']][$id_kriteria];
                $jumlahKuadrat += pow($x, 2);
            }

            $penyebut = sqrt($jumlahKuadrat);
            $penyebutR[$id_kriteria] = $penyebut;

            // Hitung nilai R
            foreach ($lapanganList as $lapangan) {
                $x = $matriksX[$lapangan['id_lapangan']][$id_kriteria];
                $r = $penyebut != 0 ? $x / $penyebut : 0;
                $matriksR[$lapangan['id_lapangan']][$id_kriteria] = round($r, 5); // bisa dibulatkan 5 angka di belakang koma
            }
        }
        // Matriks Y (normalisasi * bobot)
        $matriksY = [];

        foreach ($lapanganList as $lapangan) {
            foreach ($kriteriaList as $kriteria) {
                $idLapangan = $lapangan['id_lapangan'];
                $idKriteria = $kriteria['id_kriteria'];
                $bobot = $kriteria['bobot'];
                $nilaiR = $matriksR[$idLapangan][$idKriteria];

                $matriksY[$idLapangan][$idKriteria] = round($nilaiR * $bobot, 5); // hasil dibulatkan 5 angka
            }
        }
        // Solusi Ideal Positif dan Negatif
        $solusiIdealPositif = [];
        $solusiIdealNegatif = [];

        foreach ($kriteriaList as $kriteria) {
            $idKriteria = $kriteria['id_kriteria'];
            $tipe = strtolower($kriteria['tipe']); // 'benefit' atau 'cost'

            $nilaiY = array_column($matriksY, $idKriteria); // ambil kolom Y per kriteria

            if ($tipe === 'benefit') {
                $solusiIdealPositif[$idKriteria] = max($nilaiY);
                $solusiIdealNegatif[$idKriteria] = min($nilaiY);
            } else {
                $solusiIdealPositif[$idKriteria] = min($nilaiY);
                $solusiIdealNegatif[$idKriteria] = max($nilaiY);
            }
        }
        // Jarak ke Solusi Ideal Positif (D+) dan Negatif (D-)
        $jarakIdealPositif = [];
        $jarakIdealNegatif = [];

        foreach ($lapanganList as $lapangan) {
            $idLapangan = $lapangan['id_lapangan'];
            $sumPlus = 0;
            $sumMin = 0;

            foreach ($kriteriaList as $kriteria) {
                $idKriteria = $kriteria['id_kriteria'];
                $y = $matriksY[$idLapangan][$idKriteria];
                $aPlus = $solusiIdealPositif[$idKriteria];
                $aMin = $solusiIdealNegatif[$idKriteria];

                $sumPlus += pow($y - $aPlus, 2);
                $sumMin += pow($y - $aMin, 2);
            }

            $jarakIdealPositif[$idLapangan] = round(sqrt($sumPlus), 5);
            $jarakIdealNegatif[$idLapangan] = round(sqrt($sumMin), 5);
        }
        // Nilai Preferensi (V)
        $nilaiPreferensi = [];

        foreach ($lapanganList as $lapangan) {
            $idLapangan = $lapangan['id_lapangan'];
            $dPlus = $jarakIdealPositif[$idLapangan];
            $dMin = $jarakIdealNegatif[$idLapangan];

            $v = ($dPlus + $dMin) != 0 ? $dMin / ($dPlus + $dMin) : 0;

            $nilaiPreferensi[] = [
                'id_lapangan' => $idLapangan,
                'nama' => $lapangan['nama'],
                'nilai' => round($v, 5),
            ];
        }

        // Urutkan berdasarkan nilai tertinggi
        usort($nilaiPreferensi, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        $this->hasilModel->truncate(); // Kosongkan dulu isi tabel hasil

        foreach ($nilaiPreferensi as $row) {
            $this->hasilModel->save([
                'id_lapangan' => $row['id_lapangan'],
                'nilai' => $row['nilai']
            ]);
        }

        session()->setFlashdata('successperhitungan', 'Perhitungan berhasil dilakukan dan disimpan.');
        // Kirim data ke view
        return view('pages/admin/perhitungan', [
            'kriteriaList' => $kriteriaList,
            'lapanganList' => $lapanganList,
            'matriksX' => $matriksX,
            'matriksR' => $matriksR,
            'matriksY' => $matriksY,
            'solusiIdealPositif' => $solusiIdealPositif,
            'solusiIdealNegatif' => $solusiIdealNegatif,
            'jarakIdealPositif' => $jarakIdealPositif,
            'jarakIdealNegatif' => $jarakIdealNegatif,
            'nilaiPreferensi' => $nilaiPreferensi,
            'penilaianLengkap' => true,
        ]);
    }
}
