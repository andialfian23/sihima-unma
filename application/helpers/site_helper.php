<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Is Integer
 * @param String $n
 * @return Boolean
 */
if (!function_exists('_toInteger')) {
    function _toInteger($n)
    {
        $n = abs(intval(strval($n)));
        return $n;
    }
}

/**
 * get __session
 * @param String $session_key
 * @return Any
 */
if (!function_exists('__session')) {
    function __session($session_key)
    {
        $CI = &get_instance();
        return $CI->session->userdata($session_key);
    }
}

/**
 * Is a Natural number, but not a zero  (1,2,3, etc.)
 * @param String $n
 * @return Boolean
 */
if (!function_exists('_isNaturalNumber')) {
    function _isNaturalNumber($n)
    {
        return ($n != 0 && ctype_digit((string) $n));
    }
}

/**
 * Slugify
 * @param String
 * @return String
 */
if (!function_exists('slugify')) {
    function slugify($str)
    {
        $lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
        $spacesDuplicateHypens = '/[\-\s]+/';
        $str = preg_replace($lettersNumbersSpacesHyphens, '', $str);
        $str = preg_replace($spacesDuplicateHypens, '-', $str);
        $str = trim($str, '-');
        return strtolower($str);
    }
}

if (!function_exists('kategori_list')) {
    function kategori_list($id_kategori = null)
    {
        $arr = [1 => 'Survey/ Kunjungan', 'Kegiatan Harian', 'Pelatihan', 'Sosialisasi', 'Seminar', 'Laporan', 'Artikel', 'Berita P3M'];
        if ($id_kategori == NULL) {
            return $arr;
        } else {
            return $arr[$id_kategori];
        }
    }
}

if (!function_exists('kategori_slug')) {
    function kategori_slug($id_kategori = null)
    {
        $arr = [1 => 'survey-kunjungan', 'kegiatan-harian', 'pelatihan', 'sosialisasi', 'seminar', 'laporan', 'artikel', 'berita'];
        if ($id_kategori == NULL) {
            return $arr;
        } else {
            return $arr[$id_kategori];
        }
    }
}

if (!function_exists('kategori_show')) {
    function kategori_show($id_kategori = null)
    {
        $arr = [1 => 0, 1, 1, 1, 1, 0, 1, 0];
        if ($id_kategori == NULL) {
            return $arr;
        } else {
            return $arr[$id_kategori];
        }
    }
}

/**
 * Encode String
 * @param String $str
 * @return String
 */
if (!function_exists('encode_str')) {
    function encode_str($str)
    {
        $CI = &get_instance();
        $CI->load->library('encryption');
        $CI->encryption->initialize(array('cipher' => 'aes-256', 'mode' => 'ctr'));
        $ret = $CI->encryption->encrypt($str);
        $ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));
        return $ret;
    }
}

/**
 * Decode String
 * @param String
 * @return String
 */
if (!function_exists('decode_str')) {
    function decode_str($str)
    {
        $CI = &get_instance();
        $CI->load->library('encryption');
        $CI->encryption->initialize(array('cipher' => 'aes-256', 'mode' => 'ctr'));
        $str = strtr($str, array('.' => '+', '-' => '=', '~' => '/'));
        return $CI->encryption->decrypt($str);
    }
}

if (!function_exists('filesize_formatted')) {
    function filesize_formatted($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}

if (!function_exists('baku')) {

    function baku($value)
    {

        return ucwords(strtolower($value));
    }
}

if (!function_exists('smt2nama')) {

    function smt2nama($value)
    {
        $thn_aka = substr($value, 0, 4);
        $thn_akademik = $thn_aka . '/' . ($thn_aka + 1);

        //untuk keterangan tagihan
        $smt = str_split($value);
        if ($smt[4] == 1) {
            $smt_akademik = 'Ganjil';
        } elseif ($smt[4] == 2) {
            $smt_akademik = 'Genap';
        } else {
            $smt_akademik = 'Pendek';
        }

        echo $thn_akademik . ' ' . $smt_akademik;
    }
}

if (!function_exists('konversi_hari')) {

    function konversi_hari($id_hari)

    {

        $arr_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return $arr_hari[$id_hari];
    }
}



if (!function_exists('tgl_indo')) {

    function date_indo($tgl)

    {

        $ubah = gmdate($tgl, time() + 60 * 60 * 8);

        $pecah = explode("-", $ubah);

        $tanggal = $pecah[2];

        $bulan = bulan($pecah[1]);

        $tahun = $pecah[0];

        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('tgl_indo2')) {

    function tgl_indo2($tgl)

    {

        $ubah = gmdate($tgl);

        $pecah = explode("-", $ubah);

        $tanggal = $pecah[2];

        $bulan = bulan($pecah[1]);

        $tahun = $pecah[0];

        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}



if (!function_exists('bulan')) {

    function bulan($bln)

    {

        switch ($bln) {

            case 1:

                return "Januari";

                break;

            case 2:

                return "Februari";

                break;

            case 3:

                return "Maret";

                break;

            case 4:

                return "April";

                break;

            case 5:

                return "Mei";

                break;

            case 6:

                return "Juni";

                break;

            case 7:

                return "Juli";

                break;

            case 8:

                return "Agustus";

                break;

            case 9:

                return "September";

                break;

            case 10:

                return "Oktober";

                break;

            case 11:

                return "November";

                break;

            case 12:

                return "Desember";

                break;
        }
    }
}



//Format Shortdate

if (!function_exists('shortdate_indo')) {

    function shortdate_indo($tgl)

    {

        $ubah = gmdate($tgl, time() + 60 * 60 * 8);

        $pecah = explode("-", $ubah);

        $tanggal = $pecah[2];

        $bulan = short_bulan($pecah[1]);

        $tahun = $pecah[0];

        return $tanggal . '/' . $bulan . '/' . $tahun;
    }
}



if (!function_exists('short_bulan')) {

    function short_bulan($bln)

    {

        switch ($bln) {

            case 1:

                return "01";

                break;

            case 2:

                return "02";

                break;

            case 3:

                return "03";

                break;

            case 4:

                return "04";

                break;

            case 5:

                return "05";

                break;

            case 6:

                return "06";

                break;

            case 7:

                return "07";

                break;

            case 8:

                return "08";

                break;

            case 9:

                return "09";

                break;

            case 10:

                return "10";

                break;

            case 11:

                return "11";

                break;

            case 12:

                return "12";

                break;
        }
    }
}



//Format Medium date

if (!function_exists('mediumdate_indo')) {

    function mediumdate_indo($tgl)

    {

        $ubah = gmdate($tgl, time() + 60 * 60 * 8);

        $pecah = explode("-", $ubah);

        $tanggal = $pecah[2];

        $bulan = medium_bulan($pecah[1]);

        $tahun = $pecah[0];

        return $tanggal . '-' . $bulan . '-' . $tahun;
    }
}



if (!function_exists('medium_bulan')) {

    function medium_bulan($bln)

    {

        switch ($bln) {

            case 1:

                return "Jan";

                break;

            case 2:

                return "Feb";

                break;

            case 3:

                return "Mar";

                break;

            case 4:

                return "Apr";

                break;

            case 5:

                return "Mei";

                break;

            case 6:

                return "Jun";

                break;

            case 7:

                return "Jul";

                break;

            case 8:

                return "Ags";

                break;

            case 9:

                return "Sep";

                break;

            case 10:

                return "Okt";

                break;

            case 11:

                return "Nov";

                break;

            case 12:

                return "Des";

                break;
        }
    }
}



//Long date indo Format

if (!function_exists('longdate_indo')) {

    function longdate_indo($tanggal)

    {

        $ubah = gmdate($tanggal, time() + 60 * 60 * 8);

        $pecah = explode("-", $ubah);

        $tgl = $pecah[2];

        $bln = $pecah[1];

        $thn = $pecah[0];

        $bulan = bulan($pecah[1]);



        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));

        $nama_hari = "";

        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }

        return $nama_hari . ', ' . $tgl . ' ' . $bulan . ' ' . $thn;
    }
}
