<?php
$total =  $jml_pengurus - $jml_tagihan_anggota;
if ($total > 0) {
?>
    <a class="btn btn-info mb-2" href="<?= base_url('Tagihan_anggota/i_tp/' . $tagihan['no_tg']) ?>">Pilih Anggota Pengurus</a>
<?php } ?>
<a class="btn btn-primary mb-2" href="<?= base_url('Tagihan_anggota/i_tmhs/' . $tagihan['no_tg']) ?>">Pilih Anggota Lainnya</a>

<?php
if ($tagihan_anggota->num_rows() > 0) {
?>
    <table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Jumlah Tagihan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($tagihan_anggota->result_array() as $row) {
            ?>
                <tr>
                    <td><?= $row['npm'] ?></td>
                    <td><?= $row['nama_mhs'] ?></td>
                    <td>Rp <?= number_format($row['jml_tagihan']) ?></td>
                    <td>
                        <?php
                        if ($row['jml_tagihan'] == $row['sisa_tagihan']) {
                        ?>
                            <a href="<?= base_url('Pembayaran/' . $row['no_ta']) ?>" class="text-danger">
                                <b>Belum Bayar</b>
                            </a>
                        <?php
                        } elseif ($row['sisa_tagihan'] == 0) {
                            echo 'Lunas';
                        } else {
                            echo '<a href="' . base_url('Pembayaran/' . $row['no_ta']) . '">' . number_format($row['jml_tagihan']) . '</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?= base_url('Tagihan_anggota/delete/' . $row['no_ta']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data tagihan <?= $row['nama_tagihan'] . ' ' . $row['nama_mhs']; ?> ini?')">
                            <i class="fa fa-trash"></i>
                        </a>
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

<?php
} else {
    echo "<h4>Data tagihan anggota belum dibuat</h4>";
}
?>