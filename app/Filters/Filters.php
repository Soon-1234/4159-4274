<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = $arguments[0] ?? 'client';

        if ($role === 'client') {
            if (!session()->get('isLoggedIn')) {
                return redirect()->to('/')->with('erreur', 'Veuillez vous connecter.');
            }
        }

        if ($role === 'admin') {
            if (!session()->get('isAdminLoggedIn')) {
                return redirect()->to('/admin/login')->with('erreur', 'Accès réservé aux administrateurs.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Rien à faire après la requête
    }
}
