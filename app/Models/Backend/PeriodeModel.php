<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class PeriodeModel extends Model
{
    public function getPeriode()
    {
        $query = $this->db->table('periode');
        $query->select('*');
        $query->where('status','1');
        $query->orderBy('id', 'ASC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekTanggal($tanggal_buka)
    {
        $query = $this->db->table('periode');
        $query->select('*');
        $query->where('tanggal_buka', $tanggal_buka);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekTanggal($data['tanggal_buka']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('periode');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function getByID($id)
    {
        $query = $this->db->table('periode');
        $query->select('*');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('periode');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
    // public function cekUsername($username)
    // {
    //     $query = $this->db->table('bcms_users');
    //     $query->select('*');
    //     $query->where('username', $username);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function insertData($data)
    // {
    //     $cek = $this->cekUsername($data['username']);
    //     if(count($cek) > 0) {
    //         $ret =  false;
    //     } else {
    //         $query = $this->db->table('bcms_users');
    //         $ret =  $query->insert($data);
    //     }
    //     return $ret;
    // }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('bcms_users');
    //     $query->where('user_id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
}
