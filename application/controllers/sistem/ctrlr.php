<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ctrlr extends CI_Controller
{
    var $table = 't_controller';
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $controllers = $this->db->order_by('id_ctr', 'ASC')->get($this->table)->result_array();
        $this->load->view('dashboard/template/main', [
            'controllers' => $controllers,
            'title'  => 'Manajemen Controller',
            'file'   => 'admin/index_ctrlr',
        ]);
    }
    public function get_ctrlr()
    {
        $id = $_POST['id'];
        if (!empty($id)) {
            $result = $this->db->get_where($this->table, ['id_ctr' => $id])->row();
        } else {
            $result = $this->db->order_by('nama_controller', 'ASC')->get($this->table)->result();
        }
        echo json_encode($result);
    }
    public function insert()
    {
        $nama_controller = $this->input->post('nama_controller', true);

        if ($this->db->get_where($this->table, ['nama_controller' => $nama_controller])->num_rows() > 0) {
            $result = [
                'kode' => '0',
                'error' => 'Nama controller sudah ada',
            ];
        } else {
            $this->db->insert($this->table, [
                'nama_controller' => $nama_controller,
                'fitur' => $this->input->post('fitur')
            ]);
            $result = [
                'kode' => '1',
                'error' => '',
            ];
        }
        echo json_encode($result);
    }
    public function update()
    {
        $id_ctr = $_POST['id_ctr'];
        $nama_controller = $this->input->post('nama_controller', true);
        $where1 = ['id_ctr !=' => $id_ctr, 'nama_controller' => $nama_controller];
        $cek = $this->db->get_where($this->table, $where1)->num_rows();
        $result = [];
        if ($cek > 0) {
            $result = [
                'kode' => '0',
                'error' => 'Nama Controller Sudah Digunakan !!',
            ];
        } else {

            $where  = ['id_ctr' => $id_ctr];
            $set    = [
                'nama_controller' => $nama_controller,
                'fitur'           => $this->input->post('fitur', true)
            ];
            $this->mydb->update_dt($where, $set, $this->table);
            $result = [
                'kode' => '1',
                'error' => $_POST
            ];
        }
        echo json_encode($result);
    }
    function delete()
    {
        if (!empty($_POST['id'])) {
            $where = ['id_ctr' => $_POST['id']];
            $this->mydb->del($where, $this->table);
            echo json_encode(1);
        }
    }
}
