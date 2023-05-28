<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PublicAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Logika untuk memeriksa akses publik
        // Misalnya, jika $request->uri->getPath() adalah '/dashboard' atau '/sarana',
        // maka izinkan akses tanpa login.
        $path = $request->uri->getPath();
        if ($path === 'dashboard' || $path === 'sarana') {
            return;
        }

        // Jika tidak ada kondisi akses publik, maka lakukan penanganan login di sini.
        // Anda dapat mengarahkan pengguna ke halaman login atau mengambil tindakan lain sesuai kebutuhan.
        // Contoh:
        // return redirect()->to('/login');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah permintaan
    }
}
