<div class="row">
    <div class="col-md-12 mb-2">
        <h4><a href="<?= base_url('Dashboard/info_kegiatan/' . $biaya['no_kegiatan']) ?>"><?= $biaya['nama_kegiatan'] ?></a></h4>
        <h4><?= $biaya['tgl_kegiatan'] ?></h4>

        <?php if ($biaya['num_rows'] > 0) { ?>
            <a href="<?= base_url('Report/pdf_biaya_kegiatan/' . $biaya['no_kegiatan']) ?>" target="_blank" class="btn btn-warning">Cetak Laporan Realisasi Biaya Kegiatan</a>
        <?php } ?>
    </div>
    <div class="col-md-12 mb-2">
        <strong>PEMASUKAN</strong>
        <?php $kegiatan = akses('Biaya_kegiatan')->num_rows();
        if ($kegiatan > 0) :
        ?>
            ( <a href="<?= base_url('Biaya_kegiatan/insert_pemasukan/' . $biaya['no_kegiatan']) ?>">Tambahkan Pemasukan</a> )
        <?php endif;
        if (($biaya['jml_data_pemasukan'] > 0)) : ?>
            </br>
            <div class="table-responsive">
                <table class="table table-bordered responsive" width="100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sumber</th>
                            <th>Harga</th>
                            <th>Volume</th>
                            <th>Jumlah</th>
                            <?php if ($kegiatan > 0) : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($biaya['pemasukan'] as $pm) :
                        ?>
                            <tr>
                                <td scope="row" width="50px" align="center"><?= $pm['no_item']; ?>.</td>
                                <td><?= $pm['nama_item'] ?></td>
                                <td align="right"><?= $pm['harga'] ?></td>
                                <td align="center"><?= $pm['volume'] ?></td>
                                <td align="right"><?= $pm['jumlah'] ?></td>
                                <?php if ($kegiatan > 0) : ?>
                                    <td>
                                        <a href="<?= base_url('Biaya_kegiatan/del_item/' . $pm['id_biaya']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin anda akan menghapus <?= $pm['nama_item'] ?>')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        endforeach; ?>
                        <tr>
                            <td colspan="4" align="center"><b>JUMLAH</b></td>
                            <td align="right">
                                <?= $biaya['total_pemasukan'] ?>
                            </td>
                            <?php if ($kegiatan > 0) : ?>
                                <td>--</td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else : echo '(Belum Ditambahkan)';
        endif; ?>
    </div>
    <div class="col-md-12">
        <strong>PENGELUARAN</strong>
        <?php if ($kegiatan > 0) : ?>
            ( <a href="<?= base_url('Biaya_kegiatan/insert_pengeluaran/' . $biaya['no_kegiatan']) ?>">Tambahkan Pengeluaran</a> )
        <?php endif;
        if ($biaya['jml_data_pengeluaran'] > 0) : ?>
            </br>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Rincian</th>
                            <th>Harga/unit</th>
                            <th>Volume</th>
                            <th>Jumlah</th>
                            <?php if ($kegiatan > 0) : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no2 = 1;
                        $jumlah = 0;
                        foreach ($biaya['pengeluaran'] as $pk) :
                        ?>
                            <tr>
                                <td scope="row" width="50px" align="center"><?= $pk['no_item']; ?>.</td>
                                <td><?= $pk['nama_item'] ?></td>
                                <td align="right"><?= $pk['harga'] ?></td>
                                <td align="center"><?= $pk['volume'] ?></td>
                                <td align="right"><?= $pk['jumlah'] ?></td>
                                <?php if ($kegiatan > 0) : ?>
                                    <td>
                                        <a href="<?= base_url('Biaya_kegiatan/del_item/' . $pk['id_biaya']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin anda akan menghapus <?= $pk['nama_item'] ?>')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" align="center"><b>JUMLAH</b></td>
                            <td align="right">
                                <?= $biaya['total_pengeluaran'] ?>
                            </td>
                            <?php if ($kegiatan > 0) : ?>
                                <td>--</td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else : echo '(Belum Ditambahkan)';
        endif; ?>
    </div>
</div>