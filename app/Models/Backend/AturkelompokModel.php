<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class AturkelompokModel extends Model
{
    public function getAturkelompok()
    {
        $query = $this->db->table('user_kelompok a');
        $query->select('a.id,a.user_id,a.kelompok_id,a.status_user,a.created_user,b.nama,c.periode_nm,c.semester_cd,c.tanggal_buka,c.tanggal_tutup');
        $query->join('kelompok b', 'b.id=a.kelompok_id', 'left');
        $query->join('periode c', 'c.id=b.periode_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.status_user', 'ketua');
        $query->orderBy('a.id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getUserID()
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('level !=', 'Super User');
        $query->where('status_acc', 'active');
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function getKelompokID()
    {
        $query = $this->db->table('kelompok');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function getByIDUserKelompok($id)
    {
        $query = $this->db->table('user_kelompok');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function getByIDUser()
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('level !=', 'Super User');
        $query->where('status_acc', 'active');
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();   
    }
    public function getByIDKelompok()
    {
        $query = $this->db->table('kelompok');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();   
    }
        
    // public function getAllID()
    // {
    //     $query = $this->db->table('user_kelompok');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getAllID($id)
    // {
    //     $query = $this->db->table('user_kelompok a');
    //     $query->select('a.id,a.user_id,a.kelompok_id,a.status_user,a.created_dttm,b.nama,c.name,c.level');
    //     $query->join('kelompok b', 'b.id=a.kelompok_id', 'left');
    //     $query->join('bcms_users b', 'c.user_id=a.user_id', 'left');
    //     $query->where('a.status_cd', 'normal');
    //     $query->where('a.id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function insertDataID($data)
    {
        
        $query = $this->db->table('user_kelompok');
        $ret = $query->insert($data);
        return $ret;
    }

    // public function getAturkelompok()
    // {
    //     $query = $this->db->table('user_kelompok');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getChartByCategory($category)
    // {
    //     $query = $this->db->table('bcms_chart');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('chart_category', $category);
    //     $query->orderBy('chart_id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getChartByID($id)
    // {
    //     $query = $this->db->table('bcms_chart');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('chart_id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getIndicatorByID($id)
    // {
    //     $query = $this->db->table('bcms_chart_indicator');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('chart_id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function cekPeriode($periode)
    // {
    //     $query = $this->db->table('bcms_chart');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('chart_periode', $periode);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function insertDataChart($data)
    // {
    //     $cek = $this->cekPeriode($data['chart_periode']);
    //     if(count($cek) > 0) {
    //         $ret =  false;
    //     } else {
    //         $query = $this->db->table('bcms_chart');
    //         $query->insert($data);
    //         $ret = $this->db->insertID();
    //     }
    //     return $ret;
    // }
    // public function insertDataIndicator($data)
    // {
    //     $query = $this->db->table('bcms_chart_indicator');
    //     $ret = $query->insert($data);
    //     return $ret;
    // }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('bcms_chart');
    //     $query->where('chart_id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
    // public function updateDataIndicator($id, $data)
    // {
    //     $query = $this->db->table('bcms_chart_indicator');
    //     $query->where('indicator_id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
}
