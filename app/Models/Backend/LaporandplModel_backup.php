<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LaporandplModel extends Model
{
    public function getLaporan()
    {
        $query = $this->db->table('laporan_dosen a');
        $query->select('a.type,a.periode_id,a.keterangan,a.path,a.status_cd,b.periode_nm,b.semester_cd');
        $query->join('periode b', 'b.id=a.periode_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->orderBy('a.id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getIDperiode()
    {
        $query = $this->db->table('periode');
        $query->select('*');
        $query->where('status', '1');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $query = $this->db->table('laporan_dosen');
        $ret =  $query->insert($data);
        return $ret;
    }
    // public function getByID($id)
    // {
    //     $query = $this->db->table('bcms_users');
    //     $query->select('*');
    //     $query->where('user_id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
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
