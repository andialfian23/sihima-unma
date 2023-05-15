<?php
$post = akses('Post');
if ($post->num_rows() > 0) {
?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Post') ?>">Buat Postingan</a>
<?php }
if ($tampil->num_rows() > 0) :
?>
    <table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <?php
                if ($post->num_rows() > 0) {
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
            foreach ($tampil->result_array() as $t) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><a target="_blank" href="<?= base_url("HM/post/" . $t['slug']) ?>">
                            <?= $t['judul'] ?>
                        </a>
                    </td>
                    <td><?= $t['nama_kategori'] ?></td>
                    <?php
                    if ($post->num_rows() > 0) {
                    ?>
                        <td>
                            <?php if ($t['is_published'] == '1') { ?>
                                <a href="<?= base_url('Post/is_published/0/' . $t['id_post']) ?>" class="btn btn-info btn-sm mb-1">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                            <?php } else { ?>
                                <a href="<?= base_url('Post/is_published/1/' . $t['id_post']) ?>" class="btn btn-danger btn-sm mb-1">
                                    <i class="fas fa-minus-circle"></i>
                                </a>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?= base_url('Post/e_post/' . $t['id_post']) ?>" class="btn btn-info btn-sm mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= base_url('Post/del_post/' . $t['id_post']) ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus Postingan <?= $t['judul'] ?> ini?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    <?php }
                    if (akses('Kprodi')->num_rows() > 0) :
                        $author = json_npm($t['id_mahasiswa_pt'])['nm_pd'];
                    ?>
                        <td><?= $t['dilihat'] ?></td>
                        <td><?= $author ?></td>
                    <?php endif; ?>
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
else :
    echo "<h4 class='text-center'>Tidak ada Postingan !!!</h4>";
endif; ?>