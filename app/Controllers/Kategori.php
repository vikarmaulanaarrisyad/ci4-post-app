<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelkategori;

class Kategori extends BaseController
{
    protected Modelkategori $kategori;

    public function __construct()
    {
        $this->kategori = new Modelkategori();
    }

    public function index(): string
    {
        try {
            $tombolCari = $this->request->getPost('tombolcari');
            if ($tombolCari) {
                $cari = $this->request->getPost('cari');
                session()->set('cari_kategori', $cari);
                return redirect()->to('/kategori');
            } else {
                session()->remove('cari_kategori');
            }

            $cari = session()->get('cari_kategori') ?? '';
            $dataKategori = $cari
                ? $this->kategori->cariData($cari)->paginate(5, 'kategori')
                : $this->kategori->paginate(5, 'kategori');

            $noHalaman = $this->request->getVar('page_kategori') ?? 1;

            $data = [
                'tampilData' => $dataKategori,
                'pager' => $this->kategori->pager,
                'noHalaman' => $noHalaman,
                'cari' => $cari
            ];
            return view('kategori/index', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error in Kategori Controller: ' . $e->getMessage());
            return redirect()->to('/kategori');
        }
    }

    public function formtambah()
    {
        return view('kategori/formtambah');
    }

    public function simpandata()
    {
        $namaKategori = $this->request->getVar('kategori_nama');
        $valid = $this->validate([
            'kategori_nama' => [
                'rules' => 'required',
                'label' => 'Nama Kategori',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('/kategori/formtambah')->withInput();
        }

        $this->kategori->insert(['kategori_nama' => $namaKategori]);
        session()->setFlashdata('success', 'Data kategori berhasil disimpan');
        return redirect()->to('/kategori');
    }

    public function formedit($id)
    {
        $rowData = $this->kategori->find($id);

        if ($rowData) {
            return view('kategori/formedit', [
                'id' => $id,
                'kategori_nama' => $rowData['kategori_nama'],
            ]);
        }

        session()->setFlashdata('errors', 'Data tidak ditemukan');
        return redirect()->to('/kategori');
    }

    public function updatedata()
    {
        $idKategori = $this->request->getVar('kategori_id');
        $namaKategori = $this->request->getVar('kategori_nama');
        $valid = $this->validate([
            'kategori_nama' => [
                'rules' => 'required',
                'label' => 'Nama Kategori',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('/kategori/formedit/' . $idKategori)->withInput();
        }

        $this->kategori->update($idKategori, ['kategori_nama' => $namaKategori]);
        session()->setFlashdata('success', 'Data kategori berhasil diupdate');
        return redirect()->to('/kategori');
    }

    public function hapus($id)
    {
        $rowData = $this->kategori->find($id);

        if ($rowData) {
            $this->kategori->delete($id);
            session()->setFlashdata('success', 'Data kategori berhasil dihapus');
        } else {
            session()->setFlashdata('errors', 'Data tidak ditemukan');
        }

        return redirect()->to('/kategori');
    }
}
