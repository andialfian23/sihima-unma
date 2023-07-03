<?php
$totalpb = $this->db->query("SELECT sum(nominal_bayar) as totalpb FROM t_pembayaran ")->row_array();
$total_pm = $pemasukan;
if ($total_pm != NULL) {
?>
    <h4 class="mb-2">Total KAS : <b>Rp <?= number_format($totalpb['totalpb']) ?></b></h4>

    <h4 class="mb-2">Total Pemasukan : <b>Rp <?= number_format($total_pm['total_pemasukan']) ?></b></h4>
<?php }
$cash = akses('Keuangan')->num_rows();
if ($cash > 0) {
?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Keuangan/i_pm') ?>">Tambah pemasukan</a>
<?php } ?>

<table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
    <thead>
        <tr>
            <!-- <th>#</th> -->
            <th>Tanggal</th>
            <th>Nama pemasukan</th>
            <th>Sumber</th>
            <th>Jumlah (Rp)</th>
            <?php
            if ($cash > 0) {
                echo '<th>Aksi</th>';
            } ?>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($pemasukan['result']->result_array() as $t) { ?>
            <tr>
                <!-- <td><?= $no ?></td> -->
                <td>
                    <?= ($t['kas_hima'] == 1) ? '1 PERIODE' : $t['tgl_pm']; ?>
                </td>
                <td><?= $t['nama_pemasukan'] ?></td>
                <td><?= $t['sumber'] ?></td>
                <td class="text-right"><?= number_format($t['jml_pm']) ?></td>
                <?php
                if ($cash > 0) {
                ?>
                    <td>
                        <?php if ($t['kas_hima'] == 0) : ?>
                            <a href="<?= base_url("Keuangan/e_pm/" . $t['no_pm']) ?>" class="btn btn-info btn-sm mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= base_url("Keuangan/del_pm/" . $t['no_pm']) ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Apakah Anda Yakin ingin menghapus data pemasukan <?= $t['nama_pemasukan'] ?> ini ?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                <?php
                } ?>
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
                    action: function(e, dt, node, config) {
                        setTimeout(function() {
                            window.open("<?= base_url('Report/keuangan')  ?>", '_blank');
                        }, 2000);
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                },
            ],
            language: {
                url: "<?= base_url('assets/ID.json') ?>",
            },
            lengthMenu: [
                [5, 10, 25, 50, -1],
                ['5', '10', '25', '50', 'Semua Data']
            ],
        });
    });
</script>