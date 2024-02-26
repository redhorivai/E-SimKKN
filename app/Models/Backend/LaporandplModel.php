<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LaporandplModel extends Model
{

    // public function getLaporandpl()
    // {
    //     $query = $this->db->table('laporan_dosen');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function cekTitle($judul)
    // {
    //     $query = $this->db->table('pengumuman');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('judul', $judul);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function getLaporandpl($user_id)
    {
        $query = $this->db->table('laporan_dosen a');
        $query->select('a.id,a.type,a.periode_id,a.keterangan,a.path,a.status_cd,b.periode_nm,b.semester_cd');
        $query->join('periode b', 'b.id=a.periode_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.created_user', $user_id);
        $query->orderBy('a.id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
            $query = $this->db->table('laporan_dosen');
            $ret =  $query->insert($data);
        return $ret;
    }
    public function getPeriode_id()
    {
        $query = $this->db->table('periode');
        $query->select('*');
        $query->where('status', '1');
        $return = $query->get();
        return $return->getResult();
    }
     public function updateData($id, $data)
    {
        $query = $this->db->table('laporan_dosen');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
    public function getByID($id)
    {
        $query = $this->db->table('laporan_dosen');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('pengumuman');
    //     $query->where('id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
    // public function getBerita()
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('type', 'berita');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('artikel_id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getSlider()
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('type', 'slider');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('artikel_id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getByID($id)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('artikel_id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function cekTitle($title)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('title', $title);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getLimit($limit)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('type', 'artikel');
    //     $query->orderBy('artikel_id', 'DESC');
    //     $query->limit($limit);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function insertData($data)
    // {
    //     $cek = $this->cekTitle($data['title']);
    //     if(count($cek) > 0) {
    //         $ret =  false;
    //     } else {
    //         $query = $this->db->table('bcms_artikel');
    //         $ret =  $query->insert($data);
    //     }
    //     return $ret;
    // }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->where('artikel_id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
}
