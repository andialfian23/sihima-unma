<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Absen_model extends CI_Model
{
    function list_pengurus($no_kg, $id_mj, $cek = null)    //for INPUT ABSEN PENGURUS
    {
        $pengurus =  $this->db->query("SELECT id_mahasiswa_pt 
                            FROM t_pengurus 
                            WHERE id_mj = '$id_mj'
                            AND id_mahasiswa_pt NOT IN (SELECT no_id as id_mahasiswa_pt 
                                FROM t_absen WHERE no_kegiatan='$no_kg' AND mhs_unma='1')
                            ORDER BY id_mahasiswa_pt ASC");
        if ($cek != null) {
            $result = $pengurus->num_rows();
        } else {
            $pengurus = $pengurus->result_array();
            $no = 0;
            $result = [];
            foreach ($pengurus as $t) {
                $row[$no] = [];
                $row[$no]['id_mahasiswa_pt'] = $t['id_mahasiswa_pt'];
                $row[$no]['nm_pd'] = json_npm($t['id_mahasiswa_pt'])['nm_pd'];
                $result = $row;
                $no++;
            }
        }
        return $result;
    }
    function peran_dikegiatan()
    {
        return [
            'Penanggung Jawab',
            'Ketua Pelaksana',
            'Sekretaris',
            'Bendahara',
            'Sie. Acara',
            'Sie. Humas',
            'Sie. Logistik',
            'Sie. Konsumsi',
            'Sie. Dokumentasi',
            'Panitia'
        ];
    }
    function get_absen($no_kg, $npm)
    {
        return $this->db->select(" b.*, no_id as id_mahasiswa_pt, status, sebagai, id as id_absen")->from('t_absen a')
            ->join('t_kegiatan b', 'a.no_kegiatan = b.no_kegiatan')
            ->where('a.no_kegiatan', $no_kg)->where('a.no_id', $npm)->get();
    }
    //ABSEN PANITIA/PESERTA
    function getAbsen($no_kg, $sebagai, $status = null)
    {
        $no = 0;
        $result = [];
        $result['result'] = [];
        $hadir = 0;
        $tdk_hadir = 0;
        if ($sebagai == 'Peserta') {
            $this->db->select('b.*,  id, no_id as id_mahasiswa_pt, status, sebagai,waktu_absen,token_presensi')
                ->from('t_absen a')->join('t_kegiatan b', 'a.no_kegiatan = b.no_kegiatan');
            $this->db->where('b.no_kegiatan', $no_kg)->where('sebagai', $sebagai)->where('mhs_unma', '1');
            ($status != null) ? $this->db->where('status', $status) : '';
            $peserta_unma = $this->db->get()->result_array();
            foreach ($peserta_unma as $t) {
                $row[$no] = [];
                $row[$no]['id_absen'] = $t['id'];
                $row[$no]['no_kegiatan'] = $t['no_kegiatan'];
                $row[$no]['id_peserta'] = $t['id_mahasiswa_pt'];
                $mhs = json_npm($t['id_mahasiswa_pt']);
                $row[$no]['nm_pd'] = $mhs['nm_pd'];
                $row[$no]['keterangan'] = $mhs['homebase'];
                $row[$no]['status'] = $t['status'];
                $row[$no]['sebagai'] = $t['sebagai'];
                $row[$no]['token_presensi'] = $t['token_presensi'];
                $result['result'] = $row;
                if ($t['status'] == 'Hadir') {
                    $hadir += 1;
                } else {
                    $tdk_hadir += 1;
                }
                $no++;
            }
            $no2 = $no++;
            $this->db->select('b.*,  a.id, no_id, status, sebagai,waktu_absen,token_presensi, nama,alamat')->from('t_absen a');
            $this->db->join('t_kegiatan b', 'a.no_kegiatan = b.no_kegiatan');
            $this->db->join('t_peserta c', 'a.no_id = c.id_peserta');
            $this->db->where('b.no_kegiatan', $no_kg)->where('sebagai', $sebagai)->where('mhs_unma', '0');
            ($status != null) ? $this->db->where('status', $status) : '';
            $peserta_non_unma = $this->db->get()->result_array();
            foreach ($peserta_non_unma as $t) {
                $row[$no2] = [];
                $row[$no2]['id_absen'] = $t['id'];
                $row[$no2]['no_kegiatan'] = $t['no_kegiatan'];
                $row[$no2]['id_peserta'] = $t['no_id'];
                $row[$no2]['nm_pd'] = $t['nama'];
                $row[$no2]['keterangan'] = $t['alamat'];
                $row[$no2]['status'] = $t['status'];
                $row[$no2]['sebagai'] = $t['sebagai'];
                $row[$no2]['token_presensi'] = $t['token_presensi'];
                $result['result'] = $row;
                if ($t['status'] == 'Hadir') {
                    $hadir += 1;
                } else {
                    $tdk_hadir += 1;
                }
                $no2++;
            }
            $result['num_rows'] = $no2;
        } else {
            //PANITIA
            $this->db->select('b.*, id, no_id as id_mahasiswa_pt, status, sebagai, waktu_absen, token_presensi')
                ->from('t_absen a')->join('t_kegiatan b', 'a.no_kegiatan = b.no_kegiatan');
            $this->db->where('b.no_kegiatan', $no_kg)
                ->where('sebagai!=', 'Peserta')->where('mhs_unma', '1');
            ($status != null) ? $this->db->where('status', $status) : '';
            $panitia = $this->db->get();
            foreach ($panitia->result_array() as $t2) {
                $row[$no] = [];
                $row[$no]['id_absen']       = $t2['id'];
                $row[$no]['no_kegiatan']    = $t2['no_kegiatan'];

                $mhs = json_npm($t2['id_mahasiswa_pt']);
                $row[$no]['id_peserta'] = $t2['id_mahasiswa_pt'];
                $row[$no]['nm_pd']      = $mhs['nm_pd'];
                $row[$no]['status']     = $t2['status'];
                $row[$no]['sebagai']    = $t2['sebagai'];
                $row[$no]['keterangan'] = $mhs['homebase'];
                $row[$no]['token_presensi'] = $t2['token_presensi'];
                $result['result'] = $row;
                if ($t2['status'] == 'Hadir') {
                    $hadir += 1;
                } else {
                    $tdk_hadir += 1;
                }
                $no++;
            }
            $result['num_rows']         = $panitia->num_rows();
        }
        $result['total_hadir']      = $hadir;
        $result['total_tdk_hadir']  = $tdk_hadir;
        return $result;
    }
    function cek_sebagai($no_kg, $sebagai)
    {
        return $this->db->get_where('t_absen', ['sebagai' => $sebagai, 'no_kegiatan' => $no_kg])->num_rows();
    }
    function totalAbsenPanitia($no_kg)
    {
        $this->db->select('count(no_kegiatan) as total');
        $this->db->where('no_kegiatan', $no_kg)->where('sebagai', 'Panitia');
        return $this->db->get('t_absen')->row_array();
    }
    function totalAbsen($no_kg, $sebagai, $status = null)
    {
        $this->db->select('count(no_kegiatan) as total');
        if ($status != null) {
            $this->db->where('no_kegiatan', $no_kg)->where('status', 'Hadir')->where('sebagai', $sebagai);
        } else {
            $this->db->where('no_kegiatan', $no_kg)->where('status!=', 'Hadir')->where('sebagai', $sebagai);
        }
        return $this->db->get('t_absen')->row_array();
    }
    function cek_absen_peserta($no, $id_peserta)
    {
        return $this->db->get_where('t_absen', ['no_id' => $id_peserta, 'no_kegiatan' => $no, 'status' => 'Hadir']);
    }
    function presensi($token, $status = null)
    {
        $data = [];
        $peserta = $this->db->get_where('t_absen', ['token_presensi' => $token]);
        if ($peserta->num_rows() > 0) {
            if ($peserta->row_array()['mhs_unma'] == '0') {
                $data['mhs_unma'] = '0';
                $this->db->select('b.*, token_presensi, status, id_peserta, nama, alamat, email, telp, nama_hima, logo')
                    ->from('t_absen a')
                    ->join('t_kegiatan b', 'a.no_kegiatan = b.no_kegiatan')
                    ->join('t_peserta c', 'a.no_id = c.id_peserta')
                    ->join('t_masa_jabatan d', 'b.id_mj = d.id_mj')
                    ->join('t_hima e', 'd.id_hima = e.id_hima')
                    ->where('token_presensi', $token);
            } else {
                $data['mhs_unma'] = '1';
                $this->db->select('b.*, token_presensi, status, no_id, nama_hima, logo')
                    ->from('t_absen a')
                    ->join('t_kegiatan b', 'a.no_kegiatan = b.no_kegiatan')
                    ->join('t_masa_jabatan d', 'b.id_mj = d.id_mj')
                    ->join('t_hima e', 'd.id_hima = e.id_hima')
                    ->where('token_presensi', $token);
            }
        } else {
            $this->db->from('t_absen a')->where('token_presensi', $token);
        }


        if ($status != null) {
            $this->db->where('status', $status);
        }
        $query = $this->db->get();
        $data['result'] = $query->row_array();
        $data['num_rows'] = $query->num_rows();
        return $data;
    }
}
