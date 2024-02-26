<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class AkhirModel extends Model
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
    public function getAkhir($user_id)
    {
        $query = $this->db->table('laporan_akhir a');
        $query->select('a.id,a.nilai,a.path,a.keterangan,a.jenis,a.created_at,b.name,c.nama,d.periode_nm,d.semester_cd,d.tanggal_buka,d.tanggal_tutup');
        $query->join('bcms_users b', 'b.user_id=a.user_id', 'left');
        $query->join('kelompok c', 'c.id=a.kelompok_id', 'left');
        $query->join('periode d', 'd.id=c.periode_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.created_by', $user_id);
        $query->orderBy('a.id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $query = $this->db->table('laporan_akhir');
        $ret =  $query->insert($data);
        return $ret;
    }
    public function getPeriode_id()
    {
        $query = $this->db->table('periode');
        $query->select('*');
        $query->where('status', '1');
        $return = $query->get();
        return $return->getResult();
    }
    public function getByID($id)
    {
        $query = $this->db->table('laporan_akhir');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function getKelompokid($id)
    {
        $query = $this->db->table('user_kelompok');
        $query->select('kelompok_id');
        $query->where('status_cd', 'normal');
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
    public function getNamaKelompokByID($id)
    {
        $query = $this->db->table('user_kelompok a');
        $query->select('b.nama,a.status_user');
        $query->join('kelompok b', 'b.id = a.kelompok_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.user_id', $id);
        $return = $query->get();
        return $return->getResult();
    }
}
