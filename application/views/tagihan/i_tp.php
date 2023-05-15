<div class="row">
    <div class="col-md-12">
        <form action="<?= base_url("Tagihan/p_i_tp/" . $col['no_tg']) ?>" method="post">
            <div class=" table-responsive">
                <p>Nama Tagihan : <?= $col['nama_tagihan'] ?></p>
                <p>Nominal Tagihan : Rp <?= number_format($col['jml_tagihan']) ?></p>
                <table class="table table-bordered ">
                    <tbody class="customtable">
                        <tr>
                            <th>
                                <input type="checkbox" id="mainCheckbox" hidden />
                            </th>
                            <td scope="col"><b>NPM</b></td>
                            <td scope="col"><b>Nama</b></td>
                        </tr>
                        <?php
                        foreach ($tampil['result'] as $t) :
                            $cek_ta = $this->tagihan->get_tg_anggota($col['no_tg'], $t['id_mahasiswa_pt']);
                            if ($cek_ta->num_rows() < 1) {
                        ?>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="listCheckbox" id="listCheckbox" name="id_mhs[]" value="<?= $t['id_mahasiswa_pt'] ?>" checked />
                                    </th>
                                    <td><?= $t['id_mahasiswa_pt'] ?></td>
                                    <td><?= $t['nm_pd'] ?></td>
                                </tr>
                        <?php
                            }
                        endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary btn-block btn-lg">Simpan</button>
            </div>
            <script>
                const a = document.querySelector('#mainCheckbox');
                a.addEventListener('click', function() {
                    document.querySelector('.listCheckbox').checked = true;
                    document.getElementsByTagName()
                });
            </script>
        </form>
    </div>
</div>