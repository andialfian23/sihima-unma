<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('presensi/head') ?>

<body>

    <div class="container">
        <?php if (($token == null) || ($presensi['num_rows'] < 1)) { ?>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                <h5>Token tidak terdaftar !!!</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else {
                if (($token == null) || ($presensi['num_rows'] > 0)) :

                    $row = $presensi['result'];
                    $tgl_kg = waktu_pelaksanaan($row['mulai'], $row['selesai']);
                    ?>
                <?php if ($row['status'] == 'Hadir') : ?>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-success" role="alert">
                                        <h6>Anda Telah Melakukan Proses Presensi</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row mt-2 d-none" id="errorPresensi">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-danger" role="alert">
                                    <h6 id="responseText"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-success border-1 shadow-lg my-3">
                    <div class="card-header">
                        <div class="row ">
                            <div class="col-md-3 col-sm-12 text-center my-2">
                                <?php
                                        $img = ($row['logo'] != null || $row['logo'] != '') ? $row['logo'] : 'logo.png';
                                        ?>
                                <img src="<?= base_url('images/logo/' . $img) ?>" alt="" width="135px" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div class="mt-2">
                                    <h2 class="mb-3">Presensi Online</h2>
                                    <h3><?= $row['nama_kegiatan'] ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 px-2">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        Informasi Kegiatan
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>Nama Kegiatan</td>
                                                    <th>: <?= $row['nama_kegiatan'] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Hari / Tanggal</td>
                                                    <th>: <?= $tgl_kg['tanggal'] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Waktu</td>
                                                    <th>: <?= $tgl_kg['waktu'] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Tempat</td>
                                                    <th>: <?= $row['tempat'] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Penyelenggara</td>
                                                    <th>: <?= $row['nama_hima'] ?></th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($row['status'] == 'Hadir') : ?>
                            </div>
                            <div class="col-lg-6 px-2">
                            <?php endif; ?>
                            <div class="card mb-1">
                                <div class="card-header">
                                    Informasi Peserta
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                                if ($presensi['mhs_unma'] == '1') {
                                                    $data['data_mhs'] = json_npm($row['no_id']);
                                                    $data['status'] = $row['status'];
                                                    $this->load->view('presensi/informasi_peserta_mhs_unma', $data);
                                                } else {
                                                    $data['row'] = $row;
                                                    $this->load->view('presensi/informasi_peserta_non_unma', $data);
                                                }

                                                ?>
                                    </div>
                                </div>
                            </div>

                            <?php if ($row['status'] == 'Belum Hadir') : ?>
                            </div>
                            <div class="col-lg-6 px-2">
                                <div class="card">
                                    <div class="card-header">
                                        Tulis tanda tangan anda, sebagai bukti menghadiri kegiatan.
                                    </div>
                                    <div class="card-body">
                                        <div class="px-3 py-3">
                                            <div class="boxarea signature">

                                                <div id="mf_signature_pad_14">
                                                    <div class="mf_signature_switch" style="text-align: right">
                                                        <a class="sig_switch_draw active" href="javascript: switch_signature_type(14,'draw');">Draw</a> or
                                                        <a class="sig_switch_type" href="javascript: switch_signature_type(14,'type');">Type</a>
                                                    </div>
                                                    <div class="mf_signature_draw" style="display: block;">
                                                        <div class="mf_signature_wrapper medium" style="height: 150px">
                                                            <canvas id="mf_canvas_signature_pad_14" class="mf_canvas_signature_pad" style="width: 100%; height: 100%"></canvas>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-10">
                                                                I understand this is a legal representation of my signature.
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a class="btn btn-danger mf_signature_clear element_14_clear" href="javascript:clear_signature(14)">Clear</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mf_signature_type" style="display: none">
                                                        <input id="input_name" name="input_name" class="element text large text_signature form-control" type="text" max="8" value="" />
                                                        <p class="text-danger" id="notif"></p>
                                                        <div class="mf_signature_wrapper" style="height: 100px;margin-top: 20px">
                                                            <img id="element_14_text_signature_img" style="height: 75px;margin-top: 10px;margin-left: 15px;" />
                                                        </div>

                                                        <p>I understand this is a legal representation of my signature.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <input type="hidden" name="element_14" id="element_14">
                                        <input type="hidden" value="<?= $row['token_presensi'] ?>" id="token_presensi">
                                        <!-- <input type="text" name="element_14" id="element_14"> -->
                                        <button class="btn btn-primary btn-user btn-block" type="submit" id="submit_form">SUBMIT</button>

                                    </div>
                                </div>

                                <?php $this->load->view('presensi/script_ttd') ?>

                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title text-left" id="myModalLabel">Warning!</h4>
                                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button> -->
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger">
                                                    Isi tanda tangan dulu sebelum submit
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success">
                                                <h4 class="modal-title text-left" id="myModalLabel">BERHASIL</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-success">
                                                    Proses Presensi Berhasil !!!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>

                        </div>

                    <?php endif; ?>

                    </div>
                </div>

            <?php } ?>
    </div>


</body>

</html>