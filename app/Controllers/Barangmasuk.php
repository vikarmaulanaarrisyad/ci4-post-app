<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarangmasuk;
use App\Models\Modeltempbarangmasuk;
use CodeIgniter\HTTP\ResponseInterface;

class Barangmasuk extends BaseController
{
    public function index()
    {
        return view('barangmasuk/forminput');
    }
    public function dataTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');

            $modelBarangMasuk = new Modelbarangmasuk(); // Pastikan nama model benar
            $dataBarangMasuk = $modelBarangMasuk->getDataByFaktur($faktur); // Ambil data berdasarkan faktur

            if ($dataBarangMasuk) {
                $modelTemp = new Modeltempbarangmasuk();
                $data = [
                    'datatemp' => $modelTemp->tampilDataTemp($dataBarangMasuk['id'])
                ];

                $json = [
                    'data' => view('barangmasuk/datatemp', $data)
                ];
            } else {
                // Jika data barang masuk tidak ditemukan
                $json = [
                    'status' => 'error',
                    'message' => 'Data barang masuk tidak ditemukan untuk faktur ini.'
                ];
            }

            echo json_encode($json);
        } else {
            // Jika bukan permintaan AJAX
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ]);
        }
    }
}
