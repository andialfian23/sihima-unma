<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pembayaran_model extends CI_Model
{
    var $table = 't_pembayaran pb';
    var $column_search     = array('nama_mhs', 'nama_tagihan', 'tgl_bayar', 'nominal');

    public function get_mahasiswa($id_mj, $no_pb = null)
    {
        $this->db->select('pb.*, tg.nama_tagihan, tg.id_mj')->from($this->table)
            ->join('t_tagihan_anggota ta', 'pb.no_ta = ta.no_ta')
            ->join('t_tagiha tg', 'ta.no_tg = tg.no_tg')

            ->where('id_mj', $id_mj);

        if ($no_pb == null) {
            $this->db->where('pb.no_pb', $no_pb);
            $pembayaran = $this->db->order_by('tgl_bayar', 'ASC')->get();
        } else {
            $pembayaran = $this->db->order_by('tgl_bayar', 'DESC')->get();
        }
        return $pembayaran;
    }

    //PEMBAYARAN
    function get_pembayaran($id_mj, $no_pb = null)
    {
        $this->db->select('nama_tagihan, id_mj, jml_tagihan, nominal_bayar,tgl_bayar')
            ->from($this->table)
            ->join('t_tagihan_anggota ta ', 'pb.no_ta = ta.no_ta')
            ->join('t_tagihan tg ', 'ta.no_tg = tg.no_tg')
            ->where('id_mj', $id_mj);
        if ($no_pb == null) {
            return $this->db->order_by('tgl_bayar', 'DESC')->get()->result_array();
        } else {
            return  $this->db->where('no_pb', $no_pb)->get();
        }
    }

    //KAS HIMPUNAN / TOTAL PEMBAYARAN
    public function get_kas_himpunan($id_mj)
    {
        $this->db->select("sum(nominal_bayar) as jml_kas, min(tgl_bayar) as tgl, 
            max(singkatan) as singkatan, max(CONCAT(periode1,'/',periode2)) as periode");
        $this->db->from($this->table);
        $this->db->join('t_tagihan_anggota ta', 'pb.no_ta = ta.no_ta');
        $this->db->join('t_tagihan tg', 'ta.no_tg = tg.no_tg');
        $this->db->join('t_masa_jabatan mj', 'tg.id_mj = mj.id_mj');
        $this->db->join('t_hima hm', 'mj.id_hima = hm.id_hima');
        $this->db->where('tg.id_mj', $id_mj);
        return $this->db->get()->row_array();
    }

    //DATATABLES HISTORI PEMBAYARAN
    private function _get_query($column_order, $id_mj = null, $id_mahasiswa_pt = null)
    {
        $this->db->select('pb.*, tg.nama_tagihan, tg.id_mj, m.nama_mhs as nama_mhs')
            ->from($this->table)
            ->join('t_tagihan_anggota ta ', 'pb.no_ta = ta.no_ta', 'INNER')
            ->join('t_tagihan tg', 'ta.no_tg=tg.no_tg', 'INNER')
            ->join('t_mahasiswa m', 'ta.id_mahasiswa_pt = m.id_mahasiswa_pt', 'LEFT');

        if ($id_mj != null) {
            $this->db->where('tg.id_mj', $id_mj);
        }

        if ($id_mahasiswa_pt != null) {
            $this->db->where('ta.id_mahasiswa_pt', $id_mahasiswa_pt);
        }

        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('pb.tgl_bayar', 'DESC');
        }
    }
    public function get_datatables($column_order, $id_mj = null, $id_mahasiswa_pt = null)
    {
        $this->_get_query($column_order, $id_mj, $id_mahasiswa_pt);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            if ($query) {
                return $query->result();
            }
        } else {
            $query = $this->db->get();
            if ($query) {
                return $query->result();
            }
        }
    }
    public function total_entri_terfilter($column_order, $id_mj = null, $id_mahasiswa_pt = null)
    {
        $this->_get_query($column_order, $id_mj, $id_mahasiswa_pt);
        return $this->db->get()->num_rows();
    }
    public function total_entri($id_mj = null, $id_mahasiswa_pt = null)
    {
        $this->db->select('pb.*, tg.nama_tagihan, tg.id_mj')
            ->from($this->table)
            ->join('t_tagihan_anggota ta ', 'pb.no_ta = ta.no_ta')
            ->join('t_tagihan tg ', 'ta.no_tg = tg.no_tg');
        if ($id_mj != null) {
            $this->db->where('tg.id_mj', $id_mj);
        }
        if ($id_mahasiswa_pt != null) {
            $this->db->where('ta.id_mahasiswa_pt', $id_mahasiswa_pt);
        }
        return $this->db->count_all_results();
    }
}
