<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    var $table = 't_mahasiswa';
    var $primary_key = 'id_mahasiswa_pt';

    public function get_admin($npm = null)
    {
        $this->db->select('id,id_mhs,id_mahasiswa_pt,nama_mhs as nm_pd, no_hp');
        if ($npm == null) {
            return $this->db->get_where($this->table, ['is_admin' => '1'])->result_array();
        } else {
            return $this->db->get_where($this->table, [$this->primary_key => $npm, 'is_admin' => '1']);
        }
    }
}
