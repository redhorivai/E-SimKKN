<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class DaftarModel extends Model
{
    public function username($username)
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('username', $username);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->username($data['username']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('bcms_users');
            $ret =  $query->insert($data);
            $ret = $this->db->insertID();
        }
        return $ret;
    }
    public function insertDokDaftar($data)
    {
        $query = $this->db->table('dokumen_syarat');
        $ret = $query->insert($data);
        return $ret;
    }
}
