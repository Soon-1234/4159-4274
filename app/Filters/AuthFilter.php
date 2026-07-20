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

        if ($role === 'operateur') {
            if (!session()->get('isOperateurLoggedIn')) {
                return redirect()->to('/operateur/login')->with('erreur', 'Veuillez vous connecter.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // rien
    }
}
