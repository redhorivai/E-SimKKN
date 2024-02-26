<?php

namespace App\Controllers;

class Instalasi_IT extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'menu'  => 'home',
        ];
        return view('instalasi_it/pages/beranda', $data);
    }
}
