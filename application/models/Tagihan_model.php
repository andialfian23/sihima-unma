<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan_model extends CI_Model
{
    //TAGIHAN
    function get_tagihan($id_mj, $no_tg = null)
    {
        $this->db->from('t_tagihan')->where('id_mj', $id_mj);
        if ($no_tg == null) {
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get();
        } else {
            return $this->db->where('no_tg', $no_tg)->get();
        }
    }
    function get_tagihanku($npm)    //TagihanKu
    {
        $this->db->select('a.*, nama_tagihan, jml_tagihan, expired_at')
            ->from('t_tagihan_anggota a')->join('t_tagihan b', 'a.no_tg = b.no_tg')
            ->where('id_mahasiswa_pt', $npm)
            ->order_by('created_at', 'DESC');
        return $this->db->get()->result_array();
    }
    //TAGIHAN ANGGOTA
    function get_ta($id_mj, $no_ta) //TAGIHAN ANGGOTA berdasarkan no_tagihan_anggota
    {
        $this->db->select('a.*, id_mj, nama_tagihan, jml_tagihan');
        $this->db->from('t_tagihan_anggota a')->join('t_tagihan b', 'a.no_tg = b.no_tg');
        $this->db->where('id_mj', $id_mj);
        return $this->db->where('no_ta', $no_ta)->get();
    }
    function get_tg_anggota($no_tg, $npm = null)
    {
        $this->db->select('a.*, id_mj, nama_tagihan, jml_tagihan')
            ->from('t_tagihan_anggota a')->join('t_tagihan b', 'a.no_tg = b.no_tg')
            ->where('a.no_tg', $no_tg);
        if ($npm == null) {
            return $this->db->get();
        } else {
            return $this->db->where('a.id_mahasiswa_pt', $npm)->get();
        }
    }
    function jml_ta($no_tg)  //jml anggota yg sudah dpt tagihan
    {
        $this->db->select('count(id_mahasiswa_pt) as jml_ta')->from('t_tagihan_anggota')->where('no_tg', $no_tg);
        return $this->db->get()->row_array();
    }
    //PEMBAYARAN
    function pembayaranku($npm) //PembayaranKu
    {
        $this->db->select('a.*, nama_tagihan');
        $this->db->from('t_pembayaran a')->join('t_tagihan b', 'a.no_tg = b.no_tg');
        $this->db->where('a.id_mahasiswa_pt', $npm);
        return $this->db->get()->result_array();
    }
    function get_pembayaran($id_mj, $no_pb = null)
    {
        $this->db->select('a.*, nama_tagihan, b.id_mj')->from('t_pembayaran a')
            ->join('t_tagihan b ', 'a.no_tg = b.no_tg')->where('id_mj', $id_mj);
        if ($no_pb == null) {
            return $this->db->order_by('tgl_bayar', 'DESC')->get()->result_array();
        } else {
            return  $this->db->where('a.no_pb', $no_pb)->get();
        }
    }
    //KAS HIMPUNAN
    function get_kas_himpunan($id_mj)
    {
        $this->db->select('sum(nominal_bayar) as jml_kas')->from('t_pembayaran a');
        $this->db->join('t_tagihan b', 'a.no_tg = b.no_tg')->where('b.id_mj', $id_mj);
        return $this->db->get()->row_array();
    }
    //PENGURANGAN / PENAMBAHAN NILAI
    public function pengurangan_jml_dibayar($no_tg, $id_mahasiswa_pt, $dibayar)
    {
        $set1 = ['dibayar' => $dibayar];
        $where1 = ['no_tg' => $no_tg, 'id_mahasiswa_pt' => $id_mahasiswa_pt];
        $this->mydb->update_dt($where1, $set1, 't_tagihan_anggota');
    }
}
