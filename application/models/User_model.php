<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get_admin($npm = null)
    {
        if ($npm == null) {
            $data = $this->db->get_where('t_user', ['is_admin' => '1']);
            $result = [];
            $no = 0;
            foreach ($data->result_array() as $row) {
                $result[$no]['id']      = $row['id'];
                $result[$no]['id_mhs']  = $row['id_mhs'];
                $result[$no]['id_mahasiswa_pt'] = (!empty($row['id_mahasiswa_pt'])) ? $row['id_mahasiswa_pt'] : ' ';
                $mhs = json_row($row['id_mhs']);
                $result[$no]['nm_pd']   = $mhs['nm_pd'];
                $result[$no]['no_hp']   = $mhs['no_hp'];
                $no++;
            }
            return $result;
        } else {
            return $this->db->get_where('t_user', ['id_mahasiswa_pt' => $npm, 'is_admin' => '1']);
        }
    }
}
