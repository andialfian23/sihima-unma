<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mydb extends CI_Model
{
    // INPUT
    public function input_dt($data, $table)
    {
        $this->db->insert($table, $data);
    }
    // UPDATE ATAU EDIT
    public function update_dt($where, $data, $table)
    {
        $this->db->where($where)->update($table, $data);
    }
    // HAPUS
    public function del($where, $table)
    {
        $this->db->where($where)->delete($table);
    }

    //USER
    function cek_user($npm)
    {
        return $this->db->get_where('t_user', ['id_mahasiswa_pt' => $npm]);
    }
    function cek_user2($npm, $id_hima)
    {
        return $this->db->get_where('t_user', ['id_mahasiswa_pt' => $npm, 'id_hima' => $id_hima]);
    }
    //ADMIN
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

    //ROLE
    function get_role($level)   //di e_pengurus
    {
        return $this->db->get_where('t_role', ['level' => $level])->row_array();
    }

    //BUAT QRCODE
    public function create_qrcode($nilai_qr)
    {
        $tgl_saat_ini = strtotime(date('Y-m-d H:i:s'));
        $expired = $tgl_saat_ini + 86400;
        $cek_qrcode = $this->db->get_where('t_qrcode', ['nilai' => $nilai_qr]);
        if ($cek_qrcode->num_rows() < 1) {
            //CONFIGURASI QRCODE
            $this->load->library('ciqrcode');
            $config['cacheable'] = true;
            $config['cachedir'] = './images/';
            $config['errorlog'] = './images/';
            $config['imagedir'] = './images/qrcode/';
            $config['quality'] = true;
            $config['size'] = '1024';
            $config['black'] = array(0, 0, 255);
            $config['white'] = array(70, 130, 180);
            $this->ciqrcode->initialize($config);

            //BUAT FILE QRCODE
            $nama_file = random_string('alnum', 40);
            $file_qr = $nama_file . '.png';     //nama file image qrcode
            $params['data'] = $nilai_qr;  //nilai qrcode
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $file_qr;
            $this->ciqrcode->generate($params);

            //INPUT DATA QRCODE
            $data_input = [
                'qrcode' =>  $file_qr,
                'nilai' => $nilai_qr,
                'expired' => $expired
            ];
            $this->input_dt($data_input, 't_qrcode');

            $qrcode = $file_qr;
        } else {
            $data_update = [
                'expired' => $expired
            ];
            $this->update_dt(['nilai' => $nilai_qr], $data_update, 't_qrcode');
            $qrcode = $cek_qrcode->row_array()['qrcode'];
        }
        return $qrcode;
    }
    //HAPUS QRCODE OTOMATIS
    public function del_qrcode_exp()
    {
        $tgl_saat_ini = strtotime(date('Y-m-d H:i:s'));
        $cek_qrcode = $this->db->get_where('t_qrcode', ['expired <' => $tgl_saat_ini]);
        if ($cek_qrcode->num_rows() > 0) {
            foreach ($cek_qrcode->result() as $r) {
                unlink('./images/qrcode/' . $r->qrcode);
                $this->db->where(['qrcode' => $r->qrcode])->delete('t_qrcode');
            }
        }
    }
}
