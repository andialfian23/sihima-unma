<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function get_mahasiswa($id)
    {
        $this->db->select("mhs.id_mhs, mhs.id_mahasiswa_pt as id_mahasiswa_pt, nama_mhs, mhs.kode_prodi, is_admin, 
                    CASE WHEN j.jabatan !='' THEN j.jabatan ELSE 'Anggota' END AS jabatan, 
                    CASE WHEN j.level !='' THEN j.level ELSE 8 END as role_id,
                    
                    CASE WHEN p.id_mj != '' THEN p.id_mj 
                        ELSE (SELECT id_mj FROM t_masa_jabatan 
                            WHERE status_mj=1 AND id_hima=h.id_hima) END AS id_mj, 

                    CASE WHEN CONCAT(periode1,'/',periode2) != '/' THEN CONCAT(periode1,'/',periode2)
                        ELSE (SELECT CONCAT(periode1,'/',periode2) FROM t_masa_jabatan 
                            WHERE status_mj=1 AND id_hima=h.id_hima) END AS periode,

                    CASE WHEN mj.status_mj !='' THEN mj.status_mj
                        ELSE (SELECT status_mj FROM t_masa_jabatan  
                            WHERE id_mj=mj.id_mj) END AS status_mj, 

                    h.id_hima, singkatan, nama_hima")
            ->from("t_mahasiswa AS mhs")
            ->join("t_pengurus AS p", "mhs.id_mahasiswa_pt = p.id_mahasiswa_pt", "LEFT")
            ->join("t_jabatan AS j", " p.id_jabatan = j.id_jabatan", "LEFT")
            ->join("t_masa_jabatan AS mj", "p.id_mj = mj.id_mj", "LEFT")
            ->join("t_hima AS h", "mhs.kode_prodi = h.kode_prodi", "INNER")
            ->where('mhs.id_mahasiswa_pt', $id)
            ->order_by('mj.id_mj', 'ASC');

        return $this->db->get();
    }

    public function get_kaprodi($id)
    {
        $this->db->select("k.*, h.id_hima, singkatan, nama_hima, id_mj,  CONCAT(periode1,'/',periode2) AS periode")
            ->from('t_kaprodi AS k')
            ->join("t_hima AS h", "k.kode_prodi = h.kode_prodi", "INNER")
            ->join("t_masa_jabatan AS mj", "h.id_hima = mj.id_hima AND status_mj=1", "LEFT")
            ->where('id_dosen', $id);
        return $this->db->get();
    }

    public function is_admin($id_mahasiswa_pt)
    {
        return $this->db->get_where('t_mahasiswa', ['id_mahasiswa_pt' => $id_mahasiswa_pt, 'id_admin' => 1]);
    }
}
