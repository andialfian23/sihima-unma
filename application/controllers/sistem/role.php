<?php
defined('BASEPATH') or exit('No direct script access allowed');

class role extends CI_Controller
{
    var $table = 't_role';
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $roles = $this->db->get($this->table)->result_array();
        $this->load->view('dashboard/template/main', [
            'title'  => 'Manajemen Role',
            'roles' => $roles,
            'file'   => 'admin/index_role',
        ]);
    }
    public function insert()
    {
        $level = $this->input->post('level');
        $role  = $this->input->post('role');
        if (($level != null) && ($role != null)) {
            if ($this->db->get_where($this->table, ['level' => $level])->num_rows() > 0) {
                $result = [
                    'kode' => '0',
                    'error' => 'Level Sudah Digunakan',
                ];
            } else {
                $this->db->insert($this->table, [
                    'level' => $level,
                    'role' => $role
                ]);
                $result = [
                    'kode' => '1',
                    'error' => $_POST,
                ];
            }
        } else {
            $result = [
                'kode' => '0',
                'error' => 'Gagal Menambahkan Role Baru',
            ];
        }
        echo json_encode($result);
    }
    public function update()
    {
        $level      = $_POST['level'];
        $old_level  = $_POST['old_level'];
        $where      = ['level' => $level];
        $cek = $this->db->get_where($this->table, $where)->num_rows();
        if (($cek > 0) && ($level != $old_level)) {
            $result = [
                'kode' => '0',
                'error' => 'Level sudah digunakan'
            ];
        } else {
            $set = [
                'role' => $this->input->post('role')
            ];
            $this->mydb->update_dt($where, $set, $this->table);
            $result = [
                'kode' => '1',
                'error' => ''
            ];
        }
        echo json_encode($result);
    }
    public function delete()
    {
        $where = ['level' => $_POST['level']];
        $this->mydb->del($where, $this->table);
        echo json_encode('1');
    }
    public function get_role()
    {
        $result = $this->db->get_where($this->table, ['level' => $_POST['level']])->row();
        echo json_encode($result);
    }
}
