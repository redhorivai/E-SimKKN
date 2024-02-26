<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    public function getPengguna()
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('user_id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getByID($id)
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('user_id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function cekUsername($username)
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('username', $username);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekUsername($data['username']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('bcms_users');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('bcms_users');
        $query->where('user_id', $id);
        $query->set($data);
        return $query->update();
    }
}
