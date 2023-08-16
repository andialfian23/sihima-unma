<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{
    var $table = 't_post';

    //BACK END
    function get_postingan($id_mj)     //ALL POST per masa jabatan
    {
        $this->db->select('a.*, nama_kategori, nama_mhs as pembuat ');
        $this->db->from($this->table . ' a');
        $this->db->join('t_kategori b', 'a.id_kategori = b.id_kategori');
        $this->db->join('t_mahasiswa c', 'a.id_mahasiswa_pt=c.id_mahasiswa_pt', 'LEFT');
        $this->db->where('id_mj', $id_mj);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get();
    }
    function get_postingan_ku($npm)     //Postingan per npm
    {
        $this->db->select('a.*, b.nama_kategori ');
        $this->db->from($this->table . ' a')->join('t_kategori b', 'a.id_kategori = b.id_kategori');
        $this->db->where('id_mahasiswa_pt', $npm)->order_by('created_at', 'DESC');
        return $this->db->get();
    }
    function get_post($id_post, $npm)   //1 postingan
    {
        $this->db->select("a.*, nama_kategori, b.slug as slug_kategori,
            singkatan, nama_hima, logo, CONCAT(periode1,' / ',periode2) as periode");
        $this->db->from($this->table . ' a');
        $this->db->join('t_kategori b', 'a.id_kategori = b.id_kategori');
        $this->db->join('t_masa_jabatan c', 'a.id_mj = c.id_mj');
        $this->db->join('t_hima d', 'c.id_hima = d.id_hima');
        $this->db->where('a.id_post', $id_post)->where('a.id_mahasiswa_pt', $npm);
        return $this->db->get();
    }
    //FRONT END
    function dilihat($id_post)
    {
        $where = ['id_post' => $id_post];
        $post = $this->db->get_where($this->table, $where)->row_array();
        $dilihat = $post['dilihat'] + 1;
        $set = ['dilihat' => $dilihat];
        $this->mydb->update_dt($where, $set, $this->table);
    }
    public function new_posts()
    {
        return $this->db->select('a.*, nama_kategori, b.slug as slug_k')
            ->from($this->table . ' a')->join('t_kategori b', 'a.id_kategori = b.id_kategori')
            ->where('a.is_published', '1')
            ->order_by('a.created_at', 'DESC')
            ->limit(6)->get()->result_array();
    }
    function post($slug)
    {
        $this->db->select('a.*, nama_kategori, periode1, periode2, singkatan, nama_hima, logo, nama_mhs as author');
        $this->db->from($this->table . ' a');
        $this->db->join('t_kategori b', 'a.id_kategori = b.id_kategori');
        $this->db->join('t_masa_jabatan c', 'a.id_mj = c.id_mj');
        $this->db->join('t_hima d', 'c.id_hima = d.id_hima');
        $this->db->join('t_mahasiswa m', 'a.id_mahasiswa_pt = m.id_mahasiswa_pt', 'LEFT');
        $this->db->where('a.is_published', '1')->where('a.slug', $slug);
        $query = $this->db->get();
        $data = [];
        $data['num_rows'] = $query->num_rows();
        $data['result'] = $query->row_array();
        return $data;
    }
    function posts($limit)
    {
        $data = [];
        $data['num_rows'] = $this->db->get_where($this->table, ['is_published' => '1'])->num_rows();

        $data['result'] = $this->db->select('a.*, nama_kategori, b.slug as slug_k, singkatan')
            ->from($this->table . ' a')
            ->join('t_kategori b', 'a.id_kategori = b.id_kategori')
            ->join('t_masa_jabatan c', 'a.id_mj = c.id_mj')
            ->join('t_hima d', 'c.id_hima = d.id_hima')
            ->where('a.is_published', '1')
            ->order_by('a.created_at', 'DESC')
            ->limit(6, $limit)->get()->result_array();
        return $data;
    }
    function posts_by_kategori($limit, $slug)
    {
        $this->db->select('a.*, b.nama_kategori, b.slug as slug_k, d.singkatan')->from($this->table . ' a');
        $this->db->join('t_kategori b', 'a.id_kategori = b.id_kategori');
        $this->db->join('t_masa_jabatan c', 'a.id_mj = c.id_mj');
        $this->db->join('t_hima d', 'c.id_hima = d.id_hima')
            ->where('a.is_published', '1')
            ->where('b.slug', $slug)
            ->order_by('created_at', 'DESC');
        $this->db->limit(6, $limit);
        $query = $this->db->get();
        $data = [];
        $data['result'] = $query->result_array();

        $this->db->select('a.*')->from($this->table . ' a')
            ->join('t_kategori b', 'a.id_kategori = b.id_kategori')
            ->where('a.is_published', '1')
            ->where('b.slug', $slug);
        $query = $this->db->get();
        $data['num_rows'] = $query->num_rows();
        return $data;
    }
    function posts_by_hima($limit, $singkatan)
    {
        $this->db->select('a.*, b.nama_kategori, b.slug as slug_k,  d.singkatan')->from($this->table . ' a');
        $this->db->join('t_kategori b', 'a.id_kategori = b.id_kategori');
        $this->db->join('t_masa_jabatan c', 'a.id_mj = c.id_mj');
        $this->db->join('t_hima d', 'c.id_hima = d.id_hima');
        $this->db->where('a.is_published', '1');
        $this->db->where('d.singkatan', $singkatan)->order_by('created_at', 'DESC');
        $this->db->limit(6, $limit);
        $query = $this->db->get();
        $data = [];
        $data['result'] = $query->result_array();

        $this->db->select('a.*,  d.singkatan')->from($this->table . ' a')
            ->join('t_masa_jabatan c', 'a.id_mj = c.id_mj')
            ->join('t_hima d', 'c.id_hima = d.id_hima')
            ->where('a.is_published', '1')
            ->where('d.singkatan', $singkatan);
        $query = $this->db->get();
        $data['num_rows'] = $query->num_rows();
        return $data;
    }
    function posts_by_find($limit, $keyword)
    {
        $this->db->select('a.*, b.nama_kategori, b.slug as slug_k,  d.singkatan')->from($this->table . ' a');
        $this->db->join('t_kategori b', 'a.id_kategori = b.id_kategori');
        $this->db->join('t_masa_jabatan c', 'a.id_mj = c.id_mj');
        $this->db->join('t_hima d', 'c.id_hima = d.id_hima');
        $this->db->where('a.is_published', '1');
        $this->db->like('judul', $keyword)->order_by('created_at', 'DESC');
        $this->db->limit(6, $limit);
        $query = $this->db->get();
        $data = [];
        $data['result'] = $query->result_array();
        $data['num_rows'] = $this->db->like('judul', $keyword)->get($this->table)->num_rows();
        return $data;
    }
    function categories()
    {
        $this->db->select("b.*, count(id_post) as jml");
        $this->db->from($this->table . ' a')->join('t_kategori b', 'a.id_kategori = b.id_kategori');
        $this->db->where('is_published', '1')->group_by('a.id_kategori');
        return $this->db->get()->result_array();
    }
    public function post_populer() // untuk di view s_extra
    {
        return $this->db->select('p.*, nama_mhs as author')
            ->from($this->table . ' p')
            ->join('t_mahasiswa m', 'p.id_mahasiswa_pt=m.id_mahasiswa_pt', 'LEFT')
            ->where('is_published', '1')
            ->order_by('dilihat', 'DESC')
            ->limit(5, 0)
            ->get()->result_array();
    }

    //PAGINATION
    public function pagination($base_url, $total_data)
    {
        $this->load->library('pagination');

        $config['base_url']     = $base_url;   //site url
        $config['total_rows']   = $total_data; //total data
        $config['per_page']     = 6;           //total data yang tampil dalam satu halaman
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"]    = floor($choice);
        //CONFIGURASI TAMPILAN PAGINATION
        $config['full_tag_open']    = '<nav class="pgn" data-aos="fade-up"><ul>';
        $config['full_tag_close']   = '</ul></nav>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['prev_link']        = '';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li><span class="pgn__num current">';
        $config['cur_tag_close']    = '</span></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        //KIRIM HASIL KONFIGURASI
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}
