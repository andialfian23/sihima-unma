<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan_model extends CI_Model
{
    public function get_jabatan()
    {
        return $this->db->select('a.*, role')
            ->from('t_jabatan a')
            ->join('t_role b', 'a.level = b.level')
            ->get();
    }
}
