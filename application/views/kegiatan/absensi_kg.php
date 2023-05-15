<div class="card border-info">
    <div class="card-content">
        <div class="card-body">
            <h4>
                <a href="<?= base_url('Dashboard/info_kegiatan/' . $kegiatan['no_kegiatan']) ?>"><?= $kegiatan['nama_kegiatan'] ?></a>
            </h4>
            <h4>
                <?= longdate_indo($kegiatan['tgl_kegiatan']) ?>
            </h4>

            <div class="row mt-1">
                <div class="col-lg-12">
                    <?php
                    $akses_pengurus = akses('Pengurus')->num_rows();
                    $akses_absensi = akses('Absen')->num_rows();
                    $panitia = $this->absen_model->getAbsen($kegiatan['no_kegiatan'], 'Panitia');
                    $total          = $panitia['num_rows'];
                    if ($kegiatan['id_mj'] == $_SESSION['id_mj']) :

                        if ($akses_absensi > 0) :

                            $total_anggota = $this->pengurus_model->hitung_pengurus($kegiatan['id_mj'])['jml_pengurus'];
                            $total_absen = $total;
                            //PRESENSI PANITIA atau ANGGOTA PENGURUS
                            if ($total_absen < $total_anggota) {
                    ?>
                                <a class="btn btn-primary mb-1" href="<?= base_url('Absen/i_absen/' . $kegiatan['no_kegiatan']) ?>">
                                    Proses Absensi Panitia</a>
                            <?php }
                            //PRESENSI PESERTA KEGIATAN
                            if ($kegiatan['lingkup'] != 'Pengurus') {
                            ?>
                                <a class="btn btn-primary mb-1" href="#" data-toggle="modal" data-target="#presensiManual">Presensi Manual</a>
                                <a class="btn btn-success mb-1" href="<?= base_url("Absen/scan/" . $kegiatan['no_kegiatan']) ?>/Peserta">
                                    <i class="fa fa-qrcode"></i> Scan QR-Code</a>

                            <?php }

                            //EDIT DAN HAPUS DATA KEGIATAN
                            ?>
                    <?php
                        endif;
                    endif;

                    ?>
                </div>
            </div>

            <?php if ($kegiatan['lingkup'] != 'Pengurus') { ?>

                <div class="row mt-1">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 label-control" for="sebagai"><b>Data Absensi</b></label>
                            <div class="col-md-8">
                                <select id="sebagai" name="sebagai" class="form-control" required>
                                    <option value="<?= $sebagai ?>" hidden><?= $sebagai ?></option>
                                    <?=
                                    ($total > 0) ? '<option value="Panitia">Panitia</option>' : '';
                                    ?>
                                    <option value="Peserta">Peserta</option>
                                </select>
                                <script>
                                    $(document).ready(function() {
                                        $('#sebagai').change(function() {
                                            // console.log($(this).val());
                                            var sebagai = $(this).val();
                                            setTimeout(function() {
                                                window.location.replace("<?= base_url('Dashboard/absensi/' . $kegiatan['no_kegiatan'])  ?>/" + sebagai);
                                            }, 2000);
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>


<!-- DATA ABSENSI -->
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered responsive" width="100%" id="dataTables-sihima">
            <thead>
                <tr>
                    <th>
                        <?= ($sebagai != 'Peserta') ? 'NPM' : 'ID Peserta'; ?>
                    </th>
                    <th>Nama</th>
                    <?php if ($sebagai != 'Peserta') : ?>
                        <th>Sebagai</th>
                    <?php endif; ?>
                    <th>Status</th>
                    <?php if (($akses_absensi > 0) && ($kegiatan['id_mj'] == $_SESSION['id_mj'])) { ?>
                        <th>--</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tampil['result'] as $t) : ?>
                    <tr>
                        <td><?= $t['id_peserta'] ?></td>
                        <td><?= $t['nm_pd'] ?></td>

                        <?php if ($sebagai != 'Peserta') : ?>
                            <td><?= $t['sebagai'] ?></td>
                        <?php endif; ?>

                        <td>
                            <!-- <a href="#" data-toggle="modal" data-target="#myModal"> -->
                            <?php if (($t['token_presensi'] != null) && ($t['status'] == 'Hadir')) { ?>
                                <a href="#" onclick="return cekHadir('<?= $t['nm_pd'] ?>','<?= $t['token_presensi'] ?>')">
                                    <?= $t['status'] ?>
                                </a>
                            <?php } else {
                                echo $t['status'];
                            } ?>
                        </td>
                        <?php if (($akses_absensi > 0) && ($kegiatan['id_mj'] == $_SESSION['id_mj'])) { ?>
                            <td>
                                <?php
                                if ($sebagai == 'Panitia') :
                                ?>
                                    <a href="<?= base_url("Absen/e_absen/" . $kegiatan['no_kegiatan'] . '/' . $t['id_peserta']) ?>" class="btn btn-sm btn-info mb-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="<?= base_url("Absen/del_absen/" . $kegiatan['no_kegiatan'] . '/' . $t['id_peserta']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah anda yakin akan menghapus data absensi <?= $t['nm_pd']; ?>')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <script type="text/javascript">
            var sebagai = document.querySelector('#sebagai');
            $(document).ready(function() {
                $('#dataTables-sihima').DataTable({
                    responsive: true,
                    dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: [{
                            extend: 'pageLength',
                            text: 'Tampilkan Data',
                            className: 'btn',
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-info',
                            action: function(e, dt, node, config) {
                                setTimeout(function() {
                                    window.open("<?= base_url('Report/absensi/' . $kegiatan['no_kegiatan'] . '/' . $sebagai)  ?>", '_blank');
                                }, 2000);
                            }
                        }
                    ],
                    language: {
                        url: "<?= base_url('assets/ID.json') ?>",
                    },
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        ['5', '10', '25', '50', 'Semua Data']
                    ],
                });


            });

            function cekHadir(namaPeserta, token) {
                $('#myModal2').modal('show');
                var nama = document.querySelector('.modal-title');
                var preview = document.querySelector('#preview');
                var pesan = document.querySelector('#message');
                var dataset = new FormData();
                dataset.append('token', token);
                $.ajax({
                    url: '<?= base_url('Dashboard/data_presensi') ?>',
                    type: 'POST',
                    data: dataset,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var dataResponse = JSON.parse(response);
                        if (dataResponse.status == '0') {
                            toastr.error(dataResponse.message);
                        } else {
                            // console.log(dataResponse.ttd);
                            nama.innerHTML = namaPeserta;
                            pesan.innerHTML = namaPeserta + ' ' + dataResponse.message;
                            $('#preview').show();
                            preview.setAttribute('src', dataResponse.ttd)
                        }
                    }
                });
            }
        </script>
    </div>
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-data">
                <p id='message'></p>
                <img id="preview" width="100%" style="display:none;" class="img-responsive mt-1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="presensiManual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Presensi Manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-data">
                <div class="row">
                    <div class="col-md-12">

                        <h4><a href="<?= base_url('Dashboard/info_kegiatan/' . $kegiatan['no_kegiatan']) ?>"><?= $kegiatan['nama_kegiatan'] ?></a></h4>
                        <h4><?= longdate_indo($kegiatan['tgl_kegiatan']) ?></h4>
                        <hr>
                        <form action="<?= base_url('Absen/p_i_manual') ?>" method="POST">
                            <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                    <button class="btn btn-light" disabled>
                                        NPM / ID Peserta
                                    </button>
                                </div>
                                <input name="no_id" id="id" value="" class="form-control" autofocus placeholder="18.14.1.0001" />
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info" id="cariData">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <small id="notifMhs" class="text-danger"> </small>

                            <div class="mt-2 dataView d-none">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" name="nama" id="nama" class="form-control" value="" disabled />
                                            <input type="text" name="no_kg" id="no_kg" hidden value="<?= $kegiatan['no_kegiatan'] ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-md-3 col-form-label">Keterangan</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" id="keterangan" class="form-control" value="" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sebagai" class="col-md-3 col-form-label">Sebagai</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select name="sebagai" id="sebagai" class="form-control">
                                                <option value="Peserta">Peserta</option>
                                                <option value="Panitia">Panitia</option>
                                                <option value="Penanggung Jawab">Penanggung Jawab</option>
                                                <option value="Ketua Pelaksana">Ketua Pelaksana</option>
                                                <option value="Sekretaris">Sekretaris</option>
                                                <option value="Bendahara">Bendahara</option>
                                                <option value="Sie. Acara">Sie. Acara</option>
                                                <option value="Sie. Humas">Sie. Humas</option>
                                                <option value="Sie. Logistik">Sie. Logistik</option>
                                                <option value="Sie. Konsumsi">Sie. Konsumsi</option>
                                                <option value="Sie. Dokumentasi">Sie. Dokumentasi</option>
                                                <option value="Sie. P3K">Sie. P3K</option>
                                                <option value="Tamu">Tamu Undangan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group btnView d-none mt-2 text-center">
                                <input type="submit" value="Simpan" class="btn btn-primary btn-md" />
                            </div>
                        </form>
                        <script>
                            var notifMhs = document.getElementById('notifMhs');
                            var input_nm_pd = document.getElementById('nama');
                            var input_keterangan = document.getElementById('keterangan');
                            $(document).ready(function() {
                                $('#cariData').click(function() {
                                    if ($('#id').val() == '') {
                                        $('#id').addClass('border border-danger');
                                        toastr.error("NPM / ID Peserta masih kosong");
                                        return false;
                                    }
                                    var dataset = new FormData();
                                    dataset.append('id', $('#id').val());
                                    $.ajax({
                                        url: '<?= base_url('Absen/cari_data_peserta') ?>',
                                        type: 'POST',
                                        data: dataset,
                                        contentType: false,
                                        processData: false,
                                        success: function(mhs) {
                                            if (mhs == '0') {
                                                console.log('Data peserta tidak ditemukan');
                                                notifMhs.innerHTML = 'Data peserta tidak ditemukan';
                                                $('#id').addClass('border border-danger');
                                                $('.dataView').addClass('d-none');
                                                $('.btnView').addClass('d-none');
                                                input_nm_pd.value = '';
                                                input_keterangan.value = '';
                                            } else {
                                                console.log('Data peserta ditemukan : ' + mhs.nama);
                                                toastr.success('Data Peserta Ditemukan');
                                                $('#id').removeClass('border border-danger');
                                                $('.dataView').removeClass('d-none');
                                                $('.btnView').removeClass('d-none');
                                                notifMhs.innerHTML = ' ';
                                                input_nm_pd.value = mhs.nama;
                                                input_keterangan.value = mhs.keterangan;
                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>