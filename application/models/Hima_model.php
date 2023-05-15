<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hima_model extends CI_Model
{
    function hima_aktif($limit)
    {
        $data = [];

        $query_hima = $this->db->from('t_hima')->where('status_hima', '1')
            ->limit(6, $limit)->get();
        $result_hima = $query_hima->result_array();
        $no = 0;
        $result = [];
        foreach ($result_hima as $row) {
            $result[$no]['id_hima'] = $row['id_hima'];
            $result[$no]['nama_hima'] = $row['nama_hima'];
            $result[$no]['singkatan'] = $row['singkatan'];
            $result[$no]['logo'] = $row['logo'];
            $result[$no]['tempat_sekre'] = $row['tempat_sekre'];
            $result[$no]['ketua_himpunan'] = $this->mj_model->get_mj_aktif($row['id_hima'])['ketua_himpunan'];
            $no++;
        }
        $data['num_rows'] =  $this->db->get_where('t_hima', ['status_hima' => '1'])->num_rows();
        $data['result'] = $result;
        return $data;
    }
    function hima($kode_prodi)
    {
        $hima = $this->db->get_where('t_hima', [
            'kode_prodi' => $kode_prodi,
            // 'status_hima' => '1'
        ]);
        if ($hima->num_rows() > 0) {
            return $hima->row_array();
        } else {
            return false;
        }
    }
}
