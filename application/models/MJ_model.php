<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MJ_model extends CI_Model
{
    var $table = 't_masa_jabatan';

    public function get_masa_jabatan($id_hima)  //MORE
    {
        $this->db->select('a.*, count(b.id_mahasiswa_pt) as jml_pengurus, singkatan, concat(periode1,"/",periode2) as periode');
        $this->db->from($this->table . ' a')->join('t_pengurus b', 'a.id_mj = b.id_mj')->join('t_hima c', 'a.id_hima = c.id_hima');
        $this->db->where('a.id_hima', $id_hima)->group_by('id_mj', 'ASC')->order_by('periode1', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_masa_periode($id_mj)   //SINGLE
    {
        $this->db->select("mj.*, concat(periode1,'/',periode2) as periode, h.singkatan, 
            (SELECT count(id_mahasiswa_pt) FROM t_pengurus WHERE id_mj=$id_mj) as jml_pengurus,
            (SELECT nama_mhs FROM t_pengurus AS p 
                LEFT JOIN t_mahasiswa AS mhs ON p.id_mahasiswa_pt=mhs.id_mahasiswa_pt
                WHERE id_mj=$id_mj AND id_jabatan=2) as kahim");
        $this->db->from('t_masa_jabatan mj');
        $this->db->join('t_hima h', 'mj.id_hima = h.id_hima');
        $this->db->where('mj.id_mj', $id_mj);
        return $this->db->get();
    }

    public function get_mj_aktif($id_hima) //SINGLE / 1 ROW
    {
        $contact_person = $this->db->where('id_hima', $id_hima)->order_by('nama_contact', 'ASC')->get('t_contact_person');

        $masa_jabatan = $this->db->select('a.*, concat(periode1,"/",periode2) as periode,
                singkatan, nama_hima, logo, tempat_sekre, status_hima, 
                (SELECT count(id_mahasiswa_pt) FROM t_pengurus 
                    WHERE id_mj=a.id_mj) AS jml_pengurus,
                (SELECT nama_mhs FROM t_pengurus as ps
                    LEFT JOIN t_mahasiswa as mhs ON ps.id_mahasiswa_pt=mhs.id_mahasiswa_pt
                    WHERE id_mj=a.id_mj AND id_jabatan=2) AS kahim')
            ->from($this->table . ' a')
            ->join('t_hima c', 'a.id_hima = c.id_hima')
            ->where('a.id_hima', $id_hima)
            ->where('status_mj', '1')->get();
        $no = 0;
        if ($masa_jabatan->num_rows() > 0) {
            foreach ($masa_jabatan->result_array() as $key) {
                $row = [];

                $row['id_mj']   = $key['id_mj'];
                $row['id_hima'] = $key['id_hima'];
                if (($key['logo'] != NULL) || ($key['logo'] != '')) {
                    $row['logo'] = $key['logo'];
                } else {
                    $row['logo'] = '';
                }

                $row['singkatan'] = $key['singkatan'];
                $row['nama_hima'] = $key['nama_hima'];
                $row['periode']   = $key['periode']; //
                $row['sk'] = $key['sk'];
                if (
                    ($key['tgl_awal'] != '0000-00-00') && ($key['tgl_akhir'] != '0000-00-00')
                    && ($key['tgl_awal'] != NULL) && ($key['tgl_akhir'] != NULL)
                ) {
                    $row['tgl_awal'] = $key['tgl_awal'];
                    $row['tgl_akhir'] = $key['tgl_akhir'];
                    $row['masa_jabatan'] = date_id($key['tgl_awal']) . ' - ' . date_id($key['tgl_akhir']);
                } else {
                    $row['tgl_awal'] = ' ';
                    $row['tgl_akhir'] = ' ';
                    $row['masa_jabatan'] = ' ';
                }
                $row['status_mj'] = $key['status_mj'];

                //KETUA HIMA & JUMLAH PENGURUS
                $kahim = $key['kahim'];
                if ($kahim != '') {
                    $row['ketua_himpunan'] = $kahim;
                    $row['jml_pengurus'] = $key['jml_pengurus'];
                } else {
                    $row['ketua_himpunan'] = 'Belum Dipilih';
                    $row['jml_pengurus'] = 'Belum Diketahui';
                }

                //SEKRETARIAT && CONTACT PERSON
                if ($contact_person->num_rows() > 0) {
                    $no2 = 0;
                    foreach ($contact_person->result_array() as $cp) {
                        $row['contact_person'][$no2]['id_cp'] = $cp['id_cp'];
                        $row['contact_person'][$no2]['nama'] = $cp['nama_contact'];
                        $row['contact_person'][$no2]['no_telp'] = $cp['no_telp'];
                        $no2++;
                    }
                } else {
                    $row['contact_person'] = 'Belum Ditambahkan';
                }

                $row['tempat_sekre'] = ($key['tempat_sekre'] != null) ? $key['tempat_sekre'] : 'Belum Diketahui';
                $row['status_hima'] = $key['status_hima'];
                $result = $row;
                $no++;
            }
        } else {
            $hima = $this->db->get_where('t_hima', ['id_hima' => $id_hima])->row_array();

            $row = [];
            $row['id_mj'] = '';
            $row['id_hima'] = $hima['id_hima'];
            if (($hima['logo'] != NULL) || ($hima['logo'] != '')) {
                $row['logo'] = $hima['logo'];
            } else {
                $row['logo'] = '';
            }

            $row['singkatan'] = $hima['singkatan'];
            $row['nama_hima'] = $hima['nama_hima'];

            $row['periode'] = 'Belum ditentukan'; //
            $row['sk'] = 'Belum Ada SK';
            $row['tgl_awal'] = '';
            $row['tgl_akhir'] = '';
            $row['masa_jabatan'] = 'Belum Ditentukan';
            $row['status_mj'] = '';
            $row['ketua_himpunan'] = 'Belum Dipilih';
            $row['jml_pengurus'] = 'Belum Diketahui';

            //SEKRETARIAT && CONTACT PERSON
            if ($contact_person->num_rows() > 0) {
                $no2 = 0;
                foreach ($contact_person->result_array() as $cp) {
                    $row['contact_person'][$no2]['id_cp'] = $cp['id_cp'];
                    $row['contact_person'][$no2]['nama'] = $cp['nama_contact'];
                    $row['contact_person'][$no2]['no_telp'] = $cp['no_telp'];
                    $no2++;
                }
            } else {
                $row['contact_person'] = 'Belum Ditambahkan';
            }

            $row['tempat_sekre'] = ($hima['tempat_sekre'] != null) ? $hima['tempat_sekre'] : 'Belum Diketahui';
            $row['status_hima'] = $hima['status_hima'];
            $result = $row;
        }
        return $result;
    }

    function cek_mj($id_mj, $id_hima)
    {
        $masa_jabatan = $this->db->get_where($this->table, ['id_mj' => $id_mj, 'id_hima' => $id_hima]);
        $data = [];
        $data['row_array'] = $masa_jabatan->row_array();
        $data['num_rows'] = $masa_jabatan->num_rows();
        return $data;
    }
}
