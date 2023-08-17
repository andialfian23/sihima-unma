<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan_model extends CI_Model
{
    var $tabel_pm = 't_pemasukan';
    var $tabel_pk = 't_pengeluaran';

    //PEMASUKAN
    public function get_pemasukan($id_mj, $no_pm = null, $order_by = 'DESC')
    {
        $this->db->from($this->tabel_pm)->where('id_mj', $id_mj);
        if ($no_pm == null) {
            $this->db->order_by('tgl_pm', $order_by);
            $pemasukan = [];
            $pemasukan['result'] = $this->db->get();
            // //TOTAL
            $total = $this->db->query("SELECT sum(jml_pm) as total_pm, count(no_pm) as num_rows FROM t_pemasukan 
                                    WHERE id_mj='" . $id_mj . "' group by id_mj ASC")->row_array();

            $pemasukan['total_pemasukan'] = $total['total_pm'];
            $pemasukan['num_rows'] = $total['num_rows'];
            return $pemasukan;
        } else {
            return $this->db->where('no_pm', $no_pm)->get();
        }
    }

    //PENGELUARAN
    public function get_pengeluaran($id_mj, $no_pk = null)
    {
        $this->db->from($this->tabel_pk)->where('id_mj', $id_mj);
        if ($no_pk == null) {
            $this->db->order_by('tgl_pk', 'ASC');
            return $this->db->get();
        } else {
            return $this->db->where('no_pk', $no_pk)->get();
        }
    }
}
