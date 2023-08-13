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

    public function get_tg_anggota($no_tg, $npm = null) //for Tagihan_anggota/detail
    {
        $this->db->select('no_ta, a.id_mahasiswa_pt as npm, nama_mhs, id_mj, nama_tagihan, jml_tagihan,
        (SELECT sum(nominal_bayar) FROM t_pembayaran WHERE no_ta = a.no_ta) as telah_dibayar,
        jml_tagihan - (SELECT sum(nominal_bayar) FROM t_pembayaran WHERE no_ta = a.no_ta) AS sisa_tagihan')
            ->from('t_tagihan_anggota a')
            ->join('t_tagihan b', 'a.no_tg = b.no_tg', 'inner')
            ->join('t_mahasiswa c', 'a.id_mahasiswa_pt=c.id_mahasiswa_pt', 'LEFT')
            ->where('a.no_tg', $no_tg);

        if ($npm == null) {
            return $this->db->get();
        } else {
            return $this->db->where('a.id_mahasiswa_pt', $npm)->get();
        }
    }

    public function get_anggota_pengurus($id_mj, $no_tg) // for input tagihan anggota
    {
        return $this->db->query("SELECT a.id_mahasiswa_pt as id_mahasiswa_pt, nama_mhs AS nm_pd
            FROM t_pengurus AS a 
            INNER JOIN t_masa_jabatan AS b ON a.id_mj=b.id_mj 
            LEFT JOIN t_mahasiswa AS c ON a.id_mahasiswa_pt=c.id_mahasiswa_pt
            WHERE a.id_mj ='$id_mj' 
            AND a.id_mahasiswa_pt NOT IN 
                (SELECT id_mahasiswa_pt FROM t_tagihan_anggota as ta
                    INNER JOIN t_tagihan as tg ON ta.no_tg = tg.no_tg
                    WHERE ta.no_tg='$no_tg')
            ORDER BY a.id_mahasiswa_pt ASC");
    }

    function jml_ta($no_tg)  //jml anggota yg sudah dpt tagihan
    {
        $this->db->select('count(id_mahasiswa_pt) as jml_ta')->from('t_tagihan_anggota')->where('no_tg', $no_tg);
        return $this->db->get()->row_array();
    }

    //PEMBAYARAN
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
