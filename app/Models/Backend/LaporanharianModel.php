<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LaporanharianModel extends Model
{
    public function getLaporanharian()
    {
        $query = $this->db->table('laporan_harian');
        $query->select('*');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getLaporByTgl($tglAwal, $tglAkhir, $user_id)
    {
        $query = $this->db->table('laporan_harian a');
        $query->select('a.id,a.user_id,a.dokumen,a.nilai,a.tgl_laporan,b.name,b.gender,c.nama,a.kelompok_id');
        $query->join('bcms_users b', 'b.user_id=a.created_by', 'left');
        $query->join('kelompok c', 'c.id=a.kelompok_id', 'left');
        $query->where('a.tgl_laporan >=', $tglAwal);
        $query->where('a.tgl_laporan <=',$tglAkhir);
        $query->where('a.user_id', $user_id);
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getByID($id)
    {
        $query = $this->db->table('laporan_harian');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function getByIDNilai($id)
    {
        $query = $this->db->table('laporan_harian a');
        $query->select('a.id,a.judul,a.dokumen,a.nilai,a.created_at,b.name,b.gender,c.nama');
        $query->join('bcms_users b', 'b.user_id=a.created_by', 'left');
        $query->join('kelompok c', 'c.id=a.kelompok_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($id, $data)
    {
        $query = $this->db->table('laporan_harian');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
