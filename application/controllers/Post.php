<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    var $table = 't_post';

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('post_model');
    }

    // VIEW ADD POST
    public function index()
    {
        $kategori = $this->db->get('t_kategori')->result_array();
        $this->load->view('dashboard/template/main', [
            'title'  => 'Tambah Postingan Baru',
            'tampil' => $kategori,
            'file'   => 'post/i_post',
        ]);
    }

    // PROSES INSERT
    public function insert()
    {
        $proses_upload = $this->upload_image();
        if ($proses_upload['status'] == "error") {
            $response = $proses_upload['message'];
        } else {
            $cover = $proses_upload['file_name'];
            $time = date("Y-m-d H:i:s");
            $values = array(
                'id_mj'             => $_SESSION['id_mj'],
                'id_mahasiswa_pt'   => $_SESSION['id_mahasiswa_pt'],
                'id_kategori'       => post_gan('kategori'),
                'judul'             => post_gan('judul'),
                // 'slug'              => slugify(post_gan('judul')),
                'slug'              => sha1(post_gan('judul')),
                'cover'             => $cover,
                'body'              => post_gan('isi_postingan'),
                'is_published'      => post_gan('is_published'),
                'created_at'        => $time,
            );
            $this->mydb->input_dt($values, $this->table);
            $response = 1;
        }
        echo json_encode($response);
    }

    // VIEW EDIT
    public function e_post($id_post = null)
    {
        if ($id_post == null) {
            notifikasi('Postingan tidak ditemukan', false);
            redirect(base_url("Pengurus/postinganku"));
        }

        $post = $this->post_model->get_post($id_post, $_SESSION['id_mahasiswa_pt']);
        if ($post->num_rows() > 0) {
            $this->load->view('dashboard/template/main', [
                'title'  => 'Edit Postingan',
                'post'   => $post->row_array(),
                'tampil' => $this->db->get('t_kategori')->result_array(),
                'file'   => 'post/e_post'
            ]);
        } else {
            notifikasi('Postingan tidak ditemukan', false);
            redirect(base_url("Pengurus/postinganku"));
        }
    }

    // PROSES UPDATE
    public function update($id_post = null)
    {
        if ($id_post == null) {
            notifikasi('Postingan tidak ditemukan', false);
            redirect(base_url("Pengurus/postinganku"));
        } else {
            $where = ['id_post' => $id_post, 'id_mahasiswa_pt' => $_SESSION['id_mahasiswa_pt']];
            $post = $this->post_model->get_post($id_post, $_SESSION['id_mahasiswa_pt'])->row_array();
            $up_image = $_FILES['cover']['name'];
            if ($up_image) {
                $id = 'test1';
                $proses_upload = $this->upload_image($id);
                if ($proses_upload['status'] == "error") {
                    $response = $proses_upload['message'];
                } else {
                    $cover = $proses_upload['file_name'];
                    $this->mydb->update_dt($where, ['cover' => $cover], $this->table);
                    unlink(FCPATH . 'media_library/images/' . $post['cover']); //cover
                }
            }
            $set = array(
                'id_kategori' => post_gan('kategori'),
                'judul' => post_gan('judul'),
                'slug' => slugify(post_gan('judul')),
                'body' => post_gan('isi_postingan')
            );
            $this->mydb->update_dt($where, $set, $this->table);
            $response = 1;
        }
        echo $response;
    }

    // PROSES UPLOAD IMAGE
    private function upload_image()
    {
        $config['upload_path'] = './media_library/images/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 0;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('cover')) {
            $this->vars['status'] = 'error';
            $this->vars['message'] = $this->upload->display_errors();
        } else {
            $file = $this->upload->data();
            // chmood new file
            @chmod(FCPATH . 'media_library/images/' . $file['file_name'], 0777);
            // resize new image
            //$this->image_resize(FCPATH.'media_library/images', $file['file_name']);

            // $cdn_upload = $this->image_cdn(FCPATH . 'media_library/images', $file['file_name'], 'images');
            // if (!$cdn_upload) {
            //     $this->vars['status'] = 'error';
            //     $this->vars['message'] = $this->upload->display_errors();
            // } else {
            $this->vars['status'] = 'success';
            // $this->vars['file_name'] = $cdn_upload;
            $this->vars['file_name'] = $file['file_name'];
            // }

            // if ( _isNaturalNumber($id) ) {
            // $query = $this->Kegiatan_model->get($id);
            // // chmood old file
            // @chmod(FCPATH.'media_library/posts/thumbnail/'.$query->cover, 0777);
            // @chmod(FCPATH.'media_library/posts/medium/'.$query->cover, 0777);
            // @chmod(FCPATH.'media_library/posts/large/'.$query->cover, 0777);
            // // unlink old file
            // @unlink(FCPATH.'media_library/posts/thumbnail/'.$query->cover);
            // @unlink(FCPATH.'media_library/posts/medium/'.$query->cover);
            // @unlink(FCPATH.'media_library/posts/large/'.$query->cover);
            // }
        }
        return $this->vars;
    }

    // API UPLOAD IMAGE
    private function image_cdn($folder = null, $file_name = null, $path = null)
    {
        $key = 'bdc36239822054a0ad81738a88beb056';
        $source_image = base_url('media_library/' . $path . '/' . $file_name);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://img.unma.ac.id/api/1/upload/knm/?key=" . $key . "&format=txt&source=" . $source_image,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        // Remove Original File
        if ($err) {
            return $err;
        } else {
            @unlink($folder . '/' . $file_name);
            return $response;
        }
    }

    // PROSES PUBLISH & UNPUBLISH
    public function is_published()
    {
        $id_post = (!empty($this->input->post('id_post', TRUE))) ? $this->input->post('id_post', TRUE) : null;
        if ($id_post == null) {
            $kode = '0';
            $pesan = 'Postingan tidak ditemukan';
        } else {
            $post = $this->post_model->get_post($id_post, $_SESSION['id_mahasiswa_pt']);
            if ($post->num_rows() > 0) {
                $post = $post->row();
                $status = ($post->is_published == '1') ? '0' : '1';
                $where  = ['id_post' => $id_post];
                $set    = ['is_published' => $status];
                $this->mydb->update_dt($where, $set, $this->table);

                $kode = '1';
                $pesan = ($status == '1')
                    ? 'Postingan ' . $post->judul . ' berhasil dipublish !!!'
                    : 'Postingan ' . $post->judul . ' tidak dipublish !!!';
            } else {
                $kode = '0';
                $pesan = 'Postingan Tidak Ditemukan !!!';
            }
        }

        $output = [
            'kode' => $kode,
            'pesan' => $pesan,
        ];
        echo json_encode($output);
    }

    //DELETE POSTINGAN
    public function delete()
    {
        $id_post = (!empty($this->input->post('id_post', TRUE))) ? $this->input->post('id_post', TRUE) : null;
        if ($id_post == null) {
            $kode = '0';
            $pesan = 'Gagal Menghapus Postingan';
        } else {
            $post = $this->post_model->get_post($id_post, $_SESSION['id_mahasiswa_pt']);
            if ($post->num_rows() > 0) {
                //HAPUS POST
                $where = ['id_post' => $id_post];
                $cover = $post->row()->cover; // nama file

                unlink(FCPATH . 'media_library/images/' . $cover);

                $this->mydb->del($where, $this->table);
                $kode = '1';
                $pesan = 'Postingan berhasil dihapus!!!';
            } else {
                $kode = '0';
                $pesan = 'Postingan tidak bisa dihapus!!!';
            }
        }

        $output = [
            'kode' => $kode,
            'pesan' => $pesan
        ];
        echo json_encode($output);
    }
}
