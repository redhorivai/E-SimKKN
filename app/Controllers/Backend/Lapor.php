<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\LayananModel;
use App\Libraries\Date\DateFunction;
use App\Libraries\fpdf\fpdf;

class Lapor extends BaseController
{
    protected $m_layanan;
    protected $session;
    public function __construct()
    {
        $this->m_layanan = new LayananModel();
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
            'active' => 'lapor',
        ];
        return view('admin/lapor/index', $data);
    }
    public function report_lapor()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        $data = [
            'title'  => 'Report Pengaduan',
            'active' => 'reportlapor',
        ];
        return view('admin/lapor/report', $data);
    }
    public function getData()
    {
        $res = $this->m_layanan->getLapor();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                if (session()->get('level') == 'Super User') {
                    $checkbox = "<div class='valign-middle'>
                                 <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='lapor_id[]' class='checkedId' value='$data->lapor_id'><span></span>
                                 </label>
                                 </div>";
                    $button = "<div class='dropdown tx-center'>
                               <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                               <i class='icon-grid' style='vertical-align:inherit;'></i>
                               </a>		
                               <div class='dropdown-menu dropdown-menu-right pd-10'>
                               <nav class='nav nav-style-2 flex-column'>			  
                               <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->lapor_id\",\"$data->nama\")'>
                               <i class='icon-trash'></i> <span style='vertical-align:text-top;'>Hapus</span>
                               </a>
                               </nav>
                               </div>
                               </div>";
                } else {
                    $checkbox = "<div class='valign-middle tx-center tx-dark'>".$nomor++.".</div>";
                    $button = "";
                }
                $output[] = array(
                    'cek'   => "".$checkbox."",
                    'col'   => "<div class='d-flex align-items-center'>
                                <div class='mg-l-15'>
                                <span class='tx-13'><b>".$this->date->panjang($data->lapor_dttm)."</b></span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Nama<span style='margin-left:21px;'>:</span></b> $data->nama</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>e-Mail<span style='margin-left:20px;'>:</span></b> $data->email</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Telepon<span style='margin-left:7px;'>:</span></b> $data->telepon</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Pesan<span style='margin-left:19px;'>:</span></b> $data->pesan</span>
                                </div>
                                </div>",
                    'action' => "".$button."",
                );
                $ret = array(
                    'data' => $output,
                );
            }
        } else {
            $ret = array(
                'data' => [],
            );
        }
        return $this->response->setJSON($ret);
    }
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('lapor_id');
            $data = [
                'status_cd' => 'nullified',
            ];
            $this->m_layanan->updateDataLapor($id, $data);
            $msg = ['sukses' => 'Data Pengaduan telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function multi_del()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('lapor_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++){
                $data = [
                    'status_cd' => 'nullified',
                ];
                $this->m_layanan->updateDataLapor($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> Pengaduan telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function view_report()
    {
        if ($this->request->isAJAX()) {
            $tglAwal  = $this->request->getPost('tglAwal');
            $tglAkhir = $this->request->getPost('tglAkhir');
            $res = $this->m_layanan->getLaporByTgl($tglAwal, $tglAkhir);
            $ret = "<div class='br-section-wrapper'>
                    <h6 class='tx-gray-800 tx-center tx-uppercase tx-bold mg-b-0'>Report Pengaduan</h6>
                    <h6 class='mg-b-20 tx-gray-600 tx-center tx-bold'>Periode: <b class='text-danger'>".$this->date->panjang($tglAwal)."</b> - <b class='text-danger'>".$this->date->panjang($tglAkhir)."</b></h6><hr>";
                
                $ret .= "<table class='table table-bordered tx-dark'>
                         <thead style='background-color:rgba(214, 217, 218, 0.2)'>
                         <tr>
                         <th>Nama</th>
                         <th>Telepon</th>
                         <th>e-Mail</th>
                         <th>Pesan</th>
                         </tr>
                         </thead>
                         <tbody>";
                if (count($res) > 0) {
                    foreach ($res as $data) {
                        $ret .= "<tr>
                                 <td>".$data->nama."</td>
                                 <td>".$data->telepon."</td>
                                 <td>".$data->email."</td>
                                 <td>".$data->pesan."</td>
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
    
    public function print_report()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        // $tglAwal  = $this->input->get('var1');
        // $tglAkhir = $this->input->get('var2');
        // $res = $this->m_layanan->getLaporByTgl($tglAwal, $tglAkhir);
        
        // $nama = $res[0]->nama;

        $pdf = new FPDF();
        $pdf->AddPage('P', 'A4');
        $pdf->setFont('Arial', 'B', 8);
        $pdf->Cell(90, 1, 'LAPORAN', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(90, 5, '', 0, 1, 'C');
        $pdf->setFont('Arial', 'BI', 14);
        $pdf->Cell(90, 0, 'RSUD PALEMBANG BARI', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->SetLineWidth(1.2);
        $pdf->Line(6, 21, 104, 21);
        $pdf->Ln(9);

        $pdf->setX('30');
        $pdf->setFont('Arial', 'B', 7);
        $pdf->Cell(16, 4, 'Nama', 0, 0, 'L');
        $pdf->Cell(1, 4, ':', 0, 0, 'L');
        $pdf->setFont('Arial', '', 7);
        $pdf->Cell(53, 4, 'MAMAN', 0, 1, 'L');
        $pdf->Ln(2);

        $pdf->Output('report_pengaduan.pdf', 'I');
        exit();
        // $data = [
        //     'title'  => 'Report Pengaduan',
        //     'active' => 'reportlapor',
        // ];
        // return view('admin/lapor/index');
    }
}