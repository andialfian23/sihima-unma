<?php
$akses_post = akses('Post');
if ($akses_post->num_rows() > 0) {
?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Post') ?>">Buat Postingan</a>
<?php }
if ($posts->num_rows() > 0) :
?>
    <table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <?php
                if ($akses_post->num_rows() > 0) {
                ?>
                    <th>Publish</th>
                    <th>Aksi</th>
                <?php }
                if (akses('Kprodi')->num_rows() > 0) : ?>
                    <th>Dibaca</th>
                    <th>Pembuat</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($posts->result_array() as $t) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><a target="_blank" href="<?= base_url("HM/post/" . $t['slug']) ?>">
                            <?= $t['judul'] ?>
                        </a>
                    </td>
                    <td><?= $t['nama_kategori'] ?></td>
                    <?php
                    if ($akses_post->num_rows() > 0) {
                    ?>
                        <td>
                            <?php
                            if ($t['is_published'] == '1') {
                                $class_link = 'btn btn-success btn-sm mb-1';
                                $class_icon = 'fas fa-check-circle';
                            } else {
                                $class_link = 'btn btn-danger btn-sm mb-1';
                                $class_icon = 'fas fa-minus-circle';
                            } ?>
                            <a href="#" class="<?= $class_link; ?>" onclick="return publish_post('<?= $t['id_post'] ?>')">
                                <i class="<?= $class_icon; ?>"></i>
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url('Post/e_post/' . $t['id_post']) ?>" class="btn btn-info btn-sm mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm mb-1" onclick="hapus_post('<?= $t['id_post'] ?>','<?= $t['judul'] ?>')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    <?php }
                    if (akses('Kprodi')->num_rows() > 0) :
                    ?>
                        <td><?= $t['dilihat'] ?></td>
                        <td><?= $t['pembuat'] ?></td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script type="text/javascript">
        var base_url_post = "<?= base_url() ?>Post";

        function hapus_post(id_post, nama_post) {
            if (confirm("Apakah anda yakin akan menghapus postingan : " + nama_post + " ?")) {
                $.ajax({
                    url: base_url_post + "/delete",
                    type: 'POST',
                    data: {
                        id_post: id_post
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.kode == '1') {
                            toastr.success(res.pesan);
                        } else {
                            toastr.danger(res.pesan);
                        }
                        setTimeout(function() {
                            window.location.replace("<?= base_url('Pengurus/postinganku') ?>");
                        }, 1000);
                    }
                });
            }
        }

        function publish_post(id_post) {
            $.ajax({
                url: base_url_post + "/is_published",
                type: 'POST',
                data: {
                    id_post: id_post
                },
                dataType: 'json',
                success: function(res) {
                    if (res.kode == '1') {
                        toastr.success(res.pesan);
                    } else {
                        toastr.danger(res.pesan);
                    }
                    setTimeout(function() {
                        window.location.replace("<?= base_url('Pengurus/postinganku') ?>");
                    }, 1000);
                }
            });
        }

        $(function() {
            $('#dataTables-sihima').DataTable({
                language: {
                    url: "<?= base_url('assets/ID.json') ?>",
                }
            });
        });
    </script>

<?php
else :
    echo "<h4 class='text-center'>Tidak ada Postingan !!!</h4>";
endif; ?>