<?php
$akses_kg = akses('Kegiatan')->num_rows();
if ($akses_kg > 0) : ?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Kegiatan/i_kg') ?>">Tambah Kegiatan</a>
<?php endif; ?>

<div class="card border-info">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-3 label-control" for="id_mj">Periode Jabatan</label>
            <div class="col-md-4">
                <select id="id_mj" name="id_mj" class="form-control">
                    <option value="<?= $id_mj ?>" hidden><?= $periode ?></option>
                    <?php
                    $mj = $this->MJ_model->get_masa_jabatan($_SESSION['hima_id']);
                    foreach ($mj as $h) {
                        echo '<option value="' . $h['id_mj'] . '"> ' . $h['periode'] . '</option>';
                    }
                    ?>
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#id_mj').change(function() {
                            var id_mj = $(this).val();
                            setTimeout(function() {
                                window.location.replace("<?= base_url('Kprodi/kegiatan/') ?>" + id_mj);
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
if ($kegiatan->num_rows() > 0) {
?>
    <table width="100%" class="table responsive table-striped table-bordered no-wrap" id="dataTables-sihima">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Lingkup</th>
                <?php if ($_SESSION['role_id'] == '2') { ?>
                    <th>Laporan</th>
                <?php } ?>
                <?php if ($akses_kg > 0) : ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($kegiatan->result_array() as $t) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= date_indo($t['tgl_kegiatan']) ?> </td>
                    <td>
                        <a href="<?= base_url('Dashboard/info_kegiatan/' . $t['no_kegiatan']) ?>">
                            <?= $t['nama_kegiatan'] ?>
                        </a>
                    </td>
                    <td><?= $t['lingkup'] ?> </td>
                    <?php if ($_SESSION['role_id'] == '2') { ?>
                        <td>
                            <a href="<?= base_url('Report/pdf_kegiatan/' . $t['no_kegiatan']) ?>" class="text-warning mb-1" target="_blank">
                                <i class="fas fa-file-pdf fa-lg"></i>
                            </a>
                        </td>
                    <?php } ?>
                    <?php if ($akses_kg > 0) : ?>
                        <td>
                            <a href="<?= base_url('Kegiatan/e_kg/' . $t['no_kegiatan']) ?>" class="btn btn-sm btn-info mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= base_url('Kegiatan/del_kg/' . $t['no_kegiatan']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $t['nama_kegiatan'] ?> ini?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-sihima').DataTable({
                language: {
                    url: "<?= base_url('assets/ID.json') ?>",
                },
            });
        });
    </script>
<?php
} else {
    echo "<h4 class='text-center'>Tidak Ada Data Kegiatan !!!</h4> ";
}
?>