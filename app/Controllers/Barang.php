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

    public function simpandata()
    {
        $barangKode = $this->request->getVar('barang_kode');
        $barangNama = $this->request->getVar('barang_nama');
        $kategoriId = $this->request->getVar('kategori_id');
        $satuanId = $this->request->getVar('satuan_id');
        $barangHarga = $this->request->getVar('barang_harga');
        $barangStok = $this->request->getVar('barang_stok');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'barang_kode' => [
                'rules' => 'required|is_unique[barang.barang_kode]',
                'label' => 'Kode Barang',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'is_unique' => '{field} kode barang sudah ada sebelumnya'
                ]
            ],
            'barang_nama' => [
                'rules' => 'required',
                'label' => 'Nama Barang',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ]
            ],
            'kategori_id' => [
                'rules' => 'required',
                'label' => 'Kategori',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ]
            ],
            'satuan_id' => [
                'rules' => 'required',
                'label' => 'Satuan',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ]
            ],
            'barang_harga' => [
                'rules' => 'required|numeric',
                'label' => 'Harga',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'numeric' => '{field} hanya dalam bentuk angka',
                ]
            ],
            'barang_stok' => [
                'rules' => 'required|numeric',
                'label' => 'Stok',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'numeric' => '{field} hanya dalam bentuk angka',
                ]
            ],
            'gambar' => [
                'rules' => 'mime_in[gambar,image/png, image/jpg, image/jpeg]|ext_in[gambar,png,jpg,jpeg]',
                'label' => 'Gambar',
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('/barang/tambah')->withInput();
        } else {
            $gambar = $_FILES['gambar']['name'];

            if ($gambar != NULL) {
                $namaFileGambar = $barangKode;
                $fileGambar = $this->request->getFile('gambar');
                $fileGambar->move('upload', $namaFileGambar . '.' . $fileGambar->getExtension());

                $pathGambar = 'upload/' . $fileGambar->getName();
            } else {
                $pathGambar = '';
            }

            // simpan ke dalam database
            $this->barang->insert([
                'barang_kode' => $barangKode,
                'barang_nama' => $barangNama,
                'kategori_id' => $kategoriId,
                'satuan_id' => $satuanId,
                'barang_harga' => $barangHarga,
                'barang_stok' => $barangStok,
                'gambar' => $pathGambar,
            ]);

            session()->setFlashdata('success', 'Data barang berhasil disimpan');
            return redirect()->to('/barang/tambah');
        }
    }
}
