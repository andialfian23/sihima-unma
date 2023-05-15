<?php
$total =  $jml_pengurus - $jml_tagihan_anggota;
if ($total > 0) {
?>
    <a class="btn btn-info mb-2" href="<?= base_url('Tagihan/i_tp/' . $tagihan['no_tg']) ?>">Pilih Anggota Pengurus</a>
<?php } ?>
<a class="btn btn-primary mb-2" href="<?= base_url('Tagihan/i_tmhs/' . $tagihan['no_tg']) ?>">Pilih Anggota Lainnya</a>

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
            foreach ($tagihan_anggota->result_array() as $t) {
                $nama = json_npm($t['id_mahasiswa_pt'])['nm_pd'];
            ?>
                <tr>
                    <td><?= $t['id_mahasiswa_pt'] ?></td>
                    <td><?= $nama ?></td>
                    <td>Rp <?= number_format($tagihan['jml_tagihan']) ?></td>
                    <td>
                        <?php
                        $j = number_format($tagihan['jml_tagihan']);
                        $n = number_format($t['dibayar']);
                        if ($n == '0') {
                        ?>
                            <a href="<?= base_url('Pembayaran/' . $t['no_ta']) ?>" class="text-danger">
                                <b>Belum Bayar</b>
                            </a>
                        <?php
                        } elseif ($n == $j) {
                            echo 'Lunas';
                        } else {
                            echo '<a href="' . base_url('Pembayaran/' . $t['no_ta']) . '">' . $n . '</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?= base_url('Tagihan/del_tp/' . $t['no_ta']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data tagihan <?= $tagihan['nama_tagihan'] . ' ' . $nama; ?> ini?')">
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