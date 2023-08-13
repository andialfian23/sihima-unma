<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pembayaran_model extends CI_Model
{
    var $table = 't_pembayaran';
    var $column_search     = array('nama_mhs', 'nama_tagihan', 'tgl_bayar', 'nominal');

    public function get_mahasiswa($id_mj, $no_pb = null)
    {
        $this->db->select('a.*, nama_tagihan, b.id_mj')->from($this->table . ' a')
            ->join('t_tagihan b', 'a.no_tg = b.no_tg')

            ->where('id_mj', $id_mj);

        if ($no_pb == null) {
            $this->db->where('a.no_pb', $no_pb);
            $pembayaran = $this->db->order_by('tgl_bayar', 'ASC')->get();
        } else {
            $pembayaran = $this->db->order_by('tgl_bayar', 'DESC')->get();
        }
        return $pembayaran;
    }

    private function _get_query($column_order, $id_mj = null, $id_mahasiswa_pt = null)
    {
        $this->db->select('a.*, nama_tagihan, b.id_mj, c.nama_mhs as nama_mhs')
            ->from($this->table . ' a')
            ->join('t_tagihan b ', 'a.no_tg = b.no_tg')
            ->join('t_mahasiswa c', 'a.id_mahasiswa_pt = c.id_mahasiswa_pt', 'LEFT');

        if ($id_mj != null) {
            $this->db->where('id_mj', $id_mj);
        }
        if ($id_mahasiswa_pt != null) {
            $this->db->where('a.id_mahasiswa_pt', $id_mahasiswa_pt);
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
            $this->db->order_by('tgl_bayar', 'DESC');
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
        $this->db->select('a.*, nama_tagihan, b.id_mj')
            ->from($this->table . ' a')
            ->join('t_tagihan b ', 'a.no_tg = b.no_tg');
        if ($id_mj != null) {
            $this->db->where('id_mj', $id_mj);
        }
        if ($id_mahasiswa_pt != null) {
            $this->db->where('id_mahasiswa_pt', $id_mahasiswa_pt);
        }
        return $this->db->count_all_results();
    }
}
