<div class="card border-info">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-3 label-control" for="id_mj">Periode Jabatan</label>
            <div class="col-md-4">
                <select id="id_mj" name="id_mj" class="form-control">
                    <option value="<?= $id_mj ?>" hidden><?= $periode ?></option>
                    <?php
                    foreach ($masa_jabatans as $mj) {
                        echo '<option value="' . $mj['id_mj'] . '"> ' . $mj['periode'] . '</option>';
                    }
                    $page = ($_SESSION['role_id'] == '2') ? 'Kprodi/pengurus/' : 'Pengurus/anggota/';
                    ?>
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#id_mj').change(function() {
                            var id_mj = $(this).val();
                            setTimeout(function() {
                                window.location.replace("<?= base_url($page) ?>" + id_mj);
                            }, 2000);
                        });
                    });
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Ketua Himpunan
            </div>
            <div class="col-md-9"><b><?= $kahim ?></b></div>
        </div>
    </div>
</div>
<?php
if ($penguruss['num_rows'] > 0) :
?>
    <table width="100%" class="table responsive table-striped table-bordered table-hover nowrap" id="dataTables-sihima">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($penguruss['result'] as $row) {
            ?>
                <tr>
                    <td><?= $row['id_mahasiswa_pt'] ?></td>
                    <td>
                        <a href="<?= base_url('Dashboard/detail/' . $row['id_mahasiswa_pt']) ?>">
                            <?= $row['nm_pd'] ?>
                        </a>
                    </td>
                    <td><?= $row['jabatan'] ?> </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-sihima').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [{
                        extend: 'pageLength',
                        text: 'Tampilkan Data',
                        className: 'btn btn-light',
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10', '25', '50', 'Semua Data']
                ],
            });
        });
    </script>
<?php
else :
    echo "<h4>Data Tidak Ditemukan</h4>";
endif;
?>