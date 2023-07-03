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
        foreach ($tagihan->result_array() as $row) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><a href="<?= base_url("Tagihan_anggota/detail/" . $row['no_tg']) ?>">
                        <?= $row['nama_tagihan'] ?>
                    </a>
                </td>
                <td><?= $row['jml_tagihan'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td><?= $row['expired_at'] ?></td>
                <td>
                    <a href="<?= base_url('Tagihan/e_tg/' . $row['no_tg']) ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= base_url('Tagihan/delete/' . $row['no_tg']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus tagihan <?= $row['nama_tagihan'] ?> ini?')">
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