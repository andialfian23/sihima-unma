<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HM extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mj_model');
        $this->load->model('hima_model');
        $this->load->model('kegiatan_model', 'kegiatan');
        $this->load->model('pengurus_model', 'pengurus');
        $this->load->model('post_model', 'post');
    }
    public function index()
    {
        $posts = $this->post->new_posts();
        $this->load->view('front/template/main', [
            'title' => 'Himpunan Mahasiswa Universitas Majalengka',
            'posts' => $posts,
            'file'  => 'index',
        ]);
    }
    //POST
    public function posts($limit = null)
    {
        $limit  = ($limit == null) ? 0 : $limit;
        $posts  = $this->post->posts($limit);
        $jml    = $posts['num_rows'];
        $posts  = $posts['result'];
        $pagination = $this->post->pagination(site_url('HM/posts'), $jml);
        $this->load->view('front/template/main', [
            'title' => "Himpunan Mahasiswa Universitas Majalengka",
            'posts' => $posts,
            'pagination' => $pagination,
            'file'  => 'post/index',
        ]);
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

        $this->load->view('front/template/main', [
            'title' => "Himpunan Mahasiswa Universitas Majalengka",
            'post' => $post,
            'file' => 'post/show',
        ]);
    }
    public function kategori($slug = null)
    {
        if (($slug == null) || empty($slug)) {
            redirect(base_url('HM/posts'));
        }
        $cek_kategori = $this->db->get_where('t_kategori', ['slug' => $slug]);
        if ($cek_kategori->num_rows() > 0) {
            $kategori = $cek_kategori->row_array();
            $title = $kategori['nama_kategori'];
            $judul_posts = "Kategori : " . $title;

            $limit  = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $post  = $this->post->posts_by_kategori($limit, $slug);
            $jml    = $post['num_rows'];
            $posts  = $post['result'];
            $pagination = $this->post->pagination(site_url('HM/kategori/' . $slug), $jml);

            $this->load->view('front/template/main', [
                'kategori'      => $kategori,
                'title'         => $title,
                'judul_posts'   => $judul_posts,
                'posts'         => $posts,
                'pagination'    => $pagination,
                'file'          => 'posts_by_category',
            ]);
        } else {
            notifikasi('Kategori tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
    }
    public function cari()
    {
        $keyword = str_replace("[removed]", "", htmlspecialchars(urldecode($this->input->get('search', TRUE))));
        if (!isset($keyword) || $keyword == '') {
            notifikasi('Pencarian tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
        $limit = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $jml = $this->post->posts_by_find($limit, $keyword)['num_rows'];
        if ($jml > 0) {
            $title = "Pencarian : " . $keyword;
        } else {
            $title = $keyword . " tidak ditemukan !!!";
            notifikasi('Pencarian tidak ditemukan !!!', false);
        }

        $pagination = $this->post->pagination(site_url('HM/cari/' . $keyword), $jml);
        $posts = $this->post->posts_by_find($limit, $keyword)['result'];
        $this->load->view('front/template/main', [
            'title'         => $title,
            'judul_posts'   =>  $title,
            'posts'         => $posts,
            'pagination'    => $pagination,
            'file'          => 'posts_by_find',
        ]);
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
            $hima = $cek_hima->row_array();
            $title = $hima['nama_hima'];

            $limit = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $posts = $this->post->posts_by_hima($limit, $singkatan);
            $jml    = $posts['num_rows'];
            $pagination = $this->post->pagination(site_url('HM/kategori/' . $singkatan), $jml);
            $this->load->view('front/template/main', [
                'title'     => $title,
                'judul_posts' => $title,
                'hima'      => $hima,
                'posts'     => $posts['result'],
                'pagination' => $pagination,
                'file'      => 'posts_by_hima',
            ]);
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
            // $hima = $mj;
            $pengurus = $this->pengurus->get_anggota_pengurus($mj['id_hima'], $mj['id_mj']);

            $this->load->view('front/template/main', [
                'title' => $mj['nama_hima'],
                'hima' => $mj,
                'anggota' => $pengurus,
                'file' => 'info_hima',
            ]);
        } else {
            notifikasi('Himpunan tidak ditemukan !!!', false);
            redirect(base_url('HM/block'));
        }
    }
    public function himpunan()
    {
        $limit  = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $hima   = $this->hima_model->hima_aktif($limit);
        $jml        = $hima['num_rows'];
        $all_hima   = $hima['result'];
        $pagination = $this->post->pagination(site_url('HM/himpunan'), $jml);

        $this->load->view('front/template/main', [
            'title' => 'Himpunan Mahasiswa Universitas Majalengka',
            'tampil' => $all_hima,
            'pagination' => $pagination,
            'file'  => 'himpunan',
        ]);
    }

    //LAINNYA
    public function block()
    {
        $this->load->view('front/template/main', [
            'title' => "Error Not Found",
            'file'  => 'block',
        ]);
    }
}
