<?php

use phpDocumentor\Reflection\Types\Object_;

defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{
    public function get_kegiatan($id_mj, $no_kg = null)
    {
        $this->db->select('a.*, concat(periode1,"/",periode2) as periode,
                singkatan, nama_hima, logo, tempat_sekre')
            ->from('t_kegiatan a')
            ->join('t_masa_jabatan b', 'a.id_mj = b.id_mj')
            ->join('t_hima c', 'b.id_hima=c.id_hima');
        if ($no_kg != null) {
            return $this->db->where('no_kegiatan', $no_kg)->get();
        } else {
            $this->db->where('a.id_mj', $id_mj)->order_by('tgl_kegiatan', 'DESC');
            return $this->db->get();
        }
    }
    //KEGIATANKU
    function kegiatanku($npm)
    {
        $this->db->select('b.*, status, sebagai')
            ->from('t_absen a')->join('t_kegiatan b', 'a.no_kegiatan = b.no_kegiatan');
        $this->db->where('no_id', $npm)
            ->order_by('tgl_kegiatan', 'DESC');
        return $this->db->get();
    }
    //Kegiatan aktif dan terbaru
    function kegiatan_aktif()
    {
        $tgl = date('Y-m-d');
        $this->db->select('a.*, singkatan, kode_prodi, kode_fak')->from('t_kegiatan a');
        $this->db->join('t_masa_jabatan b', 'a.id_mj=b.id_mj');
        $this->db->join('t_hima c', 'b.id_hima=c.id_hima');
        $this->db->where('tgl_kegiatan >=', $tgl)->where('status_mj', '1');
        $this->db->order_by('tgl_kegiatan', 'ASC')->limit(6);
        return $this->db->get();
    }
    function kegiatan_baru()
    {
        $date = date('Y-m-d');
        $this->db->select('a.*, singkatan, kode_prodi, kode_fak ')->from('t_kegiatan a');
        $this->db->join('t_masa_jabatan b', 'a.id_mj=b.id_mj');
        $this->db->join('t_hima c', 'b.id_hima=c.id_hima');
        $this->db->where('tgl_kegiatan>=', $date)->where('status_mj', '1');
        $this->db->order_by('tgl_kegiatan', 'ASC');
        return $this->db->get();
    }
    function kegiatan_umum()
    {
        $date = date('Y-m-d');
        $this->db->select('a.*, singkatan, kode_prodi, kode_fak')->from('t_kegiatan a');
        $this->db->join('t_masa_jabatan b', 'a.id_mj=b.id_mj');
        $this->db->join('t_hima c', 'b.id_hima=c.id_hima');
        $this->db->where('lingkup', 'umum');
        $this->db->where('tgl_kegiatan>=', $date);
        $this->db->order_by('tgl_kegiatan', 'ASC');
        return $this->db->get();
    }
    //REALISASI BIAYA KEGIATAN
    public function get_biaya($id_mj, $no_kg)
    {
        $result = [];
        $biaya_kegiatan = $this->db->select('a.*, tgl_kegiatan, nama_kegiatan,id_mj')->from('t_biaya_kegiatan a')
            ->join('t_kegiatan b', 'a.no_kg = b.no_kegiatan')
            ->where('no_kg', $no_kg)->where('id_mj', $id_mj)->order_by('id_biaya', 'ASC');
        $jml_pemasukan = 0;
        $jml_pengeluaran = 0;
        $total_pemasukan = 0;
        $total_pengeluaran = 0;
        $data_pengeluaran = [];
        $data_pemasukan = [];
        $jml = 0;
        foreach ($biaya_kegiatan->get()->result_array() as $row) {
            if ($row['jenis'] == 'pemasukan') {
                $jml_pemasukan += 1;
                $data_pemasukan[$jml_pemasukan - 1] = [
                    'no_item'   => $jml_pemasukan,
                    'nama_item' => $row['nama_item'],
                    'harga'     => ($row['harga'] != 0) ? 'Rp ' . number_format($row['harga']) : '-',
                    'volume'    => ($row['volume'] != 0) ? $row['volume'] . ' ' . $row['unit'] : '-',
                    'jumlah'    => 'Rp ' . number_format($row['jumlah']),
                    'id_biaya'  => $row['id_biaya'],
                ];
                $total_pemasukan += $row['jumlah'];
            }
            if ($row['jenis'] == 'pengeluaran') {
                $jml_pengeluaran += 1;
                $data_pengeluaran[$jml_pengeluaran - 1] = [
                    'no_item'   => $jml_pengeluaran,
                    'nama_item' => $row['nama_item'],
                    'harga'     => ($row['harga'] != 0) ? 'Rp ' . number_format($row['harga']) : '-',
                    'volume'    => ($row['volume'] != 0) ? $row['volume'] . ' ' . $row['unit'] : '-',
                    'jumlah'    => 'Rp ' . number_format($row['jumlah']),
                    'id_biaya'  => $row['id_biaya'],
                ];
                $total_pengeluaran += $row['jumlah'];
            }
            $jml++;
        }

        $kegiatan = $this->get_kegiatan($id_mj, $no_kg)->row_array();
        $result['no_kegiatan']   = $kegiatan['no_kegiatan'];
        $result['nama_kegiatan'] = $kegiatan['nama_kegiatan'];
        $result['tgl_kegiatan']  = longdate_indo($kegiatan['tgl_kegiatan']);

        $result['num_rows'] = $jml;
        $result['jml_data_pemasukan']   = $jml_pemasukan;
        if ($jml_pemasukan > 0) {
            $result['pemasukan']        = $data_pemasukan;
            $result['total_pemasukan']   = 'Rp ' . number_format($total_pemasukan);
            $result['total_pemasukan_int']   = $total_pemasukan;
        }

        $result['jml_data_pengeluaran'] = $jml_pengeluaran;
        if ($jml_pengeluaran > 0) {
            $result['pengeluaran']        = $data_pengeluaran;
            $result['total_pengeluaran']   = 'Rp ' . number_format($total_pengeluaran);
            $result['total_pengeluaran_int']   = $total_pengeluaran;
        }

        return $result;
    }
    public function cek_biaya($id_mj, $id_biaya)
    {
        return $this->db->select('a.*, id_mj')->from('t_biaya_kegiatan a')
            ->join('t_kegiatan b', 'a.no_kg = b.no_kegiatan')
            ->where('id_mj', $id_mj)->where('id_biaya', $id_biaya)->get();
    }
    //DOKUMENTASI KEGIATAN
    public function get_dokumentasi($id_mj, $no_kg)
    {
        $data = $this->db->select('b.*, image, caption, id_dk, no_kg, id_mahasiswa_pt')
            ->from('t_dokumentasi a')->join('t_kegiatan b', 'a.no_kg=b.no_kegiatan')
            ->where('a.no_kg', $no_kg)->where('id_mj', $id_mj)->get();

        $result = [];
        $result['num_rows'] = $data->num_rows();
        $no = 0;
        foreach ($data->result_array() as $t) {
            $row[$no] = [];
            $row[$no]['id_dk'] = $t['id_dk'];
            $row[$no]['image'] = $t['image'];
            $row[$no]['no_kg'] = $t['no_kg'];
            $row[$no]['caption'] = $t['caption'];
            $row[$no]['pembuat'] = json_npm($t['id_mahasiswa_pt'])['nm_pd'];
            $result['result'] = $row;
            $no++;
        }

        return $result;
    }
}
