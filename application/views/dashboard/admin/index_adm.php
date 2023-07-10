<a href="#" class="btn btn-block btn-lg btn-info mb-2" id="addAdmin" data-toggle="modal" data-target="#myModal">Tambah Admin</a>

<table width="100%" class="table responsive table-striped table-bordered no-wrap" id="dataTables-sihima">
    <thead>
        <tr>
            <!-- <th>No</th> -->
            <th>NPM</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($admins as $row) {
            $id = $row['id'];
            $nama = $row['nm_pd'];
        ?>
            <tr>
                <!-- <td><?= $no ?> </td> -->
                <td><?= $row['id_mahasiswa_pt'] ?> </td>
                <td><?= $row['nm_pd'] ?> </td>
                <td><?= $row['no_hp'] ?> </td>
                <td>
                    <a href="#" class="btn btn-sm btn-danger mb-1" onclick=" hapusAdmin('<?= $id ?>','<?= $nama ?>'); ">
                        <i class=" fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php
            // $no++;
        }
        ?>
    </tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-data">
                <div class="input-group mt-1">
                    <div class="input-group-prepend">
                        <button class="btn btn-secondary" disabled>NPM</button>
                    </div>
                    <input type="text" name="npm" id="npm" class="form-control" placeholder="18.14.1.0001">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-info" id="cariData">Cari</button>
                    </div>
                </div>
                <div class="form-group mt-1 dataView row">
                    <label class="col-md-3 label-control" for="nm_pd">Nama Mahasiswa</label>
                    <div class="col-md-9">
                        <input type="text" name="nm_pd" id="nm_pd" class="form-control" value="" disabled>
                    </div>
                    <label class="col-md-3 label-control" for="prodi">Prodi</label>
                    <div class="col-md-9">
                        <input type="text" name="prodi" id="prodi" class="form-control" value="" disabled>
                    </div>
                    <label class="col-md-3 label-control" for="fakultas">Fakultas</label>
                    <div class="col-md-9">
                        <input type="text" name="fakultas" id="fakultas" class="form-control" value="" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit" id="submitAdd">Jadikan Admin</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var base_url = "<?= base_url('Admin') ?>";
    var input_nm_pd = $('#nm_pd');
    var input_prodi = $('#prodi');
    var input_fakultas = $('#fakultas');


    function hapusAdmin(id, nama) {
        if (confirm('Apakah anda yakin ingin menghapus Admin ' + nama + ' ?')) {
            $.ajax({
                url: base_url + '/delete',
                type: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(res) {
                    (res.kode == '1') ? toastr.success(res.pesan): toastr.error(res.pesan);

                    setTimeout(function() {
                        window.location.replace(base_url + '/main');
                    }, 1000);
                }
            });
        }
    }

    $(function() {
        $('#dataTables-sihima').DataTable();

        function kosongkan_form() {
            input_nm_pd.val('');
            input_prodi.val('');
            input_fakultas.val('');
            $('.dataView').hide();
            $('#submitAdd').hide();
            $('#npm').removeClass('border border-danger');
        }

        $('#addAdmin').click(function() {
            kosongkan_form();
        });

        $('#cariData').click(function() {
            kosongkan_form();

            if ($('#npm').val() == '') {
                $('#npm').addClass('border border-danger');
                toastr.error("NPM masih kosong");
                return false;
            }

            $.ajax({
                url: base_url + '/search',
                type: 'POST',
                data: {
                    npm: $('#npm').val(),
                },
                dataType: 'json',
                success: function(res) {
                    if (res.kode == '1') {
                        var mhs = res.pesan;
                        $('.dataView').show();
                        $('#submitAdd').show();
                        console.log('Data mahasiswa ditemukan : ' + mhs.nm_pd);
                        input_nm_pd.val(mhs.nm_pd);
                        input_prodi.val(mhs.nama_prodi);
                        input_fakultas.val(mhs.nama_fak);
                    } else {
                        $('#npm').addClass('border border-danger');
                        toastr.error(res.pesan);
                    }
                }
            });
        });

        $('#submitAdd').click(function() {
            kosongkan_form();

            $.ajax({
                url: base_url + '/insert',
                type: 'POST',
                data: {
                    npm: $('#npm').val(),
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    if (res.kode == '1') {
                        toastr.success(res.pesan);
                        setTimeout(function() {
                            window.location.replace(base_url + '/main');
                        }, 1000);
                    } else {
                        toastr.error(res.pesan);
                        $('#npm').addClass('border border-danger');
                    }
                }
            });
        });

    });
</script>