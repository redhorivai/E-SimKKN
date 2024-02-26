<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class SurveiModel extends Model
{
    public function getAllkelompok()
    {
        $query = $this->db->table('kelompok a');
        $query->select('a.id,a.nama,a.created_at,b.periode_nm,b.semester_cd,b.tanggal_buka,b.tanggal_tutup');
        $query->join('periode b', 'b.id=a.periode_id', 'left');
        $query->where('a.status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function getIdDosen()
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('level', 'Admin');
        $query->where('status_acc', 'active');
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function getSurvei($id)
    {
        $query = $this->db->table('pengajuan a');
        $query->select('a.id,a.kelompok_id,a.path,a.status,a.keterangan,a.created_at,b.nama,c.periode_nm,c.semester_cd,c.tanggal_buka,c.tanggal_tutup');
        $query->join('kelompok b', 'b.id=a.kelompok_id', 'left');
        $query->join('periode c', 'c.id=b.periode_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.created_by', $id);
        $query->orderBy('a.id', 'DESC LIMIT 1');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
            $query = $this->db->table('pengajuan');
            $ret =  $query->insert($data);
        return $ret;
    }
    public function getLaporandpl()
    {
        $query = $this->db->table('laporan_dosen a');
        $query->select('a.id,a.type,a.periode_id,a.keterangan,a.path,a.status_cd,b.periode_nm,b.semester_cd');
        $query->join('periode b', 'b.id=a.periode_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->orderBy('a.id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    // public function insertData($data)
    // {
    //         $query = $this->db->table('laporan_dosen');
    //         $ret =  $query->insert($data);
    //     return $ret;
    // }
    public function getPeriode_id()
    {
        $query = $this->db->table('periode');
        $query->select('*');
        $query->where('status', '1');
        $return = $query->get();
        return $return->getResult();
    }
     public function updateData($id, $data)
    {
        $query = $this->db->table('laporan_dosen');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
    public function getByID($id)
    {
        $query = $this->db->table('pengajuan');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function getKelompokByID($id)
    {
        $query = $this->db->table('user_kelompok');
        $query->select('kelompok_id');
        $query->where('status_cd', 'normal');
        $query->where('status_user', 'ketua');
        $query->where('user_id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function getDosenKelompok($id_kelompok) 
    {
        $query = $this->db->table('user_kelompok a');
        $query->select('a.user_id,a.kelompok_id,a.status_user,b.name,c.nama');
        $query->join('bcms_users b', 'b.user_id = a.user_id', 'left');
        $query->join('kelompok c', 'c.id = a.kelompok_id', 'left');
        $query->where('b.status_cd', 'normal');
        $query->where('a.status_user', 'dosen');
        $query->where('a.kelompok_id', $id_kelompok);
        $return = $query->get();
        return $return->getResult();
    }
}
