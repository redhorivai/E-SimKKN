<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LaporansurveiModel extends Model
{

    // public function getLaporansurvei()
    // {
    //     $query = $this->db->table('pengajuan a');
    //     $query->select('a.id,a.kelompok_id,a.dokumen,a.status,a.keterangan,a.created_at,b.nama,c.periode_nm,c.semester_cd,c.tanggal_buka,c.tanggal_tutup');
    //     $query->join('kelompok b', 'b.id=a.kelompok_id', 'left');
    //     $query->join('periode c', 'c.id=b.periode_id', 'left');
    //     $query->orderBy('a.id', 'DESC LIMIT 1');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function getLaporansurvei($user_id)
    {
        $query = $this->db->table('pengajuan a');
        $query->select('a.id,a.kelompok_id,a.path,a.status,a.keterangan,a.created_at,b.nama,c.periode_nm,c.semester_cd,c.tanggal_buka,c.tanggal_tutup');
        $query->join('kelompok b', 'b.id=a.kelompok_id', 'left');
        $query->join('periode c', 'c.id=b.periode_id', 'left');
        $query->where('a.user_id', $user_id);
        $query->orderBy('a.id', 'DESC LIMIT 1');
        $return = $query->get();
        return $return->getResult();
    }
    // public function insertData($data)
    // {
    //         $query = $this->db->table('laporan_dosen');
    //         $ret =  $query->insert($data);
    //     return $ret;
    // }
    // public function getPeriode_id()
    // {
    //     $query = $this->db->table('periode');
    //     $query->select('*');
    //     $query->where('status', '1');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    //  public function updateData($id, $data)
    // {
    //     $query = $this->db->table('laporan_dosen');
    //     $query->where('id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
    public function getByIDpengajuan($id)
    {
        $query = $this->db->table('pengajuan');
        $query->select('*');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function getByIDkelompok($id)
    {
        $query = $this->db->table('kelompok');
        $query->select('*');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('pengajuan');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
    







    // public function getLaporandpl()
    // {
    //     $query = $this->db->table('laporan_dosen');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function cekTitle($judul)
    // {
    //     $query = $this->db->table('pengumuman');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('judul', $judul);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('pengumuman');
    //     $query->where('id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
    // public function getBerita()
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('type', 'berita');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('artikel_id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getSlider()
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('type', 'slider');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('artikel_id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getByID($id)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('artikel_id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function cekTitle($title)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('title', $title);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getLimit($limit)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('type', 'artikel');
    //     $query->orderBy('artikel_id', 'DESC');
    //     $query->limit($limit);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function insertData($data)
    // {
    //     $cek = $this->cekTitle($data['title']);
    //     if(count($cek) > 0) {
    //         $ret =  false;
    //     } else {
    //         $query = $this->db->table('bcms_artikel');
    //         $ret =  $query->insert($data);
    //     }
    //     return $ret;
    // }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->where('artikel_id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
}
