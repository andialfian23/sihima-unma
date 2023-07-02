<a href="#" class="btn btn-block btn-lg btn-info mb-2" data-toggle="modal" data-target="#myModal">Tambah Admin</a>

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
                <form action="<?= base_url('Admin/add_admin') ?>" method="POST">

                    <div class="input-group mt-1">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary" disabled>
                                NPM
                            </button>
                        </div>
                        <input type="text" name="npm" id="npm" class="form-control" placeholder="18.14.1.0001">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-info" id="cariData">
                                Cari
                            </button>
                        </div>
                        <p> </p>
                    </div>
                    <div class="form-group mt-1 dataView d-none  row">
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
                    <div class="form-group btnView d-none">
                        <button class="btn btn-block btn-primary" type="submit" id="addAdmin">Jadikan Admin</button>
                    </div>
                </form>

                <script>
                    var input_nm_pd = document.getElementById('nm_pd');
                    var input_prodi = document.getElementById('prodi');
                    var input_fakultas = document.getElementById('fakultas');
                    $(document).ready(function() {
                        $('#cariData').click(function() {
                            if ($('#npm').val() == '') {
                                $('#npm').addClass('border border-danger');
                                toastr.error("NPM masih kosong");
                                return false;
                            }
                            var dataset = new FormData();
                            dataset.append('npm', $('#npm').val());
                            $.ajax({
                                url: '<?= base_url('Admin/cari_data') ?>',
                                type: 'POST',
                                data: dataset,
                                contentType: false,
                                processData: false,
                                success: function(mhs) {
                                    if (mhs == '0') {
                                        console.log('Data mahasiswa tidak ditemukan');
                                        toastr.error('Data Mahasiswa tidak Ditemukan');
                                        $('#npm').addClass('border border-danger');
                                        $('.dataView').addClass('d-none');
                                        $('.btnView').addClass('d-none');
                                        input_nm_pd.value = '';
                                        input_prodi.value = '';
                                        input_fakultas.value = '';
                                    } else if (mhs == '1') {
                                        console.log('Mahasiswa ini sudah menjadi Admin');
                                        toastr.error('Mahasiswa ini sudah menjadi Admin');
                                        $('#npm').addClass('border border-danger');
                                        $('.dataView').addClass('d-none');
                                        $('.btnView').addClass('d-none');
                                        input_nm_pd.value = '';
                                        input_prodi.value = '';
                                        input_fakultas.value = '';
                                    } else {
                                        console.log('Data mahasiswa ditemukan : ' + mhs.nm_pd);
                                        toastr.success('Data Mahasiswa Ditemukan');
                                        $('.dataView').removeClass('d-none');
                                        $('.btnView').removeClass('d-none');
                                        input_nm_pd.value = mhs.nm_pd;
                                        input_prodi.value = mhs.nama_prodi;
                                        input_fakultas.value = mhs.nama_fak;
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
        foreach ($admin as $t) { ?>
            <tr>
                <!-- <td><?= $no ?> </td> -->
                <td><?= $t['id_mahasiswa_pt'] ?> </td>
                <td><?= $t['nm_pd'] ?> </td>
                <td><?= $t['no_hp'] ?> </td>
                <td>
                    <a href="<?= base_url('Admin/del_admin/' . $t['id']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus admin <?= $t['nm_pd'] ?> ini?')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php
            // $no++;
        }
        ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-sihima').DataTable();
    });
</script>