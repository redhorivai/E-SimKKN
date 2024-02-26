<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\LaporanharianModel;
use App\Libraries\Date\DateFunction;
use App\Libraries\fpdf\fpdf;

class Laporanharian extends BaseController
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
                         <td colspan='4' class='text-center' ><button type='button' class='btn btn-danger tx-12 tx-uppercase tx-mont tx-medium' style='min-width:50px;'><a style='color:#fff;' href=".(base_url().'panel/rekap-nilai-mahasiswa'.$data->kelompok_id)." onclick='_btnCek(\"$data->kelompok_id\")><span style='vertical-align:middle;'>Rekap Nilai</span></button></a>
                         </td>
                         </tr>
                         </tfoot>
                         </table>";
                         
            return $ret;
        } else {
            exit('Request Error');
        }
    }
    // public function view_report_2($tglAwal, $tglAkhir)
    // {
        
    //     $user_id     = session()->get('user_id');
    //     $res = $this->m_laporanharian->getLaporByTgl($tglAwal, $tglAkhir, $user_id);
    //     // print_r($res);
    //     $tgl_awal = $this->date->panjang($tglAwal);
    //     $tgl_akhir = $this->date->panjang($tglAkhir);
    //     $data = [
    //         'title'  => 'Report Pengaduan',
    //         'active' => 'laporanharian',
    //         'res'    => $res,
    //         'tglAwal' => $tgl_awal,
    //         'tglAkhir' => $tgl_akhir,
    //         'tglAwalm' => $tglAwal,
    //         'tglAkhirm' => $tglAkhir
    //     ];
    //     return view('admin/laporanharian/report2', $data);
    //     // if ($this->request->isAJAX()) {
    //     //     $user_id     = session()->get('user_id');
    //     //     $res = $this->m_laporanharian->getLaporByTgl($tglAwal, $tglAkhir, $user_id);
    //     //     $ret = "<div class='br-section-wrapper'>
    //     //             <h6 class='tx-gray-800 tx-center tx-uppercase tx-bold mg-b-0'>Laporan Harian Mahasiswa</h6>
    //     //             <h6 class='mg-b-20 tx-gray-600 tx-center tx-bold'>Periode: <b class='text-danger'>".$this->date->panjang($tglAwal)."</b> - <b class='text-danger'>".$this->date->panjang($tglAkhir)."</b></h6><hr>";

    //     //         $ret .= "<table class='table table-bordered tx-dark'>
    //     //                  <thead style='background-color:rgba(214, 217, 218, 0.2)'>
    //     //                  <tr>
    //     //                  <th>Nama</th>
    //     //                  <th class='tx-center'>Kelompok</th>
    //     //                  <th class='tx-center'>File Laporan</th>
    //     //                  <th class='tx-center'>Nilai</th>
    //     //                  </tr>
    //     //                  </thead>
    //     //                  <tbody>";
    //     //         if (count($res) > 0) {
    //     //             foreach ($res as $data) {
    //     //                 $ret .= "<tr>
    //     //                          <td>".$data->name."</td>
    //     //                          <td class='tx-center'>".$data->nama."</td>
    //     //                          <td role='dialog' aria-hidden='true' class='tx-center'><a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block' style'
    //     //                          style='color:#f90404;'>Lampiran</a></td>
    //     //                          <td class='tx-center'><button type='button' class='btn btn-primary tx-12 tx-uppercase tx-mont tx-medium' style='min-width:50px;' onclick='_btnCek(\"$data->id\")'><span style='vertical-align:middle;'>Input</span></button></td>
    //     //                          </tr>";
    //     //             }
    //     //         } else {
    //     //             $ret .= "<tr><td style='text-align:center;' colspan='4'>Tidak ada yang ditemukan.</td></tr>";
    //     //         }
    //     //         $ret .= "</tbody>
    //     //                  <tfoot>
    //     //                  <tr>
    //     //                  <td colspan='4' class='text-center'>
    //     //                  <a href='".base_url()."/lapor/print_report' target='_blank' class='btn btn-outline-secondary tx-12 tx-uppercase tx-mont tx-medium'>
    //     //                  <span style='vertical-align:middle;'>Cetak Laporan</span>
    //     //                  </a>
    //     //                  </td>
    //     //                  </tr>
    //     //                  </tfoot>
    //     //                  </table>";
    //     //         return $ret;
    //     // } else {
    //     //     exit('Request Error');
    //     // }
    // }
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('id');
            $ket = $this->m_laporanharian->getByID($id);
            $ret = "";
            $no = 1;
            foreach ($ket as $key) {

                $judul = strtoupper($key->judul);
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-body'>
                         <div class='bd rounded table-responsive table-hover tx-bold text-center' style='overflow-y:scroll;max-height:406px;padding:20px;'>$judul
                         </div>
                         <labev class='form-control-label'><a class='text-center'>File Surat:</a></labev>
                            <div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:500px;'>
                                <embed src='" . base_url() . "/assets-admin/panel/document/laporan_harian_mahasiswa/$key->dokumen' width='750px' height='1000px' />
                                </div>
                            </div>
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
            $ket = $this->m_laporanharian->getByIDNilai($id);
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
                        <input class='form-control' type='text' id='judul' name='judul' value='$key->judul' disabled>
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
            $insert = $this->m_laporanharian->insertData($id, $data);
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
    // public function print_report()
    // {
    //     if (session()->get('username') == '') {
    //         session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
    //         return redirect()->to(base_url('/panel'));
    //     }
    //     // $tglAwal  = $this->input->get('var1');
    //     // $tglAkhir = $this->input->get('var2');
    //     // $res = $this->m_layanan->getLaporByTgl($tglAwal, $tglAkhir);

    //     // $nama = $res[0]->nama;

    //     $pdf = new FPDF();
    //     $pdf->AddPage('P', 'A4');
    //     $pdf->setFont('Arial', 'B', 8);
    //     $pdf->Cell(90, 1, 'LAPORAN', 0, 0, 'C');
    //     $pdf->Cell(10, 5, '', 0, 0, 'C');
    //     $pdf->Cell(90, 5, '', 0, 1, 'C');
    //     $pdf->setFont('Arial', 'BI', 14);
    //     $pdf->Cell(90, 0, 'RSUD PALEMBANG BARI', 0, 0, 'C');
    //     $pdf->Cell(10, 5, '', 0, 0, 'C');
    //     $pdf->SetLineWidth(1.2);
    //     $pdf->Line(6, 21, 104, 21);
    //     $pdf->Ln(9);

    //     $pdf->setX('30');
    //     $pdf->setFont('Arial', 'B', 7);
    //     $pdf->Cell(16, 4, 'Nama', 0, 0, 'L');
    //     $pdf->Cell(1, 4, ':', 0, 0, 'L');
    //     $pdf->setFont('Arial', '', 7);
    //     $pdf->Cell(53, 4, 'MAMAN', 0, 1, 'L');
    //     $pdf->Ln(2);

    //     $pdf->Output('report_pengaduan.pdf', 'I');
    //     exit();
    //     // $data = [
    //     //     'title'  => 'Report Pengaduan',
    //     //     'active' => 'reportlapor',
    //     // ];
    //     // return view('admin/lapor/index');
    // }
    public function rekap_nilai_mahasiswa()
    {
        $user_id     = session()->get('user_id');
        $data = [
            'title'  => 'Rekap Data Harian Mahasiswa',
            'active' => 'rekapkegiatan',
            'user_id' => $user_id
        ];
        return view('admin/laporanharian/rekapnilaimahasiswa', $data);
    }
}
