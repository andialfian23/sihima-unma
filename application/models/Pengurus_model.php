<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus_model extends CI_Model
{

    var $table = 't_pengurus';

    function cek_pengurus($npm)
    {
        return $this->db->get_where($this->table, ['id_mahasiswa_pt' => $npm]);
    }
    function cek_pengurus2($npm, $id_mj) //ngecek di tabel pengurus
    {
        return $this->db->get_where($this->table, ['id_mahasiswa_pt' => $npm, 'id_mj' => $id_mj]);
    }
    function get_jabatan($npm, $id_mj)
    {
        $this->db->select('a.*, jabatan')->from("$this->table a")->join('t_jabatan b', 'a.id_jabatan = b.id_jabatan');
        $this->db->where('id_mj', $id_mj)->where('id_mahasiswa_pt', $npm);
        return $this->db->get()->row_array();
    }
    function cek_pengurus_mj($npm, $id_hima)
    {
        $this->db->select('a.*, id_hima ');
        $this->db->from("$this->table a")->join('t_masa_jabatan b', 'a.id_mj = b.id_mj');
        $this->db->where('a.id_mahasiswa_pt', $npm)->where('b.id_hima', $id_hima);
        return $this->db->get();
    }
    function get_anggota_pengurus($id_hima, $id_mj)
    {
        $this->db->select('b.*, 
                id_pengurus as id, a.id_mahasiswa_pt, nama_mhs as nm_pd, 
                jabatan, singkatan, level')
            ->from("$this->table a");
        $this->db->join('t_masa_jabatan b', 'a.id_mj = b.id_mj');
        $this->db->join('t_hima c', 'b.id_hima = c.id_hima');
        $this->db->join('t_jabatan d', 'a.id_jabatan = d.id_jabatan');
        $this->db->join('t_mahasiswa e', 'a.id_mahasiswa_pt = e.id_mahasiswa_pt', 'LEFT');
        $this->db->where('a.id_mj', $id_mj)->where('b.id_hima', $id_hima)
            ->order_by('level', 'ASC')
            ->order_by('jabatan', 'DESC')
            ->order_by('a.id_mahasiswa_pt', 'ASC');;
        $pengurus = $this->db->get();
        $result = [];
        $result['num_rows'] = $pengurus->num_rows();
        $result['result'] = $pengurus->result_array();
        return $result;
    }
    function get_anggota_pengurus2($id_mj)
    {
        $this->db->select('b.*, id_pengurus as id, a.id_mahasiswa_pt, nama_mhs as nm_pd, jabatan, singkatan')
            ->from("$this->table a");
        $this->db->join('t_masa_jabatan b', 'a.id_mj = b.id_mj');
        $this->db->join('t_hima c', 'b.id_hima = c.id_hima');
        $this->db->join('t_jabatan d', 'a.id_jabatan = d.id_jabatan');
        $this->db->join('t_mahasiswa e', 'a.id_mahasiswa_pt = e.id_mahasiswa_pt', 'LEFT');
        $this->db->where('a.id_mj', $id_mj)
            ->order_by('id_mahasiswa_pt', 'ASC');
        return $this->db->get()->result_array();
    }
    function hitung_pengurus($id_mj)    //HITUNG PENGURUS AKTIF
    {
        $this->db->select('count(id_mahasiswa_pt) as jml_pengurus')->where('id_mj', $id_mj);
        return $this->db->get($this->table)->row_array();
    }
    //HISTORI JABATAN -> detail
    function histori_jabatan($npm)
    {
        $this->db->select('a.*, singkatan, periode1, periode2, jabatan, status_mj');
        $this->db->from("$this->table a");
        $this->db->join('t_masa_jabatan b', 'a.id_mj = b.id_mj');
        $this->db->join('t_hima c', 'b.id_hima = c.id_hima');
        $this->db->join('t_jabatan d', 'a.id_jabatan = d.id_jabatan');
        $this->db->where('a.id_mahasiswa_pt', $npm)->order_by('periode1', 'DESC');
        return $this->db->get();
    }
}
