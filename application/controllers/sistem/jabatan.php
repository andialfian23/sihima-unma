<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jabatan extends CI_Controller
{
    var $table = 't_jabatan';

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Jabatan_model', 'jabatan');
    }
    public function index()
    {
        $jabatans = $this->jabatan->get_jabatan()->result_array();
        $roles = $this->db->get('t_role')->result_array();
        $this->load->view('dashboard/template/main', [
            'title'      => "Jabatan",
            'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
            'assets_js' => array("themes/vendors/js/tables/datatable/datatables.min.js"),
            'jabatans'  => $jabatans,
            'roles'     => $roles,
            'file'      => 'jabatan/index_jabatan',
        ]);
    }
    public function insert()
    {
        $result = [];
        $nama_jabatan = $this->input->post('nama_jabatan', true);
        $cek = $this->db->get_where($this->table, ['jabatan' => $nama_jabatan])->num_rows();
        if ($cek > 0) {
            $result = [
                'kode' => '1',
                'error' => 'Nama Jabatan Sudah Digunakan',
            ];
        } else {
            $values = [
                'jabatan' => $nama_jabatan,
                'level' => $_POST['level'],
            ];
            $this->mydb->input_dt($values, $this->table);
            $result = [
                'kode' => '1',
                'error' => '',
            ];
        }
        echo json_encode($result);
    }
    public function update()
    {
        $id_jabatan         = $_POST['id_jabatan'];
        $nama_jabatan       = $_POST['nama_jabatan'];
        $old_nama_jabatan   = $_POST['old_nama_jabatan'];
        $where_cek = ['id_jabatan !=' => $id_jabatan, 'jabatan' => $nama_jabatan];
        $cek = $this->db->get_where($this->table, $where_cek)->num_rows();
        $result = [];
        if (($cek > 0) && ($nama_jabatan != $old_nama_jabatan)) {
            $result = [
                'kode' => '0',
                'error' => 'Nama Jabatan Sudah Digunakan !!',
            ];
        } else {
            $where = ['id_jabatan' => $id_jabatan];
            $set = [
                'jabatan'   => $this->input->post('nama_jabatan'),
                'level'     => $this->input->post('level'),
            ];
            $this->mydb->update_dt($where, $set, $this->table);
            $result = [
                'kode' => '1',
                'error' => '',
            ];
        }
        echo json_encode($result);
    }
    public function delete()
    {
        $id_jabatan = $_POST['id'];
        $where = array('id_jabatan' => $id_jabatan);
        $jabatan = $this->db->get_where($this->table, $where);
        if ($jabatan->num_rows() > 0) {
            $this->mydb->del($where, $this->table);
            $result = [
                'kode' => '1',
                'error' => '',
            ];
        } else {
            $result = [
                'kode' => '0',
                'error' => 'Gagal Menghapus Jabatan !!!',
            ];
        }
        echo json_encode($result);
    }
    public function get_jabatan()
    {
        $result = $this->db->get_where($this->table, ['id_jabatan' => $_POST['id']])->row();
        echo json_encode($result);
    }
}
