<?php

namespace App\Controllers;

use App\Libraries\Date\DateFunction;

class Verified extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->date    = new DateFunction();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $data = [
            'title' => 'Verified RSUD Palembang BARI',
            'menu'  => 'verified',
        ];
        return view('front/pages/verified/index', $data);
    }
}
