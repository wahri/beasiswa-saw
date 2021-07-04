<?php
class Kode_model extends CI_Model
{

    public function kode_obat()
    {
        $this->db->select('RIGHT(obat.kode_obat,2) as kode_obat', FALSE);
        $this->db->order_by('kode_obat', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('obat');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->kode_obat) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $tgl = date('dmY');
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodetampil = "A" . $batas;  //format kode
        return $kodetampil;
    }
    public function kode_kriteria()
    {
        $this->db->select('RIGHT(kriteria.id_kriteria,2) as id_kriteria', FALSE);
        $this->db->order_by('id_kriteria', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('kriteria');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->id_kriteria) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $tgl = date('dmY');
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodetampil = "K" . $batas;  //format kode
        return $kodetampil;
    }
    public function kode_penyakit()
    {
        $this->db->select('RIGHT(kategori_penyakit.kode_penyakit,2) as kode_penyakit', FALSE);
        $this->db->order_by('kode_penyakit', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('kategori_penyakit');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->kode_penyakit) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $tgl = date('dmY');
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodetampil = "P" . $batas;  //format kode
        return $kodetampil;
    }
}
