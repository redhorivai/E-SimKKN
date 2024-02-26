<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class KelompokDetailModel extends Model
{
    public function getAturkelompok()
    {
        $query = $this->db->table('kelompok a');
        $query->select('a.id,a.nama,a.created_at,b.periode_nm,b.semester_cd,b.tanggal_buka,b.tanggal_tutup,b.status');
        $query->join('periode b', 'b.id=a.periode_id', 'left');
        $query->where('a.status_cd','normal');
        $query->where('b.status','1');
        $return = $query->get();
        return $return->getResult();
    }
    public function getIdPeriode()
    {
        $query = $this->db->table('periode');
        $query->select('*');
        $query->where('status', '1');
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
     
    public function insertDataID($data)
    {
        
        $query = $this->db->table('user_kelompok');
        $ret = $query->insert($data);
        return $ret;
    }

}
