<?php
defined('BASEPATH') or exit('No direct script access allowed');

//CURL Akses JSON 
function cURL_gan($link)
{
    $url = $link;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, true);
    return $result;
}

function json_row($id_mhs) //dengan ID_MHS 180137
{
    $ieu = get_instance();
    $link = $ieu->curl->simple_get(ADD_API . 'simak/mahasiswa_pt?id_mahasiswa_pt=' . $id_mhs);
    return json_decode($link, true)[0];
}

function json_npm($npm) //dengan NPM
{
    $ieu = get_instance();
    $link = $ieu->curl->simple_get(ADD_API . 'simak/mahasiswa_pt?id_mahasiswa_pt=' . $npm);
    return json_decode($link, true)[0];
}

//BASE_URL GAMBAR/FOTO
function img_qrcode($file)
{
    return base_url('images/qrcode/' . $file);
}
function img_logo($file)    //LOGO
{
    return base_url('images/logo/' . $file);
}
function img_post($file)    //COVER POST
{
    // return base_url('images/cover/' . $file);
    return base_url('media_library/images/' . $file);
}
function pdf_url($file)    //FILE SK
{
    return base_url('assets/sk/' . $file);
}
function pengesahan($file)    //FILE PENGESAHAN
{
    return base_url('media_library/pengesahan/' . $file);
}

//POST
function post_gan($data)
{
    $ieu = get_instance();
    return $ieu->input->post($data);
}

function post_aman($data)
{
    $ieu = get_instance();
    // MENCEGAH SQL INJECTION

    return str_replace("[remove]", "", htmlspecialchars($ieu->input->post($data, TRUE), ENT_QUOTES));
}

//NOTIFIKASI SESSION FLASHDATA
function notifikasi($text, $type)
{
    $ieu = get_instance();
    $warna =  ($type == true) ? 'success' : 'danger';
    $ieu->session->set_flashdata('message', '<div class="alert alert-' . $warna . '" role="alert">' . $text . '</div>');
}

//FORMAT TANGGAL d M Y
function date_id($date)
{
    $BulanIndo = array(
        "Januari", "Februari", "Maret", "April",
        "Mei", "Juni", "Juli", "Agustus", "September",
        "Oktober", "November", "Desember"
    );
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
    $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
    return $result;
}

//WAKTU PELAKSANAAN
function waktu_pelaksanaan($mulai, $selesai)
{
    $tgl_mulai = substr($mulai, 0, 10);
    $tgl_selesai = substr($selesai, 0, 10);
    $jam_mulai = substr($mulai, 11, 5);
    $jam_selesai = substr($selesai, 11, 5);
    if ($tgl_mulai == $tgl_selesai) {
        $result['tanggal'] = longdate_indo($tgl_mulai);
        $result['waktu'] = $jam_mulai . ' - ' . $jam_selesai . ' WIB';
    } else {
        $result['tanggal'] = date_id($tgl_mulai) . ' - ' . date_id($tgl_selesai);
        $result['waktu'] = $jam_mulai . ' - ' . $jam_selesai . ' WIB ';
    }
    return $result;
}

//CEK AKSES CONTROLLER
function akses($controller)
{
    $ieu = get_instance();
    $menu = $ieu->db->get_where('t_controller', ['nama_controller' => $controller])->row_array();
    $userAccess = $ieu->db->get_where('t_menu_access', [
        'level' => $_SESSION['role_id'], 'id_ctr' => $menu['id_ctr']
    ]);
    return $userAccess;
}

//AUTH
function is_logged_in()
{
    $ci = get_instance();
    if (
        (empty($_SESSION['app_level']) or $_SESSION['app_level'] == FALSE)
        || (empty($_SESSION['logged_in']) or $_SESSION['logged_in'] == FALSE)
    ) {
        // $location = 'https://satu.unma.ac.id';
        $location = base_url("Auth");
        redirect($location);
    } else {
        $level      = $_SESSION['role_id'];   //LEVEL
        $controller = $ci->uri->segment('1'); //Nama Controller

        $userAccess = $ci->db->select('a.*, nama_controller')
            ->from('t_menu_access a')
            ->join('t_controller b', 'a.id_ctr=b.id_ctr')
            ->where('level', $level)
            ->where('nama_controller', $controller)->get();

        if ($userAccess->num_rows() < 1) {
            notifikasi('Anda Tidak Memiliki Hak Akses Ke Halaman Tersebut !!!', false);
            redirect(base_url("Dashboard"));
        }
    }
}

// KAPRODI DILARANG AKSES CONTROLLER
function akses_prodi()
{
    if ($_SESSION['role_id'] == 2) {
        notifikasi('Anda tidak memiliki Hak Akses ke halaman tersebut!!!', false);
        redirect(base_url("Dashboard"));
    }
}

//ENCRYPT OTP
function encrypt_encode($msg)
{
    $salt_key = '4CrgnHEzNVogONMBKm4xnvbmLsMTIqfK';
    $ci = get_instance();
    $ci->encryption->initialize(array(
        'cipher' => 'aes-256',
        'mode' => 'ctr',
        'key' => $salt_key
    ));
    $ciphertext = $ci->encryption->encrypt($msg);
    return str_replace('=', '', base64_encode($ciphertext));
}
