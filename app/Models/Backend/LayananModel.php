<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LayananModel extends Model
{
    public function getCategoryTarif()
    {
        $query = $this->db->table('bcms_layanan');
        $query->select('*');
        $query->where("(kategory!='Layanan Unggulan')");
        $query->groupBy('kategory');
        $return = $query->get();
        return $return->getResult();
    }
    public function getLayananByKategori($kategori)
    {
        $query = $this->db->table('bcms_layanan');
        $query->select('*');
        $query->where('kategory', $kategori);
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function getItems($layanan_id)
    {
        $query = $this->db->table('bcms_fasilitas_layanan a');
        $query->select('a.fasilitas_layanan_id,a.layanan_id, 
                        b.kategory, b.deskripsi, b.nama, b.harga, b.satuan,
                        c.item_fasilitas_nm');
        $query->join('bcms_layanan b', 'a.layanan_id=b.layanan_id', 'left');
        $query->join('bcms_item_fasilitas c', 'a.item_fasilitas_id=c.item_fasilitas_id', 'left');
        $query->where('a.layanan_id', $layanan_id);
        $query->where('a.status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function getByID($id)
    {
        $query = $this->db->table('bcms_layanan');
        $query->select('*');
        $query->where('layanan_id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function cek($kategori, $nama)
    {
        $query = $this->db->table('bcms_layanan');
        $query->select('*');
        $query->where('kategory', $kategori);
        $query->where('nama', $nama);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cek($data['kategory'], $data['nama']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('bcms_layanan');
            $query->insert($data);
            $ret = $this->db->insertID();
        }
        return $ret;
    }
    public function insertDataItems($data)
    {
        $query = $this->db->table('bcms_fasilitas_layanan');
        $ret =  $query->insert($data);
        return $ret;
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('bcms_layanan');
        $query->where('layanan_id', $id);
        $query->set($data);
        return $query->update();
    }
    public function getItem()
    {
        $query = $this->db->table('bcms_item_fasilitas');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('item_fasilitas_id', 'ASC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getItemByNama($nama)
    {
        $query = $this->db->table('bcms_fasilitas_layanan a');
        $query->select('a.fasilitas_layanan_id,a.layanan_id, 
                        b.kategory, b.nama,
                        c.item_fasilitas_id,c.item_fasilitas_nm');
        $query->join('bcms_layanan b', 'a.layanan_id=b.layanan_id', 'left');
        $query->join('bcms_item_fasilitas c', 'a.item_fasilitas_id=c.item_fasilitas_id', 'left');
        $query->where('b.nama', $nama);
        $query->where('a.status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertLapor($data)
    {
        $query = $this->db->table('bcms_lapor');
        $ret =  $query->insert($data);
        return $ret;
    }
    public function getLapor()
    {
        $query = $this->db->table('bcms_lapor');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('lapor_id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getLaporByTgl($tglAwal, $tglAkhir)
    {
        $query = $this->db->table('bcms_lapor');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('lapor_dttm >=', $tglAwal);
        $query->where('lapor_dttm <=',$tglAkhir);
        $query->orderBy('lapor_id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function updateDataLapor($id, $data)
    {
        $query = $this->db->table('bcms_lapor');
        $query->where('lapor_id', $id);
        $query->set($data);
        return $query->update();
    }
    // public function getItemByKat($kat)
    // {
    //     $query = $this->db->table('bcms_fasilitas_layanan a');
    //     $query->select('a.fasilitas_layanan_id,a.layanan_id, 
    //                     b.kategory, b.nama,
    //                     c.item_fasilitas_id,c.item_fasilitas_nm');
    //     $query->join('bcms_layanan b', 'a.layanan_id=b.layanan_id', 'left');
    //     $query->join('bcms_item_fasilitas c', 'a.item_fasilitas_id=c.item_fasilitas_id', 'left');
    //     $query->where('b.kategory', $kat);
    //     $query->where('a.status_cd', 'normal');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
}
