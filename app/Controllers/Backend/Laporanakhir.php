<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\LaporanakhirModel;
use App\Libraries\Date\DateFunction;
use App\Libraries\fpdf\fpdf;

class Laporanakhir extends BaseController
{
    protected $m_laporanakhir;
    protected $session;
    public function __construct()
    {
        $this->m_laporanakhir = new LaporanakhirModel();
        $this->date = new DateFunction();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function report_akhir()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        $data = [
            'title'  => 'Laporan Akhir Mahasiswa',
            'active' => 'laporanakhir',
        ];
        return view('admin/laporanakhir/report', $data);
    }
    public function view_report()
    {
        if ($this->request->isAJAX()) {
            $tglAwal  = $this->request->getPost('tglAwal');
            $tglAkhir = $this->request->getPost('tglAkhir');
            $res = $this->m_laporanakhir->getLaporByTgl($tglAwal, $tglAkhir);
            $ret = "<div class='br-section-wrapper'>
                    <h6 class='tx-gray-800 tx-center tx-uppercase tx-bold mg-b-0'>Laporan Akhir Kelompok</h6>
                    <h6 class='mg-b-20 tx-gray-600 tx-center tx-bold'>Periode: <b class='text-danger'>".$this->date->panjang($tglAwal)."</b> - <b class='text-danger'>".$this->date->panjang($tglAkhir)."</b></h6><hr>";
                
                $ret .= "<table class='table table-bordered tx-dark'>
                         <thead style='background-color:rgba(214, 217, 218, 0.2)'>
                         <tr>
                         <th>Nama</th>
                         <th class='tx-center'>Kelompok</th>
                         <th class='tx-center'>File Laporan</th>
                         <th class='tx-center'>Nilai</th>
                         </tr>
                         </thead>
                         <tbody>";
                if (count($res) > 0) {
                    foreach ($res as $data) {
                        $ret .= "<tr>
                                 <td>".$data->name."</td>
                                 <td class='tx-center'>".$data->nama."</td>
                                 <td role='dialog' aria-hidden='true' class='tx-center'><a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block' style'
                                 style='color:#f90404;'>Lampiran ($data->jenis)</a></td>
                                 <td class='tx-center'><button type='button' class='btn btn-primary tx-12 tx-uppercase tx-mont tx-medium' style='min-width:50px;' onclick='_btnCek(\"$data->id\")'><span style='vertical-align:middle;'>Input</span></button></td>
                                 </tr>";
                    }
                } else {
                    $ret .= "<tr><td style='text-align:center;' colspan='4'>Tidak ada yang ditemukan.</td></tr>";
                }
                $ret .= "</tbody>
                         <tfoot>
                         <tr>
                         <td colspan='4' class='text-center'>
                         <a href='".base_url()."/lapor/print_report' target='_blank' class='btn btn-outline-secondary tx-12 tx-uppercase tx-mont tx-medium'>
                         <span style='vertical-align:middle;'>Cetak Laporan</span>
                         </a>
                         </td>
                         </tr>
                         </tfoot>
                         </table>";
                return $ret;
        } else {
            exit('Request Error');
        }
    }
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('id');
            $ket = $this->m_laporanakhir->getByID($id);
            $ret = "";
            $no = 1;
            foreach ($ket as $key) {

                if ($key->jenis == 'dokumen') {
                    $jenis = 'Laporan Dokumen';
                    $path_file = "<div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:500px;'>
                                <embed src='".base_url()."/assets-admin/panel/document/laporan_akhir_mahasiswa/$key->path' width='750px' height='1000px' />
                                </div>
                                </div>";
                } elseif ($key->jenis == 'jurnal') {
                    $jenis = 'Laporan Jurnal';
                    $path_file = "<div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:500px;'>
                                <embed src='".base_url()."/assets-admin/panel/document/laporan_akhir_mahasiswa/$key->path' width='750px' height='1000px' />
                                </div>
                                </div>";
                }
                else {
                    $jenis = 'Laporan Video';
                    $path_file = "<div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:500px;'>
                                <embed src='$key->link' width='750px' height='500px' allowfullscreen />
                                </div>
                                </div>";
                }

                $keterangan = strtoupper($key->keterangan);
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-body'>
                         <div class='bd rounded table-responsive table-hover tx-bold text-center' style='overflow-y:scroll;max-height:406px;padding:20px;'>$keterangan ($jenis)
                         </div>
                         <label class='form-control-label'><a class='text-center'>File Laporan:</a></label>
                            $path_file
                         </div>
                         <div class='modal-footer'>
                         <button type='button' class='btn btn-block btn-light' data-dismiss='modal' style='font-size:11px;'>Tutup
                         </button>
                         </div>
                         </div>
                         </div>";
            }
            return $ret;
        } else {
            exit('Request Error');
        }
    }
    public function ceknilai()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('id');
            $ket = $this->m_laporanakhir->getByIDNilai($id);
            $ret = "";
            $no = 1;
            foreach ($ket as $key) {

                // $judul = strtoupper($key->judul);
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-body'>
                         <div class='bd rounded table-responsive table-hover tx-bold text-center' style='overflow-y:scroll;max-height:406px;padding:20px;'>DATA NILAI MAHASISWA
                         </div>
                         <form class='form-data form-layout-1'>
                    <div class='row'>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='keterangan' name='keterangan' value='$key->keterangan' disabled>
                        </div>
                    </div>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Kelompok: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='kelompok_id' name='kelompok_id' value='$key->nama' disabled>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Nama Mahasiswa: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='user_id' name='user_id' value='$key->name' disabled>
                        </div>
                    </div>
                    <div class='col-lg-6'>
                    <div class='form-group'>
                    <label class='form-control-label tx-bold'>Nilai Mahasiswa: <span class='tx-danger'>*</span></label>
                    <input class='form-control' type='text' id='nilai' name='nilai' value='$key->nilai' onchange='remove(id)'>
                    </div>
                    </div>
                    </div>
                    <hr>
                    <div class='form-layout-footer text-center mg-t-20'>
                    <button type='button' class='btn btn-info' onclick='_simpan($key->id)'>Simpan</button>
                    </div>
                    </form>
                         </div>
                         <div class='modal-footer'>
                         <button type='button' class='btn btn-block btn-light' data-dismiss='modal' style='font-size:11px;'>Tutup
                         </button>
                         </div>
                         </div>
                         </div>";
                $ret .= "<script>
                    $('.select2').select2();
                    $('#btnCancelForm').click(function() {
                    $('.form-data')[0].reset();
                    $('#nilai').removeClass('is-invalid');
                    $('#formData').addClass('d-none');
                    $('#viewData').delay(100).fadeIn();
                    });
                    </script>";
            }
            return $ret;
        } else {
            exit('Request Error');
        }
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $id       = $this->request->getPost('id');
            $nilai     = $this->request->getPost('nilai');
            $data = [
                'nilai'         => $nilai,
                'updated_by' => session()->get('user_id'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_laporanakhir->insertData($id, $data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Menambahkan: <b class='text-danger'>$nilai</b> sudah ada, silahkan coba yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
}