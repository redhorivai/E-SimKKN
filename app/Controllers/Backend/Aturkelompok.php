<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\AturkelompokModel;
use App\Libraries\Date\DateFunction;

class Aturkelompok extends BaseController
{
    protected $m_aturkelompok;
    protected $session;
    public function __construct()
    {
        $this->m_aturkelompok = new AturkelompokModel();
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
            'title'  => 'Atur Kelompok',
            'active' => 'aturkelompok',
        ];
        return view('admin/aturkelompok/index', $data);
    }
    public function getData()
    {
        $res = $this->m_aturkelompok->getAturkelompok();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                if ($data->semester_cd == 'ganjil') {
                    $stat = 'Ganjil';
                } else {
                    $stat = 'Genap';
                }
                $nm = strtoupper($data->nama);
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                <input type='checkbox' name='id[]' class='checkedId' value='$data->id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                <div class='mg-l-15'>
                                <a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block'><b>" . $nm . " | Semester ($stat)</b></a>
                                <p class='mb-0 tx-13'>Periode $data->periode_nm | " . $this->date->panjang($data->tanggal_buka) . " - " . $this->date->panjang($data->tanggal_tutup) ."</p>
                                </div>
                                </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_btnEdit(\"$data->id\",\"$data->user_id\",\"$data->kelompok_id\")'>
                                 <i class='icon-note'></i> <span style='vertical-align:text-top;'>Perubahan</span>
                                 </a>			  
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$data->nama\")'>
                                 <i class='icon-trash'></i> <span style='vertical-align:text-top;'>Hapus</span>
                                 </a>
                                 </nav>
                                 </div>
                                 </div>",
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
    public function form_insert()
    {
        if ($this->request->isAJAX()) {
            $result1['data1'] = $this->m_aturkelompok->getUserID();
            $result2['data2'] = $this->m_aturkelompok->getByIDKelompok();
            $msg = [
                'data' => view('admin/aturkelompok/form_insert', $result1 + $result2),
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function form_update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $user_id = $this->request->getPost('user_id');
            $result1['data1'] = $this->m_aturkelompok->getByIDUserKelompok($id);
            $result2['data2'] = $this->m_aturkelompok->getByIDUser();
            $result3['data3'] = $this->m_aturkelompok->getByIDKelompok();
            // $result3['data3'] = $this->m_aturkelompok->getKelompokID($id);
            $msg = [
                'data' => view('admin/aturkelompok/form_update', $result1 + $result2 + $result3 ),
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $kelompok_id  = $this->request->getPost('kelompok_id');
            $user_id      = $this->request->getPost('user_id');
            $status_user        = $this->request->getPost('status_user');
            $jmldata = count($kelompok_id);
            for ($i = 0; $i < $jmldata; $i++) {
            $data= [
                'kelompok_id'    => $kelompok_id[$i],
                'user_id'        => $user_id[$i],
                'status_user'    => $status_user[$i],
                'status_cd'      => 'normal',
                'created_user'   => session()->get('user_id'),
                'created_dttm'   => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_aturkelompok->insertDataID($data);
            }
            if ($insert == true) {
                $msg = ["sukses" => "Data berhasil disimpan."];
            } else {
                $msg = ["gagal" => "Kelompok: <b class='text-danger'>$kelompok_id</b> sudah ada, silahkan coba yang lain."];
            }
        } else {
            $msg = ["error" => "Request Error"];
        }
        echo json_encode($msg);
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $chart_id        = $this->request->getPost('chart_id');
            $chart_category  = $this->request->getPost('chart_category');
            $chart_type      = $this->request->getPost('chart_type');
            $chart_nm        = $this->request->getPost('chart_nm');
            $chart_periode   = $this->request->getPost('chart_periode');
            $dataChart = [
                'chart_nm'       => strtoupper($chart_nm),
                'chart_periode'  => strtoupper($chart_periode),
                'chart_category' => $chart_category,
                'chart_type'     => $chart_type,
                'updated_user'   => session()->get('user_id'),
                'updated_dttm'   => date('Y-m-d H:i:s'),
            ];
            $updateChart = $this->m_chart->updateData($chart_id, $dataChart);
            if ($updateChart) {
                $indicator_id    = $this->request->getPost('indicator_id');
                $indicator_nm    = $this->request->getPost('indicator_nm');
                $indicator_value = $this->request->getPost('indicator_value');
                $jmldata = count($indicator_nm);
                for ($i = 0; $i < $jmldata; $i++) {
                    if(!empty($indicator_id[$i])) { 
                        $dataIndicator = [
                            'indicator_nm'    => ucwords($indicator_nm[$i]),
                            'indicator_value' => $indicator_value[$i],
                            'updated_user'    => session()->get('user_id'),
                            'updated_dttm'    => date('Y-m-d H:i:s'),
                        ];
                        $this->m_chart->updateDataIndicator($indicator_id[$i], $dataIndicator);
                    } 
                    else { 
                        $dataIndicator = [
                            'chart_id'        => $chart_id,
                            'indicator_nm'    => ucwords($indicator_nm[$i]),
                            'indicator_value' => $indicator_value[$i],
                            'created_user'    => session()->get('user_id'),
                            'created_dttm'    => date('Y-m-d H:i:s'),
                        ];
                        $this->m_chart->insertDataIndicator($dataIndicator); 
                    } 
                }
                $msg = ["sukses" => "Data berhasil diperbaharui."];
            } else {
                $msg = ["gagal" => "Periode: <b class='text-danger'>$chart_periode</b> sudah ada, silahkan coba yang lain."];
            }
        } else {
            $msg = ["error" => "Request Error"];
        }
        echo json_encode($msg);
    }
    // public function del_data()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('chart_id');
    //         $data = [
    //             'nullified_user' => session()->get('user_id'),
    //             'nullified_dttm' => date('Y-m-d H:i:s'),
    //             'status_cd'      => 'nullified',
    //         ];
    //         $this->m_chart->updateData($id, $data);
    //         $msg = ['sukses' => 'Data grafik telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function multi_del()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('chart_id');
    //         $jmldata = count($id);
    //         for ($i = 0; $i < $jmldata; $i++) {
    //             $data = [
    //                 'nullified_user' => session()->get('user_id'),
    //                 'nullified_dttm' => date('Y-m-d H:i:s'),
    //                 'status_cd'      => 'nullified',
    //             ];
    //             $this->m_chart->updateData($id[$i], $data);
    //         }
    //         $msg = ['sukses' => '<b style="margin-left:10px;"> ' . $jmldata . ' data</b> grafik telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function del_indicator()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('indicator_id');
    //         $data = [
    //             'status_cd'      => 'nullified',
    //             'nullified_user' => session()->get('user_id'),
    //             'nullified_dttm' => date('Y-m-d H:i:s'),
    //         ];
    //         $this->m_chart->updateDataIndicator($id, $data);
    //         $msg = ['sukses' => 'Data telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function detail()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id        = $this->request->getPost('chart_id');
    //         $chart     = $this->m_chart->getChartByID($id);
    //         $indicator = $this->m_chart->getIndicatorByID($id);
    //         $ret = "";
    //         $no = 1;
    //         foreach ($chart as $key) {
    //             $ret .= "<div class='modal-dialog modal-lg' role='document'>
    //                      <div class='modal-content'>
    //                      <div class='modal-header'>
    //                      <h5 class='text-center text-dark w-100'>" . $key->chart_nm . "<br>" . $key->chart_periode . "</h5>
    //                      </div>
    //                      <div class='modal-body'>
                         
    //                      <div class='bd rounded table-responsive table-hover' style='overflow-y:scroll;max-height:406px;'>
    //                      <table class='table table-bordered mg-b-0'>
    //                      <thead>
    //                      <tr>
    //                      <th class='text-center'>Indikator</th>
    //                      <th class='text-center'>Value (Nilai)</th>
    //                      </tr>
    //                      </thead>
    //                      <tbody>";
    //             foreach ($indicator as $key) {
    //                 $ret .= "<tr class='text-dark'>
    //                          <td>" . $no++ . ". " . $key->indicator_nm . "</td>
    //                          <td class='text-right'>" . $key->indicator_value . "</td>
    //                          </tr>";
    //             }
    //             $ret .= "</tbody>
    //                      </table>
    //                      </div>";

    //             $ret .= "</div>
    //                      <div class='modal-footer'>
    //                      <button type='button' class='btn btn-block btn-light' data-dismiss='modal' style='font-size:11px;'>Tutup
    //                      </button>
    //                      </div>
    //                      </div>
    //                      </div>";
    //         }
    //         return $ret;
    //     } else {
    //         exit('Request Error');
    //     }
    // }
}
