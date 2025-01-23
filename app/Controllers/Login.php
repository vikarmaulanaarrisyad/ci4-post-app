<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modellogin;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        return view('login/index');
    }

    public function cekuser()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib disi',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib disi',
                ],
            ],
        ]);

        if (!$valid) {
            $sessError = [
                'username' => $validation->getError('username'),
                'password' => $validation->getError('password'),
            ];

            session()->setFlashdata($sessError);
            return redirect()->to(site_url('login'));
        } else {
            $modelLogin = new Modellogin();

            $cekUserLogin = $modelLogin->where('username', $username)->first();
            // cek user : user tidak terdaftar
            if ($cekUserLogin == null) {
                $sessError = [
                    'username' => 'Username tidak terdaftar',
                ];

                session()->setFlashdata($sessError);
                return redirect()->to(site_url('login'));
            } else {
                // user terdaftar, cek password
                $passwordUser = $cekUserLogin['password'];
                if (password_verify($password, $passwordUser)) {
                    // arahkan ke halaman dashboard
                    $idLevel = $cekUserLogin['level_id'];

                    // simpan session login
                    $simpanSession = [
                        'username' => $username,
                        'namauser' => $cekUserLogin['nama'],
                        'idlevel' => $idLevel
                    ];

                    session()->set($simpanSession);
                    return redirect()->to('/main');
                } else {
                    $sessError = [
                        'password' => 'Password yang anda masukkan salah.',
                    ];

                    session()->setFlashdata($sessError);
                    return redirect()->to(site_url('login'));
                }
            }
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('login');
    }
}
