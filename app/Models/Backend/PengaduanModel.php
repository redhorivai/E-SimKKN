<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    public function getAdu()
    {
        $query = $this->db->table('bcms_pengaduan');
        $query->select('*');
        $query->orderBy('id_pengaduan', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
}
