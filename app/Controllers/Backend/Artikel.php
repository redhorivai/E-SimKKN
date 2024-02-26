<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\PenggunaModel;
use App\Libraries\Date\DateFunction;

class Artikel extends BaseController
{
    protected $m_artikel;
    protected $m_pengguna;
    protected $session;
    public function __construct()
    {
        $this->m_artikel  = new ArtikelModel();
        $this->m_pengguna = new PenggunaModel();
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
            'title'  => 'Artikel/Berita',
            'active' => 'artikel',
        ];
        return view('admin/artikel/index', $data);
    }
    public function getData()
    {
        $res = $this->m_artikel->getArtikel();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                $user = $this->m_pengguna->getByID($data->created_user);
                foreach ($user as $res) {
                    $admin = $res->name;
                }
                if ($data->type == "artikel"){
                    $type = "Artikel";
                } else {
                    $type = "Berita";
                }
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='artikel_id[]' class='checkedId' value='$data->artikel_id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                <img src='".base_url()."/image/artikel/$data->thumbnail_nm' class='wd-55'>
                                <div class='mg-l-15'>
                                <span class='tx-13'>".$type."</span>
                                <a href='javascript:void(0)' onclick='_detail(\"$data->artikel_id\")' class='tx-inverse tx-14 tx-medium d-block'>$data->title</a>
                                <span class='tx-13'>$admin | ".$this->date->panjang($data->created_dttm)."</span>
                                </div>
                                </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_btnEdit($data->artikel_id)'>
                                 <i class='icon-note'></i> <span style='vertical-align:text-top;'>Perubahan</span>
                                 </a>			  
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->artikel_id\",\"$data->title\")'>
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
    public function form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            if ($id == "") {
                
                $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Tambah Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                csrf_field();
                
                $ret .= "
                <form class='form-data form-layout-1 forms'>
                    <div class='row'>
                    <div class='col-lg-3'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Kategori: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='type' name='type' data-placeholder='-- Pilih Kategori --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        <option value='artikel'>Artikel</option>
                        <option value='berita'>Berita</option>
                        </select>
                        </div>
                    </div>
                    <div class='col-lg-9'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='title' name='title' onchange='remove(id)'>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Isi/Deskripsi: <span class='tx-danger'>*</span></label>
                        <textarea rows='5' id='description' name='description' class='form-control' onchange='remove(id)'></textarea>
                        </div>
                    </div>
                    </div>
                    <div class='row tx-center'>
                    <div class='col-lg-12 tx-center'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Thumbnail:</label>
                        <div class='fileinput fileinput-new' data-provides='fileinput'>
                            <div class='fileinput-new thumbnail' style='height:175px;'>
                            <img src='".base_url()."/image/thumbnail/400x300.png'>
                            </div>
                            <div class='fileinput-preview fileinput-exists thumbnail' style='height:175px;'></div>
                            <div class='tx-center'>
                            <span class='btn btn-sm btn-outline-info btn-file' style='cursor:pointer;'>
                            <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                            <span class='fileinput-exists mr-1'>Change</span>
                                <input type='file' name='thumbnail_nm' id='thumbnail_nm'>
                            </span>
                            <a href='#' class='btn btn-sm btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;'>Remove</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class='row tx-center'>";
                    for ($i = 1; $i <= 6; $i++) {
                        if ($i == "1"){
                            $label = "Banner 1";
                            $value = "banner_nm";
                        } else {
                            $label = "Banner ".$i."";
                            $value = "banner_nm".$i."";
                        }
                        $ret .= "
                        <div class='col-sm-4 col-12 tx-center'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>".$label.":</label>
                        <div class='fileinput fileinput-new' data-provides='fileinput'>
                            <div class='fileinput-new thumbnail' style='height:175px;'>
                            <img src='".base_url()."/image/thumbnail/800x600.png'>
                            </div>
                            <div class='fileinput-preview fileinput-exists thumbnail' style='height:175px;'></div>
                            <div class='tx-center'>
                            <span class='btn btn-sm btn-outline-info btn-file' style='cursor:pointer;'>
                            <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                            <span class='fileinput-exists mr-1'>Change</span>
                                <input type='file' name='".$value."' id='".$value."'>
                            </span>
                            <a href='#' class='btn btn-sm btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;'>Remove</a>
                            </div>
                        </div>
                        </div>
                        </div>";
                    }
                    $ret .= "</div>
                    <hr>
                    <div class='form-layout-footer text-center mg-t-20'>
                    <button type='button' class='btn btn-info' onclick='_simpan()'>Simpan</button>
                    <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                    </div>
                </form>";
                $ret .= "<script>
                         $('.select2').select2();
                         $('#btnCancelForm').click(function() {
                            $('.form-data')[0].reset();
                            $('#title').removeClass('is-invalid');
                            $('#description').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } else {
                $res = $this->m_artikel->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1 forms'>
                    <input type='hidden' name='thumbnail_lama' id='thumbnail_lama' value='$key->thumbnail_nm'>
                    <input type='hidden' name='banner_lama' id='banner_lama' value='$key->banner_nm'>
                    <input type='hidden' name='banner_lama2' id='banner_lama2' value='$key->banner_nm2'>
                    <input type='hidden' name='banner_lama3' id='banner_lama3' value='$key->banner_nm3'>
                    <input type='hidden' name='banner_lama4' id='banner_lama4' value='$key->banner_nm4'>
                    <input type='hidden' name='banner_lama5' id='banner_lama5' value='$key->banner_nm5'>
                    <input type='hidden' name='banner_lama6' id='banner_lama6' value='$key->banner_nm6'>
                        <div class='row'>
                        <div class='col-lg-3'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Kategori: <span class='tx-danger'>*</span></label>
                            <select class='form-control select2' id='type' name='type' data-placeholder='-- Pilih Kategori --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            <option value='artikel' " . ($key->type == "artikel" ? "selected='selected'" : "") . ">Artikel</option>
                            <option value='berita' " . ($key->type == "berita" ? "selected='selected'" : "") . ">Berita</option>
                            </select>
                            </div>
                        </div>
                        <div class='col-lg-9'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='title' name='title' value='$key->title' onchange='remove(id)'>
                            </div>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Isi/Deskripsi: <span class='tx-danger'>*</span></label>
                            <textarea rows='5' id='description' name='description' class='form-control'>".$key->description."</textarea>
                            </div>
                        </div>
                        </div>
                        <div class='row tx-center'>
                        <div class='col-lg-12 tx-center'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Thumbnail:</label>
                            <div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:175px;'>
                                <img src='".base_url()."/image/artikel/$key->thumbnail_nm'>
                                </div>
                                <div class='fileinput-preview fileinput-exists thumbnail' style='height:175px;'></div>
                                <div class='tx-center'>
                                <span class='btn btn-sm btn-outline-info btn-file' style='cursor:pointer;'>
                                <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                                <span class='fileinput-exists mr-1'>Change</span>
                                  <input type='file' name='thumbnail_nm' id='thumbnail_nm'>
                                </span>
                                <a href='#' class='btn btn-sm btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;'>Remove</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class='row tx-center'>";
                    $g = array("",$key->banner_nm,$key->banner_nm2,$key->banner_nm3,$key->banner_nm4,$key->banner_nm5,$key->banner_nm6);
                    for ($i = 1; $i <= 6; $i++) {
                        if ($i == "1"){
                            $label = "Banner 1";
                            $value = "banner_nm";
                        } else {
                            $label = "Banner ".$i."";
                            $value = "banner_nm".$i."";
                        }
                        $ret .= "
                        <div class='col-sm-4 col-12 tx-center'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>".$label.":</label>
                            <div class='fileinput fileinput-new' data-provides='fileinput'>
                                <div class='fileinput-new thumbnail' style='height:175px;'>
                                <img src='".base_url()."/image/artikel/".$g[$i]."'>
                                </div>
                                <div class='fileinput-preview fileinput-exists thumbnail' style='height:175px;'></div>
                                <div class='tx-center'>
                                <span class='btn btn-sm btn-outline-info btn-file' style='cursor:pointer;'>
                                <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                                <span class='fileinput-exists mr-1'>Change</span>
                                    <input type='file' name='".$value."' id='".$value."'>
                                </span>
                                <a href='#' class='btn btn-sm btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;'>Remove</a>
                                </div>
                            </div>
                            </div>
                        </div>";
                    }
                    $ret .= "</div>
                        <hr>
                        <div class='form-layout-footer text-center mg-t-20'>
                        <button type='button' class='btn btn-success' onclick='_update($key->artikel_id)'>Update</button>
                        <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                        </div>
                    </form>";
                    $ret .= "<script>
                            $('.select2').select2();
                            $('#btnCancelForm').click(function() {
                                $('.form-data')[0].reset();
                                $('#title').removeClass('is-invalid');
                                $('#description').removeClass('is-invalid');
                                $('#formData').addClass('d-none');
                                $('#viewData').delay(100).fadeIn();
                            });
                            </script>";
                    return $ret;  
                }
            }
        } else {
            exit('Request Error');
        }
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $type        = $this->request->getPost('type');
            $title       = ucwords($this->request->getPost('title'));
            $description = $this->request->getPost('description');
            $thumbImg    = $this->request->getFile('thumbnail_nm');
            $bannerImg   = $this->request->getFile('banner_nm');
            $bannerImg2  = $this->request->getFile('banner_nm2');
            $bannerImg3  = $this->request->getFile('banner_nm3');
            $bannerImg4  = $this->request->getFile('banner_nm4');
            $bannerImg5  = $this->request->getFile('banner_nm5');
            $bannerImg6  = $this->request->getFile('banner_nm6');

            if ($thumbImg == "") {
                $thumbnail = '400x300.png';
            } else {
                $thumbnail = $thumbImg->getRandomName();
                $thumbImg->move('image/artikel/', $thumbnail);
            }
            if ($bannerImg == "") {
                $banner = '800x600.png';
            } else {
                $banner = $bannerImg->getRandomName();
                $bannerImg->move('image/artikel/', $banner);
            }
            if ($bannerImg2 == "") {
                $banner2 = '800x600.png';
            } else {
                $banner2 = $bannerImg2->getRandomName();
                $bannerImg2->move('image/artikel/', $banner2);
            }
            if ($bannerImg3 == "") {
                $banner3 = '800x600.png';
            } else {
                $banner3 = $bannerImg3->getRandomName();
                $bannerImg3->move('image/artikel/', $banner3);
            }
            if ($bannerImg4 == "") {
                $banner4 = '800x600.png';
            } else {
                $banner4 = $bannerImg4->getRandomName();
                $bannerImg4->move('image/artikel/', $banner4);
            }
            if ($bannerImg5 == "") {
                $banner5 = '800x600.png';
            } else {
                $banner5 = $bannerImg5->getRandomName();
                $bannerImg5->move('image/artikel/', $banner5);
            }
            if ($bannerImg6 == "") {
                $banner6 = '800x600.png';
            } else {
                $banner6 = $bannerImg6->getRandomName();
                $bannerImg6->move('image/artikel/', $banner6);
            }

            $data = [
                'type'         => $type,
                'title'        => ucwords($title),
                'description'  => $description,
                'thumbnail_nm' => $thumbnail,
                'banner_nm'    => $banner, 
                'banner_nm2'   => $banner2, 
                'banner_nm3'   => $banner3, 
                'banner_nm4'   => $banner4, 
                'banner_nm5'   => $banner5, 
                'banner_nm6'   => $banner6,
                'status_cd'    => 'normal',
                'created_user' => session()->get('user_id'),
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_artikel->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Judul: <b class='text-danger'>$title</b> sudah ada, silahkan coba yang lain.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id          = $this->request->getPost('id');
            $type        = $this->request->getPost('type');
            $title       = ucwords($this->request->getPost('title'));
            $description = $this->request->getPost('description');
            $thumbImg    = $this->request->getFile('thumbnail_nm');
            $thumb_lama  = $this->request->getVar('thumbnail_lama');

            $bannerImg   = $this->request->getFile('banner_nm');
            $banner_lama = $this->request->getVar('banner_lama');

            $bannerImg2   = $this->request->getFile('banner_nm2');
            $banner_lama2 = $this->request->getVar('banner_lama2');

            $bannerImg3   = $this->request->getFile('banner_nm3');
            $banner_lama3 = $this->request->getVar('banner_lama3');

            $bannerImg4   = $this->request->getFile('banner_nm4');
            $banner_lama4 = $this->request->getVar('banner_lama4');

            $bannerImg5   = $this->request->getFile('banner_nm5');
            $banner_lama5 = $this->request->getVar('banner_lama5');

            $bannerImg6   = $this->request->getFile('banner_nm6');
            $banner_lama6 = $this->request->getVar('banner_lama6');
            
            if ($thumbImg == null) {
                $thumbnail = $thumb_lama;
            } else {
                $thumbnail = $thumbImg->getRandomName();
                $thumbImg->move('image/artikel/', $thumbnail);
            }

            if ($bannerImg == null) {
                $banner = $banner_lama;
            } else {
                $banner = $bannerImg->getRandomName();
                $bannerImg->move('image/artikel/', $banner);
            }
            if ($bannerImg2 == null) {
                $banner2 = $banner_lama2;
            } else {
                $banner2 = $bannerImg2->getRandomName();
                $bannerImg2->move('image/artikel/', $banner2);
            }
            if ($bannerImg3 == null) {
                $banner3 = $banner_lama3;
            } else {
                $banner3 = $bannerImg3->getRandomName();
                $bannerImg3->move('image/artikel/', $banner3);
            }
            if ($bannerImg4 == null) {
                $banner4 = $banner_lama4;
            } else {
                $banner4 = $bannerImg4->getRandomName();
                $bannerImg4->move('image/artikel/', $banner4);
            }
            if ($bannerImg5 == null) {
                $banner5 = $banner_lama5;
            } else {
                $banner5 = $bannerImg5->getRandomName();
                $bannerImg5->move('image/artikel/', $banner5);
            }
            if ($bannerImg6 == null) {
                $banner6 = $banner_lama6;
            } else {
                $banner6 = $bannerImg6->getRandomName();
                $bannerImg6->move('image/artikel/', $banner6);
            }
            
            $data = [
                'type'         => $type,
                'title'        => ucwords($title),
                'type'         => $type,
                'description'  => $description,
                'thumbnail_nm' => $thumbnail,
                'banner_nm'    => $banner,
                'banner_nm2'   => $banner2,
                'banner_nm3'   => $banner3,
                'banner_nm4'   => $banner4,
                'banner_nm5'   => $banner5,
                'banner_nm6'   => $banner6,
                'status_cd'    => 'normal',
                'updated_user' => session()->get('user_id'),
                'updated_dttm' => date('Y-m-d H:i:s'),
            ];
            $update = $this->m_artikel->updateData($id, $data);
            if ($update == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Judul: <b class='text-danger'>$title</b> sudah ada, silahkan coba yang lain.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('artikel_id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->m_artikel->updateData($id, $data);
            $msg = ['sukses' => 'Artikel telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function multi_del()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('artikel_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++){
                $data = [
                    'nullified_user' => session()->get('user_id'),
                    'nullified_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'      => 'nullified',
                ];
                $this->m_artikel->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> artikel telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('artikel_id');
            $artikel = $this->m_artikel->getByID($id);

            $ret = "";
            $no = 1;
            foreach ($artikel as $key) {
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-header'>
                         <h5 class='text-center text-dark w-100'><b>".$key->title."</b><br><small class='w-100' style='font-size:12px;color:#888;'>Admin | ".$this->date->panjang($key->created_dttm)."</small></h5>
                         </div>
                         <div class='modal-body'>
                         <div class='bd rounded table-responsive table-hover' style='overflow-y:scroll;max-height:406px;padding:20px;'>
                         ".$key->description."
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
}