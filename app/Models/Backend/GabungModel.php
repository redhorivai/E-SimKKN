<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class GabungModel extends Model
{
    public function getGabung()
    {
        $query = $this->db->table('user_kelompok a');
        $query->select('a.id,a.user_id,a.kelompok_id,a.status_user,a.created_user,b.nama,c.periode_nm,c.semester_cd,c.tanggal_buka,c.tanggal_tutup');
        $query->join('kelompok b', 'b.id=a.kelompok_id', 'left');
        $query->join('periode c', 'c.id=b.periode_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.status_user', 'ketua');
        $query->orderBy('a.id', 'DESC LIMIT 1');
        $return = $query->get();
        return $return->getResult();
    }
    public function getByIDUserKelompok()
    {
        $query = $this->db->table('kelompok');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekUserID($user_id)
    {
        $query = $this->db->table('user_kelompok');
        $query->select('*');
        $query->where('user_id', $user_id);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertDataID($data)
    {
        $cek = $this->cekUserID($data['user_id']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('user_kelompok');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    // public function insertDataID($data)
    // {
        
    //         $query = $this->db->table('user_kelompok');
    //         $ret =  $query->insert($data);
    //     return $ret;
    // }
}
