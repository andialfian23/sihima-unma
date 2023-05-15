<a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Tagihan/i_tg') ?>">Buat Tagihan</a>

<table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tagihan</th>
            <th>Jumlah Tagihan</th>
            <th>Dibuat</th>
            <th>Batas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($tampil->result_array() as $t) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><a href="<?= base_url("Tagihan/tg_pengurus/" . $t['no_tg']) ?>">
                        <?= $t['nama_tagihan'] ?>
                    </a>
                </td>
                <td><?= $t['jml_tagihan'] ?></td>
                <td><?= $t['created_at'] ?></td>
                <td><?= $t['expired_at'] ?></td>
                <td>
                    <a href="<?= base_url('Tagihan/e_tg/' . $t['no_tg']) ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= base_url('Tagihan/del_tg/' . $t['no_tg']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus tagihan <?= $t['nama_tagihan'] ?> ini?')">
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