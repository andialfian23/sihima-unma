<?php $this->load->view('laporan/head') ?>

<?php $this->load->view('laporan/header') ?>

<div style="text-align:center;">
    <h2>REALISASI BIAYA KEGIATAN</h2>
    <h2><?= $col['nama_kegiatan'] ?></h2>
    <h2><?= strtoupper($col['nama_hima']) ?></h2>
</div>
<br>

<?php
$jumlah = 0;
if ($biaya['jml_data_pemasukan'] > 1) {
    $jumlah += $biaya['total_pemasukan_int'];
?>
    <div>
        <strong>PEMASUKAN</strong></br>
    </div>
    <br>
    <table id="table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Sumber</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no1 = 1;
            foreach ($biaya['pemasukan'] as $pm) :
            ?>
                <tr>
                    <td scope="row" align="center"><?= $no1; ?>.</td>
                    <td><?= $pm['nama_item'] ?></td>
                    <td align="right"><?= $pm['jumlah'] ?></td>
                </tr>
            <?php
                $no1++;
            endforeach; ?>
            <tr>
                <td colspan="2"><b>JUMLAH</b></td>
                <td align="right">
                    <?= $biaya['total_pemasukan'] ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <?php
    if ($biaya['jml_data_pengeluaran'] > 0) { ?>
        <div>
            <strong>PENGELUARAN</strong></br>
        </div>
        <br>
    <?php } ?>
<?php } ?>

<?php
if ($biaya['jml_data_pengeluaran'] > 0) {
    $jumlah += $biaya['total_pengeluaran_int'];
?>
    <table id="table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Rincian</th>
                <th>Harga/unit</th>
                <th>Volume</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($biaya['pengeluaran'] as $pk) :
            ?>
                <tr>
                    <td scope="row" align="center"><?= $pk['no_item']; ?>.</td>
                    <td><?= $pk['nama_item'] ?></td>
                    <td align="right"><?= ($pk['harga'] != null) ? $pk['harga'] : '<center>-</center>'; ?></td>
                    <td align="center"><?= ($pk['volume'] != null) ? $pk['volume'] : '-'; ?></td>
                    <td align="right"><?= $pk['jumlah'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4"><b>JUMLAH</b></td>
                <td align="right">
                    <?= $biaya['total_pengeluaran'] ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>

<br>
<div>
    <b style="margin-bottom:2px;">
        <?php
        if ($biaya['jml_data_pemasukan'] < 1) { ?>

            Jadi dana yang dipakai untuk Kegiatan <?= $biaya['nama_kegiatan'] ?> adalah Rp <?= number_format($jumlah); ?><br>

        <?php
            echo 'Sumber Dana : KAS ' . session_gan('singkatan') . ' ' . session_gan('per_jabatan');
        } else {
            if ($biaya['jml_data_pengeluaran'] > 0) {
                echo "= PEMASUKAN - PENGELUARAN <br><br>";
                echo "= " . $biaya['total_pemasukan'] . ' - ' . $biaya['total_pengeluaran'] . '<br><br>';
                echo "= Rp " . number_format($biaya['total_pemasukan_int'] - $biaya['total_pengeluaran_int']);
            }
        } ?>
    </b>
</div>
<?php $this->load->view('laporan/footer') ?>