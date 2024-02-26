<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class KelompokModel extends Model
{
    public function getKelompok()
    {
        $query = $this->db->table('kelompok a');
        $query->select('a.id,a.nama,a.created_at,b.periode_nm,b.semester_cd,b.tanggal_buka,b.tanggal_tutup,b.status');
        $query->join('periode b', 'b.id=a.periode_id', 'left');
        $query->where('a.status_cd','normal');
        $query->where('b.status','1');
        $query->orderBy('a.id', 'DESC');
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
    // public function getPeriode()
    // {
    //     $query = $this->db->table('periode');
    //     $query->select('*');
    //     $query->where('status','1');
    //     $query->orderBy('id', 'ASC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function cekNama($nama)
    // {
    //     $query = $this->db->table('kelompok');
    //     $query->select('*');
    //     $query->where('nama', $nama);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function insertData($data)
    {
        // $cek = $this->cekNama($data['nama']);
        // if(count($cek) > 0) {
        //     $ret =  false;
        // } else {
            $query = $this->db->table('kelompok');
            $ret =  $query->insert($data);
        // }
        return $ret;
    }
    // public function getByID($id)
    // {
    //     $query = $this->db->table('periode');
    //     $query->select('*');
    //     $query->where('id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function updateData($id, $data)
    {
        $query = $this->db->table('kelompok');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
