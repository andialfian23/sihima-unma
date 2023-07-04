<?php
$akses_kg = akses('Kegiatan')->num_rows();
if ($akses_kg > 0) : ?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Kegiatan/i_kg') ?>">Tambah Kegiatan</a>
<?php endif;
if ($kegiatan->num_rows() < 1) {
    echo "<h4 class='text-center'>Belum ada kegiatan Terbaru</h4>";
} else {
?>
    <table class="table table-bordered responsive" width="100%" id="dataTables-sihima">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Penyelenggara</th>
                <th>Lingkup</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            $date = date('Y-m-d');
            foreach ($kegiatan->result_array() as $t) :
                $lingkup =  $row['lingkup'];
                $kode_prodi =  $row['kode_prodi'];
                $kode_fak =  $row['kode_fak'];
                if (($lingkup == 'Umum') ||
                    (($lingkup == 'Fakultas') && ($kode_fak == $_SESSION['kode_fak'])) ||
                    (($lingkup == 'Program Studi') && ($kode_prodi == $_SESSION['kode_prodi'])) ||
                    (($lingkup == 'Pengurus') && ($_SESSION['role_id'] < 7))
                ) :
            ?>
                    <tr>
                        <td><?= date_id($row['tgl_kegiatan']) ?></td>
                        <td>
                            <a href="<?= base_url('Dashboard/info_kegiatan/' . $row['no_kegiatan']) ?>">
                                <?= $row['nama_kegiatan'] ?>
                            </a>
                        </td>
                        <td><?= $row['singkatan'] ?></td>
                        <td><?= $lingkup ?></td>
                        <td>
                            <?=
                            ($row['tgl_kegiatan'] == $date)
                                ? '<b class="text-success">Sedang Berlangsung</b>'
                                : 'Belum Terlaksana';
                            ?>
                        </td>
                    </tr>
            <?php
                endif;
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-sihima').DataTable({
                language: {
                    url: "<?= base_url('assets/ID.json') ?>",
                }
            });
        });
    </script>
<?php } ?>