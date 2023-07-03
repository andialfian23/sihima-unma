<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cash_rule extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    // //SHOW & INPUT CASH_RULE 
    public function index()
    {
        $this->form_validation->set_rules(
            'cash_rule',
            'cash_rule',
            'required|trim|is_unique[t_cash_rule.cash_rule]',
            ['required' => 'Peraturan tidak boleh kosong', 'is_unique' => 'Peraturan sudah ada !!!']
        );
        if ($this->form_validation->run() == false) {
            $cash_rule = $this->db->get_where('t_cash_rule', ['id_hima' => $_SESSION['hima_id']])->result_array();
            $this->load->view('dashboard/template/main', [
                'title'     =>  "Peraturan Kas Himpunan",
                'assets_css' => array("themes/vendors/css/tables/datatable/datatables.min.css"),
                'assets_js' => array("themes/vendors/js/tables/datatable/datatables.min.js"),
                'tampil'    => $cash_rule,
                'file'      => 'cash_rule/index',
            ]);
        } else {
            $data_values = array(
                'cash_rule' => $this->input->post('cash_rule'),
                'id_hima' => $_SESSION['hima_id'],
                'created_at' => date("Y-m-d H:i:s")
            );
            $this->mydb->input_dt($data_values, 't_cash_rule');
            notifikasi('Penambahan Peraturan Keuangan Berhasil!!!', true);
            redirect(base_url("Keuangan/cash_rule"));
        }
    }

    public function edit($id_cr = null)
    {
        if ($id_cr == null) {
            notifikasi('Peraturan keuangan tidak ada yang dipilih!!!', false);
            redirect(base_url("Keuangan/cash_rule"));
        }
        $id_hima =  $_SESSION['hima_id'];
        $where = ['id_hima' => $id_hima, 'id_cr' => $id_cr];
        $cash_rule = $this->db->get_where('t_cash_rule', $where);
        if ($cash_rule->num_rows() > 0) {
            $this->form_validation->set_rules('nm_cr', 'Cash Rule', 'required|trim');
            if ($this->form_validation->run() == false) {
                $this->load->view('dashboard/template/main', [
                    'title' => "Edit Peraturan Keuangan",
                    'cr'    => $cash_rule->row_array(),
                    'file'  => 'cash_rule/edit',
                ]);
            } else {
                $data_set = array(
                    'cash_rule' => post_gan('nm_cr')
                );
                $this->mydb->update_dt($where, $data_set, 't_cash_rule');
                notifikasi('Update Peraturan Keuangan Berhasil!!!', true);
                redirect(base_url("Keuangan/cash_rule"));
            }
        } else {
            notifikasi('Peraturan Keuangan Tidak Ditemukan!!', false);
            redirect(base_url("Keuangan/cash_rule"));
        }
    }

    function delete($id_cr)
    {
        $hima_id = $_SESSION['hima_id'];
        $cek = $this->db->get_where('t_cash_rule', ['id_hima' => $hima_id, 'id_cr' => $id_cr]);
        if ($cek->num_rows() > 0) {
            $where = array('id_cr' => $id_cr, 'id_hima' => $hima_id);
            $this->mydb->del($where, 't_cash_rule');
            notifikasi('Peraturan Keuangan berhasil dihapus!!', true);
        } else {
            notifikasi('Peraturan Keuangan Tidak Ditemukan!!', false);
        }
        redirect(base_url("Keuangan/cash_rule"));
    }
}
