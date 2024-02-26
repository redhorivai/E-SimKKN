<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function login_check($username, $password){
        return $this->db->table('bcms_users')
            ->where(array('username' => $username, 'password' => $password))
            ->get()->getRowArray();
    }
    public function user_check($username)
    {
        return $this->db->table('bcms_users')
            ->where(array('username' => $username))
            ->get()->getRowArray();
    }
    public function getNamaKelompokByID($id)
    {
        $query = $this->db->table('user_kelompok a');
        $query->select('b.nama');
        $query->join('kelompok b', 'b.id = a.kelompok_id', 'left');
        $query->where('status_cd', 'normal');
        $query->where('user_id', $id);
        $return = $query->get();
        return $return->getResult();
    }
}
