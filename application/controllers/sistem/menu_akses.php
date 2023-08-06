<?php
defined('BASEPATH') or exit('No direct script access allowed');

class menu_akses extends CI_Controller
{
    var $table = 't_menu_access';

    public function get()
    {
        $level = !empty($this->input->post('level')) ? $this->input->post('level', true) : null;
        if ($level == null) {
            notifikasi('Pilih role yang akan anda cek !!!', false);
            redirect(base_url('admin/role'));
        }
        $role       = $this->db->get_where('t_role', ['level' => $level])->row_array();
        $controller = $this->db
            ->select("a.id_ctr, a.nama_controller, a.fitur, CASE WHEN akses > 0 THEN 'checked' ELSE '' END AS akses_menu", FALSE)
            ->from('t_controller AS a')
            ->join("(SELECT level as akses, id_ctr FROM $this->table WHERE level=$level) as b", 'b.id_ctr = a.id_ctr', 'LEFT')
            ->where('a.nama_controller !=', 'Dashboard')
            ->order_by('a.nama_controller', 'ASC')
            ->get()->result_array();

        $output = [];
        $output = [
            'role' => $role,
            'controller' => $controller
        ];
        echo json_encode($output);
    }

    public function change()
    {
        $menu_id = (!empty($this->input->post('menuId', TRUE))) ? $this->input->post('menuId', TRUE) : NULL;  // ID_CTR
        $role_id = (!empty($this->input->post('roleId', TRUE))) ? $this->input->post('roleId', TRUE) : NULL;  // LEVEL
        $status = null;

        if (($menu_id == NULL) || ($role_id == NULL)) {
            redirect(base_url('Dashboard'));
        } else {

            $where = [
                'level' => $role_id,
                'id_ctr' => $menu_id
            ];

            $nama_controller = $this->db->get_where('t_controller', ['id_ctr'])->row()->nama_controller;
            $cek_akses_menu = $this->db->get_where($this->table, $where);
            if ($cek_akses_menu->num_rows() < 1) {
                $this->db->insert($this->table, $where);
                $status = '1';
            } else {
                $this->db->delete($this->table, $where);
                $status = '0';
            }
            $output = [];
            $output = [
                'controller' => $nama_controller,
                'status' => $status,
            ];
            echo json_encode($output);
        }
    }
}
