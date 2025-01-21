<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarang;
use App\Models\Modelkategori;
use App\Models\Modelsatuan;
use CodeIgniter\HTTP\ResponseInterface;

class Barang extends BaseController
{
    protected $barang;

    public function __construct()
    {
        $this->barang = new Modelbarang();
    }

    public function index()
    {
        $data = [
            'tampildata' => $this->barang->tampildata()
        ];

        return view('barang/index', $data);
    }

    public function tambah()
    {
        $modelKategori = new Modelkategori();
        $modelSatuan = new Modelsatuan();
        $dataKategori = $modelKategori->findAll();
        $dataSatuan = $modelSatuan->findAll();

        $data = [
            'datakategori' => $dataKategori,
            'datasatuan' => $dataSatuan,
        ];

        return view('barang/formtambah', $data);
    }

    public function simpandata() {}
}
