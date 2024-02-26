<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    public function getProdi()
    {
        $query = $this->db->table('prodi');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekTitle($prodi_nm)
    {
        $query = $this->db->table('prodi');
        $query->select('*');
        $query->where('prodi_nm', $prodi_nm);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekTitle($data['prodi_nm']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('prodi');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function getByID($id)
    {
        $query = $this->db->table('prodi');
        $query->select('*');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('prodi');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }

    // public function getInfo()
    // {
    //     $query = $this->db->table('bcms_card_info');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('info_id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getByID($id)
    // {
    //     $query = $this->db->table('bcms_card_info');
    //     $query->select('*');
    //     $query->where('info_id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getStandarPelayanan()
    // {
    //     $query = $this->db->table('bcms_card_info');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->whereIn('info_kat', ['standar_pelayanan','manufacturing','service_point']);
    //     $query->groupBy('info_kat');
    //     $query->orderBy('info_kat', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getByTypeLimit($type,$limit)
    // {
    //     $query = $this->db->table('bcms_card_info');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('info_kat', $type);
    //     $query->limit($limit);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getByAlur()
    // {
    //     $query = $this->db->table('bcms_card_info');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->whereIn('info_kat', ['registrasi_online','registrasi_loket','registrasi_apm','registrasi_igd','registrasi_ranap']);
    //     // $query->groupBy('info_kat');
    //     $query->orderBy('info_kat', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function cekTitle($kategori, $title)
    // {
    //     $query = $this->db->table('bcms_card_info');
    //     $query->select('*');
    //     $query->where('info_kat', $kategori);
    //     $query->where('info_title', $title);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function insertData($data)
    // {
    //     $cek = $this->cekTitle($data['info_kat'], $data['info_title']);
    //     if(count($cek) > 0) {
    //         $ret =  false;
    //     } else {
    //         $query = $this->db->table('bcms_card_info');
    //         $ret =  $query->insert($data);
    //     }
    //     return $ret;
    // }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('bcms_card_info');
    //     $query->where('info_id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
    // public function deleteData($info_kat, $data)
    // {
    //     $query = $this->db->table('bcms_card_info');
    //     $query->where('info_kat', $info_kat);
    //     $query->set($data);
    //     return $query->update();
    // }
}
