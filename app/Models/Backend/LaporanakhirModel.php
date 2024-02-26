<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LaporanakhirModel extends Model
{
    public function getLaporanakhir()
    {
        $query = $this->db->table('laporan_akhir');
        $query->select('*');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getLaporByTgl($tglAwal, $tglAkhir)
    {
        $query = $this->db->table('laporan_akhir a');
        $query->select('a.id,a.keterangan,a.nilai,a.path,a.jenis,a.link,a.created_at,b.name,c.nama');
        $query->join('bcms_users b', 'b.user_id=a.created_by', 'left');
        $query->join('kelompok c', 'c.id=a.kelompok_id', 'left');
        $query->where('a.status_cd' ,'normal');
        $query->where('a.created_at >=', $tglAwal);
        $query->where('a.created_at <=',$tglAkhir);
        $query->orderBy('a.id', 'DESC');
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
    public function getByIDNilai($id)
    {
        $query = $this->db->table('laporan_akhir a');
        $query->select('a.id,a.keterangan,a.nilai,a.path,a.jenis,a.link,b.name,b.gender,c.nama');
        $query->join('bcms_users b', 'b.user_id=a.created_by', 'left');
        $query->join('kelompok c', 'c.id=a.kelompok_id', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($id, $data)
    {
        $query = $this->db->table('laporan_akhir');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}
