<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan_model extends CI_Model
{
    var $table = 't_tagihan';

    //TAGIHAN
    public function get_tagihan($id_mj, $no_tg = null)
    {
        $this->db->from($this->table)
            ->where('id_mj', $id_mj);
        if ($no_tg == null) {
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get();
        } else {
            return $this->db->where('no_tg', $no_tg)->get();
        }
    }

    function get_tagihanku($npm)    //TagihanKu
    {
        $this->db->select('tg.*, 
                (SELECT sum(nominal_bayar) FROM t_pembayaran WHERE no_ta=ta.no_ta) AS jml_dibayar,
                m.id_mahasiswa_pt, m.nama_mhs')
            ->from('t_tagihan_anggota ta')
            ->join($this->table . ' tg', 'ta.no_tg = tg.no_tg', 'INNER')
            ->join('t_mahasiswa m', 'ta.id_mahasiswa_pt = m.id_mahasiswa_pt', 'LEFT')
            ->where('ta.id_mahasiswa_pt', $npm)
            ->order_by('tg.created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    //TAGIHAN ANGGOTA
    function get_ta($id_mj, $no_ta) //TAGIHAN ANGGOTA berdasarkan no_tagihan_anggota
    {
        $this->db->select('ta.no_tg, ta.no_ta, ta.id_mahasiswa_pt, nama_mhs, id_mj, nama_tagihan, jml_tagihan,
        (SELECT sum(nominal_bayar) FROM t_pembayaran WHERE no_ta = ta.no_ta) as telah_dibayar
        ')
            ->from('t_tagihan_anggota ta')
            ->join($this->table . ' tg', 'ta.no_tg = tg.no_tg', 'inner')
            ->join('t_mahasiswa m', 'ta.id_mahasiswa_pt=m.id_mahasiswa_pt', 'LEFT')
            ->where('id_mj', $id_mj);
        return $this->db->where('ta.no_ta', $no_ta)->get();
    }

    public function get_tg_anggota($no_tg, $npm = null) //for Tagihan_anggota/detail
    {
        $this->db->select('no_ta, a.id_mahasiswa_pt as npm, nama_mhs, id_mj, nama_tagihan, jml_tagihan,
        (SELECT sum(nominal_bayar) FROM t_pembayaran WHERE no_ta = a.no_ta) as telah_dibayar')
            ->from('t_tagihan_anggota a')
            ->join($this->table . ' b', 'a.no_tg = b.no_tg', 'inner')
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
                    INNER JOIN $this->table as tg ON ta.no_tg = tg.no_tg
                    WHERE ta.no_tg='$no_tg')
            ORDER BY a.id_mahasiswa_pt ASC");
    }

    function jml_ta($no_tg)  //jml anggota yg sudah dpt tagihan
    {
        $this->db->select('count(id_mahasiswa_pt) as jml_ta')
            ->from('t_tagihan_anggota')
            ->where('no_tg', $no_tg);
        return $this->db->get()->row_array();
    }
}
