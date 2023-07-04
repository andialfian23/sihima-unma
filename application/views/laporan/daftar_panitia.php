<?php $this->load->view('laporan/template/head') ?>

<?php $this->load->view('laporan/template/header') ?>

<div style="text-align:center;">
    <h2>
        <?php
        $jml_panitia = $panitia['num_rows'];
        $cek_jml_panitia = $this->absen->cek_sebagai($col['no_kegiatan'], 'Panitia');
        echo ($cek_jml_panitia == $jml_panitia) ? 'DAFTAR PANITIA' : 'SUSUSAN PANITIA';
        ?>
    </h2>
    <h2><?= $col['nama_kegiatan'] ?></h2>
    <h2><?= strtoupper($col['nama_hima']) ?></h2>
</div>
<br>

<?php
if ($jml_panitia > 0) :
    if ($cek_jml_panitia != $jml_panitia) :
?>

        <table id="table_no_border">
            <tbody>
                <?php
                $list_panitia = [];
                foreach ($sebagai as $sie) :
                    $cek = $this->absen->cek_sebagai($col['no_kegiatan'], $sie);
                    if (($cek > 0)) :
                ?>
                        <tr>
                            <td valign="top"><b><?= $sie ?></b></td>
                            <td> : <b>
                                    <?php
                                    foreach ($panitia['result'] as $t) :
                                        if ($t['sebagai'] == $sie) {
                                            echo ucwords(strtolower($t['nm_pd'])) . '</br>';
                                        }
                                    ?>
                                    <?php
                                    endforeach;
                                    ?>
                                </b>
                            </td>
                        </tr>
                <?php
                    endif;
                endforeach;
                ?>
            </tbody>
        </table>

    <?php else : ?>
        <table id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NPM</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($panitia['result'] as $t) :
                    if ($t['status'] == 'Hadir') :
                ?>
                        <tr>
                            <td scope="row" width="50px" align="center"><?= $no; ?></td>
                            <td align="center"><?= $t['id_peserta'] ?></td>
                            <td><?= $t['nm_pd'] ?></td>
                        </tr>
                <?php endif;
                    $no++;
                endforeach; ?>
            </tbody>
        </table>

<?php
    endif;
else :
    echo '<h4>Belum ada data panitia!!!</h4>';
endif;
$this->load->view('laporan/template/footer') ?>