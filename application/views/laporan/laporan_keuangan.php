<?php $this->load->view('laporan/template/head') ?>

<div class="header-laporan">
    <table width="100%" class="header">
        <tr>
            <td><img src="<?= base_url('images/logo/' . $hima['logo']) ?>" alt="" width="100px"></td>
            <td>
                <b>
                    LAPORAN PERTANGGUNGJAWABAN<br>
                    BADAN PENGURUS <?= strtoupper($hima['singkatan']) . ' ' . $hima['periode'] ?><br>
                    UNIVERSITAS MAJALENGKA<br>
                </b>
                <i>Jl. Universitas Majalengka No. 01 KM 2 Majalengka 45415</i>

            </td>
        </tr>
    </table>

</div>
<hr>

<div style="text-align:center;">
    <h2>LAPORAN KEUANGAN BENDAHARA</h2>
    <h2><?= strtoupper($hima['nama_hima']) ?></h2>
    <h2><?= strtoupper($hima['periode']) ?></h2>
</div>
<br>

<?php
if ($pemasukan['num_rows'] > 0) {
?>
    <div>
        <center><strong>RINCIAN PEMASUKAN KEUANGAN <?= $hima['singkatan'] . ' PERIODE ' . $hima['periode'] ?></strong></center>
    </div>
    <br>
    <table class="keuangan">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="10%">Tanggal</th>
                <th>Sumber Dana</th>
                <th>Pemasukan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no1 = 1;
            $jml_pm = 0;
            foreach ($pemasukan['result']->result_array() as $t) :
            ?>
                <tr>
                    <td scope="row" align="center"><?= $no1; ?>.</td>
                    <td align="center" style="white-space: nowrap;"><?= ($t['kas_hima'] == 1) ? '1 PERIODE' : shortdate_indo($t['tgl_pm']); ?></td>
                    <td><?= $t['nama_pemasukan'] ?> </td>
                    <td align="right" style="white-space: nowrap;"><?= 'Rp ' . number_format($t['jml_pm']) ?></td>
                </tr>
            <?php
                $jml_pm += $t['jml_pm'];
                $no1++;
            endforeach; ?>
            <tr>
                <td colspan="3"><b>JUMLAH</b></td>
                <td align="right">
                    <b>

                        <?= 'Rp ' . number_format($jml_pm) ?>
                    </b>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>

<?php
if ($pengeluaran->num_rows() > 0) {
?>
    <br>
    <div>
        <center><strong>RINCIAN PENGELUARAN KEUANGAN <?= $hima['singkatan'] . ' PERIODE ' . $hima['periode'] ?></strong></center>
    </div>
    <br>
    <table class="keuangan">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="9%">Tanggal</th>
                <th>Sumber Dana</th>
                <th>Keperluan</th>
                <th>Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no2 = 1;
            $jml_pk = 0;
            foreach ($pengeluaran->result_array() as $t) :
            ?>
                <tr>
                    <td scope="row" align="center"><?= $no2; ?>.</td>
                    <td><?= shortdate_indo($t['tgl_pk']) ?></td>
                    <td><?= 'KAS ' . $hima['singkatan'] ?></td>
                    <td><?= $t['nama_pengeluaran'] ?></td>
                    <td align="right"><?= 'Rp ' . number_format($t['jml_pk']) ?></td>
                </tr>
            <?php
                $jml_pk += $t['jml_pk'];
                $no2++;
            endforeach; ?>
            <tr>
                <td colspan="4"><b>JUMLAH</b></td>
                <td align="right">
                    <b>

                        <?= 'Rp ' . number_format($jml_pk) ?>
                    </b>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>

<?php
$jml_pm = 0;
if ($pemasukan['num_rows'] > 0) {
    foreach ($pemasukan['result']->result_array() as $t) :
        $jml_pm += $t['jml_pm'];
    endforeach;
}
?>

<br>
<div>
    <b>
        <?php
        if (($jml_pm != 0) && ($jml_pk != 0)) {
            echo "= PEMASUKAN - PENGELUARAN <br><br>";
            echo "= Rp " . number_format($jml_pm) . ' - Rp ' . number_format($jml_pk) . '<br><br>';
            echo "= Rp " . number_format($jml_pm - $jml_pk);
        }
        ?>
    </b>
</div>

<?php $this->load->view('laporan/template/footer') ?>