<?php
$kegiatan = akses('Kegiatan')->num_rows();
if ($kegiatan > 0) : ?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Kegiatan/i_kg') ?>">Tambah Kegiatan</a>
<?php endif;
if ($tampil->num_rows() < 1) {
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
            date_default_timezone_set('Asia/jakarta');
            $date = date('Y-m-d');
            foreach ($tampil->result_array() as $t) :
                $lingkup =  $t['lingkup'];
                $kode_prodi =  $t['kode_prodi'];
                $kode_fak =  $t['kode_fak'];
                if (($lingkup == 'Umum') ||
                    (($lingkup == 'Fakultas') && ($kode_fak == session_gan('kode_fak'))) ||
                    (($lingkup == 'Program Studi') && ($kode_prodi == session_gan('kode_prodi'))) ||
                    (($lingkup == 'Pengurus') && (session_gan('role_id') < 7))
                ) :
            ?>
                    <tr>
                        <td><?= date_id($t['tgl_kegiatan']) ?></td>
                        <td>
                            <a href="<?= base_url('Dashboard/info_kegiatan/' . $t['no_kegiatan']) ?>">
                                <?= $t['nama_kegiatan'] ?>
                            </a>
                        </td>
                        <td><?= $t['singkatan'] ?></td>
                        <td><?= $lingkup ?></td>
                        <td>
                            <?php
                            if ($t['tgl_kegiatan'] == $date) {
                                echo '<b class="text-success">Sedang Berlangsung</b>';
                            } else {
                                echo 'Belum Terlaksana';
                            }
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