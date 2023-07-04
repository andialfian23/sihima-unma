<script src="https://cdn.tiny.cloud/1/ykyeg2r4mx1ljcl808m3gojhw7qecwai4mlnkg0tff5h7cow/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#deskripsi',
        menubar: false,
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tiny.cloud/css/codepen.min.css'
        ],
        contextmenu: false,
        paste_as_text: true,
        entity_encoding: "numeric",
        importcss_append: false,
        automatic_uploads: false,
        height: 500,
        image_caption: true,
        noneditable_noneditable_class: "mceNonEditable",
    });

    function submit_posts() {
        if ($('#nama_kegiatan').val() == '') {
            $('#nama_kegiatan').addClass('border border-danger');
            toastr.error("Nama Kegiatan masih kosong");
            return false;
        }

        if ($('#mulai').val() == '') {
            $('#mulai').addClass('border border-danger');
            toastr.error("Waktu mulai kegiatan masih kosong");
            return false;
        }
        if ($('#selesai').val() == '') {
            $('#selesai').addClass('border border-danger');
            toastr.error("Waktu selesai Kegiatan masih kosong");
            return false;
        }
        if ($('#is_active').is(':checked')) {
            $('#mulaiAbsen').val($('#mulai').val());
            $('#selesaiAbsen').val($('#selesai').val());
        } else {
            if ($('#mulaiAbsen').val() == '') {
                $('#mulaiAbsen').addClass('border border-danger');
                toastr.error("Waktu mulai Absen Kegiatan masih kosong");
                return false;
            }
            if ($('#selesaiAbsen').val() == '') {
                $('#selesaiAbsen').addClass('border border-danger');
                toastr.error("Waktu selesai Absen Kegiatan masih kosong");
                return false;
            }
        }

        if ($('#tempat').val() == '') {
            $('#tempat').addClass('border border-danger');
            toastr.error("Tempat Kegiatan masih kosong");
            return false;
        }
        if (tinyMCE.get('deskripsi').getContent() == '') {
            $('#deskripsi').addClass('border border-danger');
            toastr.error("Deskripsi harus diisi!");
            return false;
        }

        $('.btn-simpan').html('<i class="la la-spinner spinner"></i> Menyimpan ...');
        var dataset = new FormData();
        dataset.append('nama_kegiatan', $('#nama_kegiatan').val());
        dataset.append('tempat', $('#tempat').val());
        dataset.append('sifat', $('#sifat').val());
        dataset.append('lingkup', $('#lingkup').val());
        dataset.append('mulai', $('#mulai').val());
        dataset.append('selesai', $('#selesai').val());
        dataset.append('mulaiAbsen', $('#mulaiAbsen').val());
        dataset.append('selesaiAbsen', $('#selesaiAbsen').val());
        dataset.append('deskripsi', tinyMCE.get('deskripsi').getContent());

        // console.log(dataset);

        $.ajax({
            url: '<?= base_url('Kegiatan/p_e_kg/' . $kegiatan['no_kegiatan']) ?>',
            type: 'POST',
            data: dataset,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success("Berhasil Menyimpan Data Kegiatan!");
                setTimeout(function() {
                    window.location.assign("<?= base_url('Dashboard/info_kegiatan/' . $kegiatan['no_kegiatan']) ?>");
                }, 2000);
            }
        });
    };

    function is_active() {
        var tombolCek = document.querySelector('#is_active');
        var formAbsen = document.querySelector('#formAbsen');
        if (tombolCek.checked == false) {
            formAbsen.classList.remove('d-none');
            $('#mulaiAbsen').val($('#mulai').val());
            $('#selesaiAbsen').val($('#selesai').val());
        } else {
            formAbsen.classList.add('d-none');
            $('#mulaiAbsen').val($('#mulai').val());
            $('#selesaiAbsen').val($('#selesai').val());
        }
    }
</script>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card border-primary mb-1">
            <div class="card-body text-dark">
                <h5 class="card-title">Nama Kegiatan</h5>
                <div class="input-group">
                    <input name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="<?= $kegiatan['nama_kegiatan'] ?>" autofocus />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card border-primary mb-1">
            <div class="card-body text-dark">
                <h5 class="card-title">Lingkup Kegiatan</h5>
                <select name="lingkup" id="lingkup" class="form-control">
                    <option value="<?= $kegiatan['lingkup'] ?>" hidden><?= $kegiatan['lingkup'] ?></option>
                    <option value="Pengurus">Pengurus</option>
                    <option value="Program Studi">Program Studi</option>
                    <option value="Fakultas">Fakultas</option>
                    <option value="Universitas Majalengka">Universitas Majalengka</option>
                    <option value="Umum">Umum</option>
                </select>
                <h5 class="card-title mt-2">Sifat Kegiatan</h5>
                <select name="sifat" id="sifat" class="form-control">
                    <option value="<?= $kegiatan['sifat_kegiatan'] ?>" hidden><?= $kegiatan['sifat_kegiatan'] ?></option>
                    <option value="Langsung">Langsung</option>
                    <option value="Online">Online</option>
                    <option value="Hybrid">Hybrid</option>
                </select>
            </div>
        </div>
        <div class="card border-primary mb-1">
            <div class="card-body text-dark">
                <h5 class="card-title">Waktu Kegiatan</h5>
                <div class="input-group row">
                    <label for="mulai" class="col-md-4 col-form-label">Mulai</label>
                    <div class="col-md-8">
                        <input type="datetime-local" name="mulai" class="form-control" id="mulai" value="<?= $kegiatan['mulai'] ?>">
                    </div>
                </div>
                <div class="input-group row">
                    <label for="selesai" class="col-md-4 col-form-label">Selesai</label>
                    <div class="col-md-8">
                        <input type="datetime-local" name="selesai" class="form-control" id="selesai" value="<?= $kegiatan['selesai'] ?>">
                    </div>
                </div>
                <div class="input-group row my-1">
                    <div class="col-md-12 col-sm-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input tombolCek" value="1" id="is_active" name="is_active" <?= (($kegiatan['mulai_absensi'] != $kegiatan['mulai']) && ($kegiatan['selesai_absensi'] != $kegiatan['selesai'])) ? 'checked' : ''; ?> onclick="return is_active()">
                            <label class="custom-control-label" for="is_active">Sesuaikan waktu absensi dengan waktu kegiatan</label>
                        </div>
                    </div>
                </div>
                <div id="formAbsen" class="mt-2 <?= (($kegiatan['mulai_absensi'] != $kegiatan['mulai']) && ($kegiatan['selesai_absensi'] != $kegiatan['selesai'])) ? 'd-none' : ''; ?>">
                    <h5 class="card-title">Waktu Absensi</h5>
                    <div class="input-group row">
                        <label for="mulaiAbsen" class="col-md-4 col-form-label">Mulai</label>
                        <div class="col-md-8">
                            <input type="datetime-local" name="mulaiAbsen" class="form-control" id="mulaiAbsen" value="<?= $kegiatan['mulai_absensi'] ?>">
                        </div>
                    </div>
                    <div class="input-group row">
                        <label for="selesaiAbsen" class="col-md-4 col-form-label">Selesai</label>
                        <div class="col-md-8">
                            <input type="datetime-local" name="selesaiAbsen" class="form-control" id="selesaiAbsen" value="<?= $kegiatan['selesai_absensi'] ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="card border-primary mb-1">
            <div class="card-body text-dark">
                <h5 class="card-title">Tempat Kegiatan</h5>
                <div class="input-group">
                    <input name="tempat" id="tempat" class="form-control" value="<?= $kegiatan['tempat'] ?>" />
                </div>
                <h5 class="card-title mt-2">Deskripsi Kegiatan</h5>
                <textarea id="deskripsi" name="deskripsi"><?= $kegiatan['deskripsi'] ?></textarea>
            </div>
        </div>
        <button onclick="return submit_posts()" class="btn btn-lg btn-primary btn-block my-1 btn-simpan">Simpan</button>
    </div>
</div>