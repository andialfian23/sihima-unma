<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan_model extends CI_Model
{
    //PEMASUKAN
    function get_pemasukan($id_mj, $no_pm = null, $order_by = 'DESC')
    {
        $this->db->from('t_pemasukan')->where('id_mj', $id_mj);
        if ($no_pm == null) {
            $this->db->order_by('tgl_pm', $order_by);
            $pemasukan = [];
            $pemasukan['result'] = $this->db->get();
            // //TOTAL
            $total = $this->db->query("SELECT sum(jml_pm) as total_pm,count(no_pm) as num_rows FROM t_pemasukan 
                                    WHERE id_mj='" . $id_mj . "' group by id_mj ASC")->row_array();
            $pemasukan['total_pemasukan'] = $total['total_pm'];
            $pemasukan['num_rows'] = $total['num_rows'];
            return $pemasukan;
        } else {
            return $this->db->where('no_pm', $no_pm)->get();
        }
    }
    public function penambahan_jml_pemasukan($id_mj, $nominal) //digunakan pd function bayar() atau add pembayaran
    {
        $where2 = ['id_mj' => $id_mj, 'kas_hima' => '1'];
        $pm = $this->db->get_where('t_pemasukan', $where2)->row_array();
        $jml_pm_sekarang    = $pm['jml_pm'] + $nominal;
        $data_update        = ['jml_pm' => $jml_pm_sekarang];
        $this->mydb->update_dt($where2, $data_update, 't_pemasukan');
    }
    public function pengurangan_jml_pemasukan($id_mj, $nominal_bayar) //digunakan pd penghapusan data pembayaran
    {
        $where2 = ['id_mj' => $id_mj, 'kas_hima' => '1'];
        $pm = $this->db->get_where('t_pemasukan', $where2)->row_array();
        $jml_pm_sekarang = $pm['jml_pm'] - $nominal_bayar;
        $set2 = ['jml_pm' => $jml_pm_sekarang];
        $this->mydb->update_dt($where2, $set2, 't_pemasukan');
    }
    //PENGELUARAN
    function get_pengeluaran($id_mj, $no_pk = null)
    {
        $this->db->from('t_pengeluaran')->where('id_mj', $id_mj);
        if ($no_pk == null) {
            $this->db->order_by('tgl_pk', 'ASC');
            return $this->db->get();
        } else {
            return $this->db->where('no_pk', $no_pk)->get();
        }
    }
}
