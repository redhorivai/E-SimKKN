<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\LaporanharianModel;
use App\Libraries\Date\DateFunction;

class RekapHarianNilaiMahasiswa extends BaseController
{
    protected $m_laporanharian;
    protected $session;
    public function __construct()
    {
        $this->m_laporanharian = new LaporanharianModel();
        $this->date = new DateFunction();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        $data = [
            'title'  => 'Data Pengaduan',
            'active' => 'rekapkegiatan',
        ];
        return view('admin/laporanharian/index', $data);
    }
    public function report_harian()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        $data = [
            'title'  => 'Report Pengaduan',
            'active' => 'laporanharian',
        ];
        return view('admin/laporanharian/report', $data);
    }
    public function getData()
    {
        $user_id = session()->get('user_id');
        $res = $this->m_harian->getHarian($user_id);
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {

                if ($data->semester_cd == 'ganjil') {
                    $stat_semester_cd = 'Ganjil';
                } else {
                    $stat_semester_cd = 'Genap';
                }
                $judul = strtoupper($data->judul);
                $start_date = $this->date->panjang($data->tanggal_buka);
                $end_date = $this->date->panjang($data->tanggal_tutup);

                $pdf_foto = "<img src='" . base_url() . "/image/pdf.png' class='wd-40 ht-40 rounded-circle'>";
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                 " . $pdf_foto . "
                                 <div class='mg-l-15'>
                                 <p class='mb-0 tx-13'>
                                 <a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block'>$judul</a>
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:3px;'>Kelompok</b> <b>:</b> $data->nama
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:26px;'>Dosen</b> <b>:</b> $data->name
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:18px;'>Periode</b> <b>:</b> $data->periode_nm | $start_date s/d $end_date
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:7px;'>Semester</b> <b>:</b> $stat_semester_cd
                                 </p>
                                 </div>
                                 </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$judul\")'>
                                 <i class='icon-trash'></i> <span style='vertical-align:text-top;'>Hapus</span>
                                 </a>
                                 </nav>
                                 </div>
                                 </div>",
                );
                $ret = array('data' => $output);
            }
        } else {
            $ret = array('data' => []);
        }
        return $this->response->setJSON($ret);
    }

    public function view_report()
    {
        if ($this->request->isAJAX()) {
            $tglAwal  = $this->request->getPost('tglAwal');
            $tglAkhir = $this->request->getPost('tglAkhir');
            $user_id     = session()->get('user_id');
            $res = $this->m_laporanharian->getLaporByTgl($tglAwal, $tglAkhir, $user_id);
            $ret = "<div class='br-section-wrapper'>
                    <h6 class='tx-gray-800 tx-center tx-uppercase tx-bold mg-b-0'>Laporan Harian Mahasiswa</h6>
                    <h6 class='mg-b-20 tx-gray-600 tx-center tx-bold'>Periode: <b class='text-danger'>" . $this->date->panjang($tglAwal) . "</b> - <b class='text-danger'>" . $this->date->panjang($tglAkhir) . "</b></h6><hr>";

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
                                 <td>" . $data->name . "</td>
                                 <td class='tx-center'>" . $data->nama . "</td>
                                 <td role='dialog' aria-hidden='true' class='tx-center'><a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block' style'
                                 style='color:#f90404;'>Lampiran</a></td>
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
                         <a href='" . base_url() . "/lapor/print_report' target='_blank' class='btn btn-outline-secondary tx-12 tx-uppercase tx-mont tx-medium'>
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
}
