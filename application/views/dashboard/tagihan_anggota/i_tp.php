<div class="row">
    <div class="col-md-12">
        <!-- <form action="<?= base_url("Tagihan_anggota/p_i_tp/" . $tagihan['no_tg']) ?>" method="post"> -->
        <div class=" table-responsive">
            <p>Nama Tagihan : <?= $tagihan['nama_tagihan'] ?></p>
            <p>Nominal Tagihan : Rp <?= number_format($tagihan['jml_tagihan']) ?></p>
            <table class="table table-bordered ">
                <tbody class="customtable">
                    <tr>
                        <th>
                            <input type="checkbox" id="mainCheckbox" />
                        </th>
                        <td scope="col"><b>NPM</b></td>
                        <td scope="col"><b>Nama</b></td>
                    </tr>
                    <?php
                    foreach ($penguruss as $row) :
                    ?>
                        <tr>
                            <th>
                                <input type="checkbox" class="listCheckbox cb_pengurus" id="listCheckbox" name="id_mhs[]" value="<?= $row['id_mahasiswa_pt'] ?>" />
                            </th>
                            <td><?= $row['id_mahasiswa_pt'] ?></td>
                            <td><?= $row['nm_pd'] ?></td>
                        </tr>
                    <?php
                    endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary btn-block btn-lg" id="btn_simpan">Simpan</button>
        </div>

        <!-- </form> -->

        <script>
            $('#mainCheckbox').on('click', function() {
                if ($(this).is(':checked')) {
                    $('.cb_pengurus').prop('checked', true);
                } else {
                    $('.cb_pengurus').prop('checked', false);
                }
            });
        </script>
    </div>
</div>