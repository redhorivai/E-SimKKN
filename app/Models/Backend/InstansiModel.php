<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class InstansiModel extends Model
{
    public function getInstansi()
    {
        $query = $this->db->table('bcms_company');
        $query->select('*');
        $query->orderBy('company_id', 'DESC LIMIT 1');
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('bcms_company');
        $query->where('company_id', $id);
        $query->set($data);
        return $query->update();
    }
}
