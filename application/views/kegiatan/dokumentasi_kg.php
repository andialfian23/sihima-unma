<h4><a href="<?= base_url('Dashboard/info_kegiatan/' . $kegiatan['no_kegiatan']) ?>"><?= $kegiatan['nama_kegiatan'] ?></a></h4>
<h4><?= longdate_indo($kegiatan['tgl_kegiatan']) ?></h4>

<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-12">
        <div class="card border-info">
            <div class="card-header bg-info">
                <h5 class="card-title text-white">Kelola Dokumentasi : </h5>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="text-white ft-plus"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-12 label-control" for="foto_dokumentasi">File Dokumentasi jpg/png</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <img id="preview" width="100%" style="display:none;" class="img-responsive mt-1" title="Double klik untuk menghapus gambar">

                                    <input type="file" id="foto_dokumentasi" name="foto_dokumentasi" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-12 label-control" for="caption">Judul Dokumentasi</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="caption" name="caption" class="form-control" />
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-md-12">
                            <button type="submit" class="btn btn-primary btn-block mb-1" onclick="return submit_dokumentasi()">Simpan</button>
                            <?php if ($dokumentasi['num_rows'] > 0) { ?>
                                <a href="<?= base_url('Report/dokumentasi_kegiatan/' . $kegiatan['no_kegiatan']) ?>" target="_blank" class="btn btn-warning btn-block">Cetak Dokumentasi Kegiatan</a>
                            <?php } ?>
                        </div>
                    </div>
                    <script>
                        function submit_dokumentasi() {

                            if ($('#foto_dokumentasi').val() == '') {
                                $('#foto_dokumentasi').addClass('border border-danger');
                                toastr.error("Tidak ada file yang di pilih");
                                return false;
                            }
                            if ($('#caption').val() == '') {
                                $('#caption').addClass('border border-danger');
                                toastr.error("Judul Dokumentasi masih kosong");
                                return false;
                            }
                            var dataset = new FormData();
                            dataset.append('caption', $('#caption').val());
                            dataset.append('position', $('#position').val());
                            dataset.append('foto_dokumentasi', $('input[type=file]')[0].files[0]);

                            // send data
                            $.ajax({
                                url: '<?= base_url('Dokumentasi/add/' . $kegiatan['no_kegiatan']) ?>',
                                type: 'POST',
                                data: dataset,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    if (response == '1') {
                                        toastr.success("Dokumentasi baru berhasil ditambahkan!!!");
                                        setTimeout(function() {
                                            window.location.replace("<?= base_url('Dokumentasi/index/' . $kegiatan['no_kegiatan']) ?>");
                                        }, 2000);
                                    } else {
                                        toastr.error(response);
                                    }
                                }
                            });
                        }

                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#preview').attr('src', e.target.result);
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        };
                        $(document).ready(function() {
                            // foto_dokumentasi Preview
                            $('#foto_dokumentasi').on('change', function() {
                                $('#preview').show();
                                readURL(this);
                            });
                            // remove foto_dokumentasi Preview
                            $('#preview').on('dblclick', function() {
                                $('#preview').hide().removeAttr('src');
                            });

                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <?php
    if ($dokumentasi['num_rows'] > 0) {
        foreach ($dokumentasi['result'] as $foto) : ?>
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card border">
                    <div class="card-body">
                        <img src="<?= base_url('media_library/dokumentasi/' . $foto['image']) ?>" alt="" width="100%"><br>
                        <p>
                            <b>
                                <?= $foto['caption'] ?>
                            </b>
                            <br>
                            by <?= $foto['pembuat'] ?> <br>
                            ( <a href="<?= base_url('Dokumentasi/delete/' . $foto['id_dk']) ?>" class="text-danger">Hapus</a> )
                        </p>
                    </div>
                </div>
            </div>
    <?php endforeach;
    } ?>
</div>