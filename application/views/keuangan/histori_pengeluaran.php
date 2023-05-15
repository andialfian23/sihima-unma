<?php
$totalpk = $this->db->query("SELECT sum(jml_pk) as totalpk 
FROM t_pengeluaran WHERE id_mj='" . $_SESSION['id_mj'] . "' group by id_mj ASC")->row_array();
if ($totalpk != NULL) {
?>
    <h4 class="mb-2">Total Pengeluaran : <b>Rp <?= number_format($totalpk['totalpk']) ?></b></h4>
<?php }
$cash = akses('Keuangan');
if ($cash->num_rows() > 0) {
?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Keuangan/i_pk') ?>">Tambah Pengeluaran</a>
<?php } ?>

<table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Nama Pengeluaran</th>
            <th>Jumlah (Rp)</th>
            <?php
            if ($cash->num_rows() > 0) {
                echo '<th>Aksi</th>';
            } ?>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($tampil->result_array() as $t) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= date_indo($t['tgl_pk']) ?></td>
                <td><?= $t['nama_pengeluaran'] ?></td>
                <td><?= number_format($t['jml_pk']) ?></td>
                <?php
                if ($cash->num_rows() > 0) {
                ?>
                    <td>
                        <a href="<?= base_url("Keuangan/e_pk/" . $t['no_pk']) ?>" class="btn btn-info btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?= base_url("Keuangan/del_pk/" . $t['no_pk']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ingin menghapus data pengeluaran <?= $t['nama_pengeluaran'] ?> ini ?')">
                            <i class="fa fa-trash"></i>
                        </a>
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
            lengthMenu: [
                [5, 10, 25, 50, -1],
                ['5', '10', '25', '50', 'Semua Data']
            ],
            language: {
                url: "<?= base_url('assets/ID.json') ?>",
            }
        });
    });
</script>