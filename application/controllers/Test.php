<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $username = (!empty($_SESSION['username'])) ? $_SESSION['username'] : 180137;
        $id_level = (!empty($_SESSION['id_level'])) ? $_SESSION['id_level'] : 105;

        $src_detail = (!empty($_SESSION['app_level'] == '1')) ? 2 : 1;


        echo '<b>simak/token</b>';
        // $api_key = json_decode($this->curl->simple_get(ADD_API . 'simak/token?username='.$username))[0];
        // echo 'api_token : ' . $api_key->api_token;
        echo '<br>';
        echo '<br>';

        echo '<b>ref/level</b>';
        $level = json_decode($this->curl->simple_get(ADD_API . 'ref/level?id_level=' . $id_level))[0];
        echo '<br>';
        echo 'id_level : ' . $level->id_level;  //105 /106
        echo '<br>';
        echo 'id_app : ' . $level->id_app;  //16
        echo '<br>';
        echo 'app_level : ' . $level->app_level;  //1 / 2
        echo '<br>';
        echo 'level_name : ' . $level->level_name;  //MAHASISWA
        echo '<br>';
        echo 'kode_prodi : ' . $level->kode_prodi;  //14
        echo '<br>';
        echo 'kode_fak : ' . $level->kode_fak;  //6
        echo '<br>';
        echo '<br>';

        echo '<b>simak/detail_user</b>';
        $user_data = json_decode($this->curl->simple_get(ADD_API . 'simak/detail_user/' . $username . '/' . $src_detail))[0];
        echo '<br>';
        echo 'id_user : ' . $user_data->id_user;      //NPM : 18.14.1.0001
        echo '<br>';
        echo 'nama_user : ' . $user_data->nama_user;  //Nama : ANDI ALFIAN
        echo '<br>';
        echo '<br>';

        echo '<b>simak/detail_login</b>';
        $detail = json_decode($this->curl->simple_get(ADD_API . 'simak/detail_login?id_level=' . $id_level))[0];
        echo '<br>';
        echo 'kode_prodi : ' . $detail->kode_prodi;
        echo '<br>';
        echo 'nama_prodi : ' . $detail->nama_prodi;
        echo '<br>';
        echo 'kode_fak : ' . $detail->kode_fak;       //Informatika
        echo '<br>';
        echo 'nama_fak : ' . $detail->nama_fak;       //FAKULTAS TEKNIK
        echo '<br>';
        echo '<br>';

        echo '<b>simak/mahasiswa_pt</b>';
        $mhs = json_decode($this->curl->simple_get(ADD_API . 'simak/mahasiswa_pt?id_mahasiswa_pt=' . $_SESSION['id_user']))[0];
        echo '<br>';
        echo 'kode_prodi : ' . $mhs->kode_prodi;
        echo '<br>';
        echo 'nama_prodi : ' . $mhs->nama_prodi;
        echo '<br>';
        echo 'kode_fak : ' . $mhs->kode_fak;       //Informatika
        echo '<br>';
        echo 'nama_fak : ' . $mhs->nama_fak;       //FAKULTAS TEKNIK
        echo '<br>';
        echo '<br>';

        // echo "<pre>";
        // print_r($mhs);
        // echo "</pre>";

    }
    public function cek_session()
    {
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }
}

/* End of file Test.php and path \application\controllers\Test.php */
