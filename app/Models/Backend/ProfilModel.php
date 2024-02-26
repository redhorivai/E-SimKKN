<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    public function getProfil()
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('status_acc', 'active');
        $query->where('status_cd', 'normal');
        $query->orderBy('user_id', 'DESC LIMIT 1');
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('person');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
