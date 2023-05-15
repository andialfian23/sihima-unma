<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HM extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mydb');
        $this->load->model('mj_model');
        $this->load->model('hima_model');
        $this->load->model('kegiatan_model', 'kegiatan');
        $this->load->model('pengurus_model', 'pengurus');
        $this->load->model('post_model', 'post');
    }
    public function index()
    {
        redirect(base_url('HM/posts'));
    }
    //POST
    public function posts()
    {
        $limit = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $posts = $this->post->posts($limit);
        $jml = $posts['num_rows'];
        halaman(site_url('HM/posts'), $jml);
        $data['pagination'] = $this->pagination->create_links();
        $data['tampil'] = $posts['result'];
        $data['title'] = "Himpunan Mahasiswa Universitas Majalengka";
        $data['file'] = 'home';
        $this->load->view('front/index', $data);
    }
    public function post($slug = null)
    {
        if ((empty($slug)) || ($slug == null)) {
            notifikasi('Halaman tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
        $query = $this->post->post($slug);
        if ($query['num_rows'] < 1) {
            notifikasi('Postingan tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
        $post = $query['result'];
        $this->post->dilihat($post['id_post']);
        $data['col']    = $post;
        $data['title']  = "Himpunan Mahasiswa Universitas Majalengka";
        $data['file']   = 'post';
        $this->load->view('front/index', $data);
    }
    public function kategori($slug = null)
    {
        if (($slug == null) || empty($slug)) {
            redirect(base_url('HM/posts'));
        }
        $cek_kategori = $this->db->get_where('t_kategori', ['slug' => $slug]);
        if ($cek_kategori->num_rows() > 0) {
            $data['col'] = $cek_kategori->row_array();
            $data['title'] = $data['col']['nama_kategori'];
            $data['kategori'] = "Kategori : " . $data['title'];

            $limit = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $posts = $this->post->posts_by_kategori($limit, $slug);
            $jml = $posts['num_rows'];
            halaman(site_url('HM/kategori/' . $slug), $jml);
            $data['pagination'] = $this->pagination->create_links();
            $data['tampil'] = $posts['result'];
            $data['file']   = 's_kategori';
            $this->load->view('front/index', $data);
        } else {
            notifikasi('Kategori tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
    }
    public function cari()
    {
        // $keyword = urldecode($this->input->get('search'));
        $keyword = urldecode(htmlspecialchars($this->input->get('search')));
        if (!isset($keyword) || $keyword == '') {
            notifikasi('Pencarian tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
        $limit = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $jml = $this->post->posts_by_find($limit, $keyword)['num_rows'];
        if ($jml > 0) {
            $data['title'] = "Pencarian : " . $keyword;
        } else {
            $data['title'] = $keyword . " tidak ditemukan !!!";
            notifikasi('Pencarian tidak ditemukan !!!', false);
        }
        $data['kategori'] = $data['title'];
        halaman(site_url('HM/cari/' . $keyword), $jml);
        $data['pagination'] = $this->pagination->create_links();
        $data['tampil'] = $this->post->posts_by_find($limit, $keyword)['result'];
        $data['file']   = 'find';
        $this->load->view('front/index', $data);
    }
    //HIMPUNAN
    public function hima($singkatan = null)
    {
        if (($singkatan == null) || empty($singkatan)) {
            redirect(base_url('HM/posts'));
        }
        $singkatan = urldecode($singkatan);
        $cek_hima = $this->db->get_where('t_hima', ['singkatan' => $singkatan]);
        if ($cek_hima->num_rows() > 0) {
            $data['col'] = $cek_hima->row_array();
            $data['title'] = $data['col']['nama_hima'];
            $data['kategori'] = $data['title'];

            $limit = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $posts = $this->post->posts_by_hima($limit, $singkatan);
            $jml = $posts['num_rows'];
            halaman(site_url('HM/kategori/' . $singkatan), $jml);
            $data['pagination'] = $this->pagination->create_links();
            $data['tampil'] = $posts['result'];
            $data['file']   = 's_hima';
            $this->load->view('front/index', $data);
        } else {
            notifikasi('Himpunan tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
    }
    public function info_hima($singkatan)
    {
        $cek_hima = $this->db->get_where('t_hima', ['singkatan' => urldecode($singkatan)]);
        if ($cek_hima->num_rows() > 0) {
            $mj = $this->mj_model->get_mj_aktif($cek_hima->row_array()['id_hima']);
            $data['col'] = $mj;
            $data['anggota'] = $this->pengurus->get_anggota_pengurus($mj['id_hima'], $mj['id_mj']);
            $data['title']  = $data['col']['nama_hima'];
            $data['file']   = 'info_hima';
            $this->load->view('front/index', $data);
        } else {
            notifikasi('Himpunan tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
    }
    public function himpunan()
    {
        $data['title'] = 'Himpunan Mahasiswa Universitas Majalengka';
        $limit  = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $hima   = $this->hima_model->hima_aktif($limit);
        $jml    = $hima['num_rows'];
        halaman(site_url('HM/himpunan'), $jml);
        $data['tampil'] = $hima['result'];
        $data['pagination'] = $this->pagination->create_links();
        $data['file']   = 'himpunan';
        $this->load->view('front/index', $data);
    }
    //REGISTRASI
    public function register()
    {
        $data['title'] = 'Registrasi';
        $this->form_validation->set_rules('nama', 'nama', 'required|trim|alpha_numeric_spaces', [
            'required' => 'Nama Tidak boleh dikosongkan !!',
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', [
            'required' => 'Bagian ini tidak boleh dikosongkan !!'
        ]);
        $this->form_validation->set_rules('asal_sekolah', 'asal_sekolah', 'trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim', [
            'required' => 'Email tidak boleh dikosongkan !!'
        ]);
        $this->form_validation->set_rules('telp', 'telp', 'required|trim|numeric', [
            'required' => 'Bagian ini tidak boleh dikosongkan !!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['kegiatan'] = $this->kegiatan->kegiatan_umum();
            $data['file']   = 'register';
            $this->load->view('front/index', $data);
        } else {
            $this->load->helper('string');
            $email = post_aman('email');
            $nama = strtoupper(post_aman('nama'));
            //BUAT TOKEN
            $token = random_string('alnum', 50);

            //INPUT PESERTA
            $cek_peserta = $this->db->get_where('t_peserta', ['nama' => $nama, 'email' => $email]);
            if ($cek_peserta->num_rows() < 1) {
                $d12 = date('y');
                $d34 = date('m');
                $dakhir = $this->db->query('SELECT max(id+1) as jml FROM t_peserta')->row_array()['jml'];
                $id_peserta = 'PS.' . $d12 . '.' . $d34 . '.' . $dakhir;
                $kolom = [
                    'id_peserta' => $id_peserta,
                    'email' => $email,
                    'token' => $token,
                    'nama' => $nama,
                    'asal_sekolah' => post_aman('asal_sekolah'),
                    'alamat' => post_aman('alamat'),
                    'telp' => post_aman('telp')
                ];
                $this->mydb->input_dt($kolom, 't_peserta');
            } else {
                $id_peserta = $cek_peserta->row_array()['id_peserta'];
                $token = $cek_peserta->row_array()['token'];
            }

            $no_kg = post_gan('no_kg'); //NPM
            $ttl = count($no_kg);
            $text = '';
            for ($i = 0; $i < $ttl; $i++) {
                $token2 = random_string('alnum', 50);
                $cek_absen = $this->db->get_where('t_absen', ['no_id' => $id_peserta, 'no_kegiatan' => $no_kg[$i]]);
                $nama_kegiatan = $this->db->get_where('t_kegiatan', ['no_kegiatan' => $no_kg[$i]])->row_array()['nama_kegiatan'];
                if ($cek_absen->num_rows() > 0) {
                    $text .= 'Anda sudah terdaftar pada kegiatan ' . $nama_kegiatan . '<br>';
                } else {
                    $data2 = array(
                        'no_kegiatan' => $no_kg[$i],
                        'mhs_unma' => '0',
                        'no_id' => $id_peserta,
                        'status' => 'Belum Hadir',
                        'sebagai' => 'Peserta',
                        'token_presensi' => $token2
                    );
                    // echo json_encode($data2, true);
                    $this->mydb->input_dt($data2, 't_absen');
                    $text .= 'Anda berhasil terdaftar pada kegiatan ' . $nama_kegiatan . '<br>';
                }
            }

            $token_presensi = $this->db->select('token_presensi,nama_kegiatan')
                ->from('t_absen a')->join('t_kegiatan b', 'a.no_kegiatan=b.no_kegiatan')
                ->where('no_id', $id_peserta)->get();
            $data_link = '';
            foreach ($token_presensi->result_array() as $row) {
                // $data_link .= '<a href="' . base_url() . 'Presensi/online/' . $row['token_presensi'] . '">Presensi Kegiatan '.$row['nama_kegiatan'].'</a><br>';
                $data_link .= 'Presensi Kegiatan ' . $row['nama_kegiatan'] . ' : ' . base_url() . 'Presensi/online/' . $row['token_presensi'] . ' ';
            }

            $this->_setEmail($token, $email, $data_link);

            // $this->_sendEmail($token, $email, $data_link);

            //NOTIFIKASI
            $this->session->set_flashdata('message', '<div class="alert-box alert-box--success hideit"> <p>' . $text . '</p><i class="fa fa-times alert-box__close"></i></div>');
            redirect(base_url('HM/info?id=' . $token));
        }
    }
    //CONFIGURASI EMAIL
    private function _setEmail($token, $email_penerima, $data_link)
    {
        $email_saya = 'hima@unma.ac.id';
        $password_email = 'H&Mb{4!K6gh?YoX.|04M6S,ENw;w,$';
        $this->load->library('encryption');
        $config = [
            'protocol' => 'smtp',
            // 'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => $email_saya,
            'smtp_pass' => $password_email,
            'smtp_port' => '465',
            'smtp_crypto' => 'ssl',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->from($email_saya, 'HIMA UNMA');
        $this->email->to($email_penerima);
        $this->email->subject('INFO PESERTA');
        $this->email->message(' Berikut adalah link untuk : 
        Informasi Anda : ' . base_url() . 'HM/info/' . urlencode($token) . ' ' . $data_link . ' ');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    //INFO PESERTA
    public function info()
    {
        $token = str_replace(' ', '+', $_GET['id']);
        if ($token == null) {
            $text = 'Data Peserta tidak ditemukan!!!';
            $this->session->set_flashdata('message', '<div class="alert-box alert-box--success hideit"> <p>' . $text . '</p><i class="fa fa-times alert-box__close"></i></div>');
            redirect(base_url('HM/register'));
        }
        $query = $this->db->get_where('t_peserta', ['token' => $token]);
        if ($query->num_rows() < 1) {
            $text = 'Data Peserta tidak ditemukan!!!';
            $this->session->set_flashdata('message', '<div class="alert-box alert-box--error hideit"> <p>' . $text . '</p><i class="fa fa-times alert-box__close"></i></div>');
            redirect('HM/register');
        } else {
            $data['qrcode'] = $this->mydb->create_qrcode($query->row_array()['id_peserta']);
        }

        $data['col'] = $query->row_array();
        $data['title'] = 'Informasi Peserta';
        $data['file']  = 'info';
        $this->load->view('front/index', $data);
    }
    //LAINNYA
    public function block()
    {
        $data['title'] = "Error Not Found";
        $data['file']   = 'block';
        $this->load->view('front/index', $data);
    }
}
