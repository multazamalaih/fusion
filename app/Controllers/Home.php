<?php

namespace App\Controllers;

use App\Models\FotoModel;
use App\Models\HasilModel;
use App\Models\KriteriaModel;

class Home extends BaseController
{
    protected $hasilModel;
    protected $fotoLapanganModel;
    protected $kriteriaModel;
    public function __construct()
    {
        $this->hasilModel = new HasilModel();
        $this->fotoLapanganModel = new FotoModel();
        $this->kriteriaModel = new KriteriaModel();
    }
    public function index(): string
    {
        $userSession = session()->get('user');
        $data = [
            'isLogin' => $userSession ? true : false
        ];
        return view('pages/home', $data);
    }
    public function about(): string
    {
        return view('pages/about');
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
    public function kontakKami()
    {
        return view('pages/kontak-kami');
    }
    public function detailLapangan($id_lapangan)
    {
        return view('pages/detail-lapangan');
    }
}
