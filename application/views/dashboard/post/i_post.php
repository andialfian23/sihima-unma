<script src="https://cdn.tiny.cloud/1/ykyeg2r4mx1ljcl808m3gojhw7qecwai4mlnkg0tff5h7cow/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#isi_postingan',
        plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars fullscreen link media template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist toc lists wordcount imagetools textpattern noneditable help charmap emoticons',
        mobile: {
            menubar: true
        },
        menubar: 'edit view insert format tools table',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify |  numlist bullist | fullscreen  preview |  link',
        templates: [{
                title: 'Kunjungan',
                description: 'Contoh isi Survey',
                content: 'on Progress'
            },
            {
                title: 'Perlombaan',
                description: 'Contoh isi Perlombaan',
                content: 'on Progress'
            },
            {
                title: 'Pelatihan',
                description: 'Contoh isi Pelatihan',
                content: '<p><strong>Nama Program Kerja :</strong> Pelatihan IoT</p> <p><strong>Sifat Program :</strong> Rintisan/ Komplementer/ Ikutan</p> <p><strong>Sasaran :</strong> Pelajar SMK</p> <p><strong>Metode Pelaksanaan :</strong> Pemberian materi tentang IoT</p> <p><strong>Luaran :</strong> Pelajar SMK dapat memahami mengenai IoT dan dapat di implementasikan untuk kedepannya</p> <p><strong>Alokasi Waktu :</strong> 3 Jam</p>'
            },
            {
                title: 'Sosialisasi',
                description: 'Contoh isi Sosialisasi',
                content: '<p><strong>Nama Program :</strong> Sosialisasi Stunting</p> <p><strong>Sifat Program :</strong> Rintisan/ Komplementer/ Ikutan</p> <p><strong>Sasaran :</strong> Ibu-ibu</p> <p><strong>Metode Pelaksanaan :</strong> Pemberian materi stunting</p> <p><strong>Luaran :</strong> Para ibu ibu dapat memperhatikan kesehatan bayi nya</p> <p><strong>Alokasi Waktu :</strong> 3 Jam</p> <p><strong>Biaya yang dibutuhkan :</strong> -</p> <p>Dokumentasi :</p>'
            },
            {
                title: 'Seminar',
                description: 'Contoh isi Seminar',
                content: '<p><strong>Nama Program :</strong> PROGRESSMA</p> <p><strong>Sifat Program :</strong> Rintisan/ Komplementer/ Ikutan</p> <p><strong>Sasaran :</strong> Mahasiswa Informatika</p> <p><strong>Metode Pelaksanaan :</strong> Pemberian materi pemrograman kekinian</p> <p><strong>Luaran :</strong> Para Mahasiswa Informatika dapat meng-implementasikan dari materi yang telah disampaikan</p> <p><strong>Alokasi Waktu :</strong> 3 Jam</p> <p><strong>Biaya yang dibutuhkan :</strong> -</p>'
            },
            {
                title: 'Laporan',
                description: 'Contoh isi Laporan',
                content: 'on Progress'
            },
            {
                title: 'Artikel',
                description: 'Contoh isi Artikel',
                content: 'on Progress'
            },
            {
                title: 'Berita / pengumuman',
                description: 'Contoh isi Berita / pengumuman',
                content: 'on Progress'
            },
            {
                title: 'Lainnya',
                description: 'Contoh isi Lainnya',
                content: 'on Progress'
            },
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tiny.cloud/css/codepen.min.css'
        ],
        importcss_append: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    var id = 'post-image-' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var blobInfo = blobCache.create(id, file, reader.result);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
            };
            input.click();
        },
        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '<?= base_url('Post/upload_image') ?>');
            xhr.onload = function() {
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                var res = JSON.parse(xhr.responseText);
                if (res.status == 'error') {
                    failure(res.message);
                    return;
                }
                success(res.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
        height: 400,
        image_caption: true,
        noneditable_noneditable_class: "mceNonEditable",

    });

    function submit_posts() {
        if ($('#judul').val() == '') {
            $('#judul').addClass('border border-danger');
            toastr.error("Judul Postingan masih kosong");
            return false;
        }
        if ($('#cover').val() == '') {
            $('#cover').addClass('border border-danger');
            toastr.error("Cover Postingan masih kosong");
            return false;
        }
        if (tinyMCE.get('isi_postingan').getContent() == '') {
            $('#isi_postingan').addClass('border border-danger');
            toastr.error("Isi Postingan masih kosong");
            return false;
        }

        var dataset = new FormData();
        dataset.append('judul', $('#judul').val());
        dataset.append('isi_postingan', tinyMCE.get('isi_postingan').getContent());
        dataset.append('kategori', $('#kategori').val());
        dataset.append('is_published', $('#is_published').val());
        dataset.append('cover', $('input[type=file]')[0].files[0]);

        // send data
        $.ajax({
            url: '<?= base_url('Post/insert') ?>',
            type: 'POST',
            data: dataset,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response == '1') {
                    toastr.success("Postingan baru berhasil dibuat!!!");
                    setTimeout(function() {
                        window.location.replace("<?= base_url('Pengurus/postinganku') ?>");
                    }, 1000);
                } else {
                    toastr.error(response);
                }
            }
        });
    };

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
        // Image Preview
        $('#cover').on('change', function() {
            $('#preview').show();
            readURL(this);
        });
        // remove Image Preview
        $('#preview').on('dblclick', function() {
            $('#preview').hide().removeAttr('src');
        });

    });
</script>

<div class="row">
    <div class="col-md-9 col-sm-12 mb-1">
        <input autofocus type="text" class="form-control form-control-lg mb-1" name="judul" id="judul" placeholder="Judul Postingan" value="">
        <textarea id="isi_postingan" name="isi_postingan"></textarea>
    </div>
    <div class="col-md-3 col-sm-12">
        <button onclick="return submit_posts()" class="btn btn-lg btn-primary btn-block mb-1">Simpan</button>
        <div class="card border-primary mb-1">
            <div class="card-body text-dark">
                <h5 class="card-title">Kategori Kegiatan/ Artikel</h5>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="9">Lainnya</option>
                    <option value="1">Kunjungan</option>
                    <option value="2">Perlombaan</option>
                    <option value="3">Pelatihan</option>
                    <option value="4">Sosialisasi</option>
                    <option value="5">Seminar</option>
                    <option value="6">Laporan</option>
                    <option value="7">Artikel</option>
                    <option value="8">Berita / Pengumuman</option>
                </select>
            </div>
        </div>
        <div class="card border-primary mb-1">
            <div class="card-body text-dark">
                <h5 class="card-title">Cover</h5>
                <div class="input-group">
                    <input type="file" name="cover" class="form-control" id="cover">
                    <img id="preview" width="100%" style="display:none;" class="img-responsive mt-1" title="Double klik untuk menghapus gambar">
                </div>
            </div>
        </div>
        <div class="card border-primary mb-1">
            <div class="card-body text-dark">
                <h5 class="card-title">Publish</h5>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="1" id="is_published" name="is_published" checked>
                    <label class="custom-control-label" for="is_published">Ya</label>
                </div>
            </div>
        </div>
    </div>
</div>