<?php
if ($tampil->num_rows() < 1) {
    echo "<h4 class='text-center'>Tidak ada kegiatan himpunan yang pernah diikuti</h4>";
} else {
?>
    <table class="table table-bordered responsive" width="100%" id="dataTables-sihima">

        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Sebagai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($tampil->result_array() as $t) :
            ?>
                <tr>
                    <td><?= $t['tgl_kegiatan'] ?></td>
                    <td><a href="<?= base_url('Dashboard/info_kegiatan/' . $t['no_kegiatan']) ?>">
                            <?= $t['nama_kegiatan'] ?></a>
                    </td>
                    <td><?= (($t['sebagai'] != 'Panitia') && ($t['sebagai'] != 'Peserta')) ? 'Panitia ' . $t['sebagai'] : $t['sebagai']; ?></td>
                    <td><?= $t['status'] ?></td>
                </tr>
            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>
    <!-- 
    <div class="d-none d-print-block">
        <table class="mt-2" width="100%" border="0">
            <tr>
                <td width="60%">&nbsp;</td>
                <td width="40%" class="text-center">
                    Ketua Program Studi,
                    <br><br>TTD<br><br>
                    (Harun Sujadi, ST., M.Kom)
                </td>
            </tr>
        </table>
    </div> -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-sihima').DataTable({
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
                                window.open("<?= base_url('Report/kegiatanku')  ?>", '_blank');
                            }, 2000);
                        }
                    }
                ],
                language: {
                    url: "<?= base_url('assets/ID.json') ?>",
                },
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10', '25', '50', 'Semua Data']
                ],
                order: [0, 'desc'],
            });
        });
    </script>
<?php } ?>