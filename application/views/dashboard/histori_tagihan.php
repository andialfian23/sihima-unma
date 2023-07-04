<table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tagihan</th>
            <th>Jumlah Tagihan</th>
            <th>Batas</th>
            <th>Status Bayar</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($tampil as $row) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['nama_tagihan'] ?></td>
                <td><?= number_format($row['jml_tagihan']) ?></td>
                <td><?= $row['expired_at'] ?></td>
                <td>
                    <?php
                    $jml = $row['jml_tagihan'];
                    $u = $row['dibayar'];
                    if ($u == 0) {
                        echo "<b class='text-danger'>Belum Bayar</b>";
                    } elseif ($u == $jml) {
                        echo "<b class='text-success'>Lunas</b>";
                    } else {
                        echo number_format($u);
                    }
                    ?>
                </td>

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
            }
        });
    });
</script>