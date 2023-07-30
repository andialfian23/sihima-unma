<?= form_error('cash_rule', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

<a class="btn btn-block btn-lg btn-info mb-2" href="#" data-toggle="modal" data-target="#addCashRule">Tambah Peraturan Keuangan</a>

<table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
    <thead>
        <tr>
            <th>No</th>
            <th>Peraturan</th>
            <th>Dibuat</th>
            <th>Diubah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($tampil as $t) {
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $t['cash_rule'] ?></td>
                <td><?= $t['created_at'] ?></td>
                <td><?= $t['updated_at'] ?></td>
                <td>
                    <a href="<?= base_url('Keuangan/del_cr/' . $t['id_cr']) ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus peraturan <?= $t['cash_rule'] ?> ini?')">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="<?= base_url('Keuangan/e_cr/' . $t['id_cr']) ?>" class="btn btn-info btn-sm mb-1">
                        <i class="fa fa-edit"></i>
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
    $(function() {
        $('#dataTables-sihima').DataTable();
    });
</script>

<div class="modal fade" id="addCashRule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Peraturan Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url("Cash_rule/index") ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea class="form-control" name="cash_rule" id="cash_rule" autofocus><?= set_value('cash_rule') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>