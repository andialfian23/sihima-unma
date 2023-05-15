<!-- TOMBOL PROSES DATA KEGIATAN -->
<div class="row">
    <div class="col-lg-12">

        <?php

        if ($_SESSION['role_id'] != '2') :
            $where = ['no_kegiatan' => $kegiatan['no_kegiatan'], 'no_id' => $_SESSION['id_mahasiswa_pt'], 'sebagai' => 'Peserta'];
            $cek_peserta = $this->db->get_where('t_absen', $where);
            if ($cek_peserta->num_rows() > 0) {
                $peserta = $cek_peserta->row_array();
                if ($peserta['status'] != 'Hadir') {
                    ?>
                    <a href="#" class="btn btn-primary mb-1" onclick="return cekPresensi()">
                        Presensi Peserta Kegiatan
                    </a>
                    <script type="text/javascript">
                        function cekPresensi() {
                            $.ajax({
                                url: "<?= base_url('Presensi/cek_presensi') ?>",
                                type: 'POST',
                                data: {
                                    no_kg: '<?= $kegiatan['no_kegiatan'] ?>',
                                    no_id: "<?= $_SESSION['id_mahasiswa_pt'] ?>"
                                },
                                success: function(response) {
                                    var dataResponse = JSON.parse(response);
                                    if (dataResponse.status == '0') {
                                        toastr.error(dataResponse.message);
                                    } else {
                                        // toastr.success(dataResponse.message);
                                        setTimeout(function() {
                                            window.location.assign(dataResponse.message);
                                        }, 2000);
                                    }
                                },
                            });

                        }
                    </script>
                <?php
                        } else {
                            echo '<script type="text/javascript">toastr.success("Anda Sudah Melakukan Presensi !!! \n Cek kehadiran anda pada halaman KegiatanKu")</script>';
                        }
                    } else { ?>
                <a href="#" class="btn btn-info mb-1" onclick="return joinKegiatan()">
                    Ikuti Kegiatan
                </a>
                <script type="text/javascript">
                    function joinKegiatan() {
                        var konfirmasi = confirm('** Informasi Mengikuti Kegiatan ** \n 1). Wajib hadir pada kegiatan yang di-ikuti \n 2). Hadir tepat waktu sesuai jadwal \n 3). Tombol Presensi akan muncul ketika sudah waktunya presensi. \n 4). Jadwal yang sudah di-ikuti tidak bisa dibatalkan \n\n Apakah anda yakin ingin mengikuti kegiatan <?= $kegiatan['nama_kegiatan'] ?> ? ')

                        if (konfirmasi) {
                            $.ajax({
                                url: "<?= base_url('Presensi/add_presensi') ?>",
                                type: 'POST',
                                data: {
                                    no_kg: "<?= $kegiatan['no_kegiatan'] ?>"
                                },
                                success: function(response) {
                                    toastr.success(response);

                                    setTimeout(function() {
                                        window.location.replace("<?= base_url('Dashboard/info_kegiatan/' . $kegiatan['no_kegiatan']) ?>");
                                    }, 2000);
                                },
                            });
                            // toastr.success('sip');
                        } else {
                            // toastr.error('yeh');
                        }
                    }
                </script>
        <?php }
        endif; ?>

        <?php
        $akses_pengurus = akses('Pengurus')->num_rows();
        $akses_kegiatan = akses('Kegiatan')->num_rows();

        if ($kegiatan['id_mj'] == $_SESSION['id_mj']) :
            //EDIT DAN HAPUS DATA KEGIATAN
            if ($akses_kegiatan > 0) :
                ?>
                <a href="<?= base_url("Kegiatan/e_kg/" . $kegiatan['no_kegiatan']) ?>" class="btn btn-info mb-1">
                    <i class="fa fa-edit"></i> Edit Data Kegiatan
                </a>
                <a href="<?= base_url("Kegiatan/del_kg/" . $kegiatan['no_kegiatan']) ?>" class="btn btn-danger mb-1" onclick="return confirm('Anda yakin ingin menghapus data kegiatan ini?')">
                    <i class="fa fa-trash"></i> Hapus Data Kegiatan
                </a>
            <?php
                endif;
            endif;

            //CETAK LAPORAN KEGIATAN
            if ($_SESSION['role_id'] < 8) {
                ?>
            <a href="<?= base_url("Report/pdf_kegiatan/" . $kegiatan['no_kegiatan']) ?>" target="_blank" class="btn btn-warning mb-1">
                <i class="fa fa-print"></i> Cetak Laporan Kegiatan
            </a>

        <?php } ?>
    </div>
</div>
<!-- END TOMBOL PROSES DATA KEGIATAN -->

<!-- INFORMASI KEGIATAN -->
<div class="row">
    <div class="col-md-12">
        <p><b>Lingkup Kegiatan </b>: <?= $kegiatan['lingkup'] ?></p>
        <?php
        //SIFAT KEGIATAN
        echo ($kegiatan['sifat_kegiatan'] != 'Langsung') ? '<p><b>Pelaksanaan </b>: ' . $kegiatan['sifat_kegiatan'] : '';
        //WAKTU PELAKSANAAN
        if ($kegiatan['mulai'] != null) :
            $mulai = $kegiatan['mulai'];
            $selesai = $kegiatan['selesai'];
            $pelaksanaan = waktu_pelaksanaan($mulai, $selesai);
            ?>
            <p><b>Hari/Tanggal </b>: <?= $pelaksanaan['tanggal']; ?></p>
            <p><b>Waktu </b>: <?= $pelaksanaan['waktu']; ?></p>
        <?php else : ?>
            <p><b>Tanggal </b>: <?= date_id($kegiatan['tgl_kegiatan']) ?></p>
        <?php endif; ?>
        <p><b>Tempat </b>: <?= $kegiatan['tempat'] ?></p>

        <?php //WAKTU ABSENSI
        if ($_SESSION['role_id'] < 7) {
            $mulaiAbsen = $kegiatan['mulai_absensi'];
            $selesaiAbsen = $kegiatan['selesai_absensi'];
            if (($mulaiAbsen != null) && ($selesaiAbsen != null)) :
                $absensi = waktu_pelaksanaan($mulaiAbsen, $selesaiAbsen);
                echo ($mulaiAbsen != $mulai) ? '<p><b>Waktu Presensi </b>: ' . $absensi['waktu'] : '';
            endif;
        }
        ?>

        <div class='border-top border-bottom' style="padding:3px 0px; margin:5px 0px">
            <br><?= $kegiatan['deskripsi'] ?><br>
        </div>
    </div>
</div>
<!-- END INFORMASI KEGIATAN -->

<!-- DATA LAINNYA -->
<div class="row">
    <?php if (($akses_kegiatan > 0) && ($kegiatan['id_mj'] == $_SESSION['id_mj'])) : ?>
        <div class="col-md-3 col-sm-4 pt-2">
            <button type="button" class="btn btn-success btn-block" id="pengesahan" data-toggle="modal" data-target="#myModal">Halaman Pengesahan</button>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Halaman Pengesahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="detail-data">
                            <div class="input-group">
                                <?php
                                    if ($kegiatan['pengesahan'] != null) {
                                        echo '<a href="' . pengesahan($kegiatan['pengesahan']) . '" target="_blank">' . $kegiatan['pengesahan'] . '</a>';
                                    }
                                    ?>
                            </div>
                            <div class="input-group mt-1">
                                <input type="file" name="pengesahan" id="pengesahan" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary" id="uploadPengesahan">
                                        Upload
                                    </button>
                                </div>
                                <p> </p>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#uploadPengesahan').click(function() {

                                        if (!$('input[type=file]')[0].files[0]) {
                                            $('.input-group').addClass('border border-danger');
                                            toastr.error("Input File Pengesahan masih kosong");
                                            return false;
                                        }
                                        var dataset = new FormData();
                                        dataset.append('pengesahan', $('input[type=file]')[0].files[0]);
                                        $.ajax({
                                            url: '<?= base_url('Kegiatan/add_pengesahan/' . $kegiatan['no_kegiatan']) ?>',
                                            type: 'POST',
                                            data: dataset,
                                            contentType: false,
                                            processData: false,
                                            success: function(response) {
                                                if (response == '1') {
                                                    toastr.success("Upload halaman pengesahan berhasil!!!");
                                                    setTimeout(function() {
                                                        window.location.replace("<?= base_url('Dashboard/info_kegiatan/' . $kegiatan['no_kegiatan'])  ?>");
                                                    }, 2000);
                                                } else {
                                                    toastr.error(response);
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ((akses('Kprodi')->num_rows() > 0) || ($akses_pengurus > 0)) : ?>
        <div class="col-md-3 col-sm-4 pt-2">
            <a href="<?= base_url('Dashboard/absensi/' . $kegiatan['no_kegiatan']) ?>" class="btn btn-info btn-block">
                Daftar Panitia / Peserta</a>
        </div>
        <div class="col-md-3 col-sm-4 pt-2">
            <a href="<?= base_url('Dashboard/realisasi_biaya/' . $kegiatan['no_kegiatan']) ?>" class="btn btn-info btn-block">
                Realisasi Biaya Kegiatan</a>
        </div>
    <?php endif; ?>

    <?php if ((akses('Dokumentasi')->num_rows() > 0) && ($kegiatan['id_mj'] == $_SESSION['id_mj'])) : ?>
        <div class="col-md-3 col-sm-4 pt-2">
            <a href="<?= base_url('Dokumentasi/index/' . $kegiatan['no_kegiatan']) ?>" class="btn btn-info btn-block">
                Dokumentasi Kegiatan</a>
        </div>
    <?php endif; ?>
</div>
<!-- END DATA LAINNYA -->