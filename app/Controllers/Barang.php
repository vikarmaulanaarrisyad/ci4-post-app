<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarang;
use App\Models\Modelkategori;
use App\Models\Modelsatuan;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;

class Barang extends BaseController
{
    protected Modelbarang $barang;

    public function __construct()
    {
        $this->barang = new Modelbarang();
    }

    public function index()
    {
        $modalKategori = new Modelkategori();

        return view('barang/viewbarang_new', [
            'datakategori' => $modalKategori->findAll()
        ]);
    }

    public function listData()
    {
        if ($this->request->isAJAX()) {
            $db = db_connect();
            $builder = $db->table('barang')
                ->select('barang_kode, barang_nama, kategori_id, barang_harga, barang_stok, kategori_nama')
                ->join('kategori', 'barang.kategori_id = kategori.id');

            return DataTable::of($builder)
                ->addNumbering('no')
                ->filter(function ($builder, $request) {
                    if ($request->kategori) {
                        $builder->where('kategori_id', $request->kategori);
                    }
                })
                ->add('action', function ($row) {
                    return '
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus(\'' . $row->barang_kode . '\')"><i class="fas fa-trash-alt"></i></button>
                    <button type="button" class="btn btn-info btn-sm" onclick="edit(\'' . $row->barang_kode . '\')"><i class="fas fa-edit"></i></button>
                    
                    ';
                })
                ->toJson(true);
        }
    }

    public function tambah()
    {
        $modelKategori = new Modelkategori();
        $dataKategori = $modelKategori->findAll();

        $data = [
            'datakategori' => $dataKategori,
        ];

        return view('barang/formtambah', $data);
    }

    public function simpandata()
    {
        $barangKode = $this->request->getVar('barang_kode');
        $barangNama = $this->request->getVar('barang_nama');
        $kategoriId = $this->request->getVar('kategori_id');
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
                'barang_harga' => $barangHarga,
                'barang_stok' => $barangStok,
                'barang_gambar' => $pathGambar,
            ]);

            session()->setFlashdata('success', 'Data barang berhasil disimpan');
            return redirect()->to('/barang/tambah');
        }
    }

    public function edit($kode)
    {
        // Cari data barang berdasarkan kode
        $barangData = $this->barang->where('barang_kode', $kode)->first();

        // Periksa apakah data ditemukan
        if ($barangData) {
            // Inisialisasi model kategori dan satuan
            $kategoriModel = new Modelkategori();

            // Siapkan data untuk dikirim ke view
            $data = [
                'barang_kode'   => $barangData['barang_kode'],
                'barang_nama'   => $barangData['barang_nama'],
                'kategori_id'   => $barangData['kategori_id'],
                'barang_harga'  => $barangData['barang_harga'],
                'barang_stok'   => $barangData['barang_stok'],
                'datakategori'  => $kategoriModel->findAll(),
                'barang_gambar' => $barangData['barang_gambar']
            ];

            // Tampilkan halaman form edit dengan data
            return view('barang/formedit', $data);
        } else {
            // Set pesan flash jika data tidak ditemukan
            session()->setFlashdata('errors', 'Data barang tidak ditemukan.');
            return redirect()->to('/barang');
        }
    }

    public function updatedata()
    {
        $barangKode = $this->request->getVar('barang_kode');
        $barangNama = $this->request->getVar('barang_nama');
        $kategoriId = $this->request->getVar('kategori_id');
        $barangHarga = $this->request->getVar('barang_harga');
        $barangStok = $this->request->getVar('barang_stok');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
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
            $cekData = $this->barang->where('barang_kode', $barangKode)->first();
            $pathGambarLama = $cekData['barang_gambar'];

            // Ambil file gambar dari request
            $gambar = $this->request->getFile('gambar');

            // Pastikan file yang diupload valid
            if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
                // Hapus gambar lama jika ada
                if ($pathGambarLama != '' && $pathGambarLama != NULL && file_exists($pathGambarLama)) {
                    unlink($pathGambarLama); // Menghapus gambar lama
                }

                // Tentukan nama file gambar baru berdasarkan kode barang
                $namaFileGambar = $barangKode . '.' . $gambar->getExtension();

                // Pindahkan gambar baru ke folder upload
                $gambar->move('upload', $namaFileGambar);

                // Set path gambar baru
                $pathGambar = 'upload/' . $namaFileGambar;
            } else {
                // Gunakan path gambar lama jika tidak ada gambar baru
                $pathGambar = $pathGambarLama;
            }

            // update ke dalam database
            $this->barang->update($cekData['id'], [
                'barang_nama' => $barangNama,
                'kategori_id' => $kategoriId,
                'barang_harga' => $barangHarga,
                'barang_stok' => $barangStok,
                'barang_gambar' => $pathGambar,
            ]);

            session()->setFlashdata('success', 'Data barang berhasil disimpan');
            return redirect()->to('/barang');
        }
    }

    public function hapus($kode)
    {
        try {
            // Cari data barang berdasarkan kode
            $barangData = $this->barang->where('barang_kode', $kode)->first();

            if (!$barangData) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data barang tidak ditemukan.'
                ]);
            }

            // Ambil path gambar lama
            $pathGambarLama = $barangData['barang_gambar'];

            // Hapus gambar lama jika ada dan file masih ada di server
            if ($pathGambarLama && file_exists($pathGambarLama)) {
                if (!unlink($pathGambarLama)) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Gagal menghapus gambar.'
                    ]);
                }
            }

            // Hapus data barang berdasarkan id
            if (!$this->barang->delete($barangData['id'])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menghapus data barang.'
                ]);
            }

            // Set pesan sukses
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data barang berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            // Tangani error tak terduga
            log_message('error', 'Error saat menghapus barang: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data barang.'
            ]);
        }
    }


    public function hapus1($kode)
    {
        // Cari data barang berdasarkan kode
        $barangData = $this->barang->where('barang_kode', $kode)->first();

        if ($barangData) {
            // Ambil path gambar lama
            $pathGambarLama = $barangData['barang_gambar'];

            // Hapus gambar lama jika ada
            if ($pathGambarLama && file_exists($pathGambarLama)) {
                unlink($pathGambarLama); // Menghapus file gambar
            }

            // Hapus data barang berdasarkan id
            $this->barang->delete($barangData['id']);

            // Set pesan sukses setelah penghapusan
            session()->setFlashdata('success', 'Data barang berhasil dihapus');
            return redirect()->to('/barang');
        } else {
            // Set pesan error jika barang tidak ditemukan
            session()->setFlashdata('errors', 'Data barang tidak ditemukan.');
            return redirect()->to('/barang');
        }
    }
}
