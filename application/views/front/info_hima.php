<section class="s-content s-content--top-padding">
    <div class="row container-fluid">

        <input type="radio" name="tab-menu" class="tab-menu-radio" id="tab-menu1" checked />
        <label for="tab-menu1" class="tab-menu">Profil Himpunan</label>

        <input type="radio" name="tab-menu" class="tab-menu-radio" id="tab-menu2" />
        <label for="tab-menu2" class="tab-menu">Anggota Pengurus</label>

        <div class="tab-content">

            <div class="tab tab-1">
                <div class="row">

                    <div class="col-two tab-full text-center">
                        <img src="<?= base_url('images/logo/' . $col['logo']) ?>" alt="" width="150px">
                    </div>

                    <div class="col-five tab-full">
                        <table class="table table-sm table-borderless" width="100%">
                            <tbody>
                                <tr>
                                    <td>Singkatan</td>
                                    <th><?= $col['singkatan'] ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Himpunan</td>
                                    <th><?= $col['nama_hima'] ?></th>
                                </tr>
                                <tr>
                                    <td>Periode Sekarang</td>
                                    <th><?= $col['periode'] ?></th>
                                </tr>
                                <tr>
                                    <td>Ketua Himpunan</td>
                                    <th><?= $col['ketua_himpunan'] ?></th>
                                </tr>
                                <tr>
                                    <td>Jumlah Pengurus</td>
                                    <th><?= $col['jml_pengurus'] ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-five tab-full">
                        <table class="table table-sm table-borderless" width="100%">
                            <tr>
                                <td width="50%">Sekretariat</td>
                                <th><?= $col['tempat_sekre'] ?></th>
                            </tr>
                            <tr>
                                <td width="50%">Contact Person</td>
                                <th>
                                    <?php
                                    if ($col['contact_person'] != 'Belum Ditambahkan') :
                                        foreach ($col['contact_person'] as $cp) {
                                            echo $cp['no_telp'] . ' (' . $cp['nama'] . ') <br>';
                                        }
                                    endif;
                                    ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab tab-2 d-none">
                <?php if ($anggota['num_rows'] > 0) : ?>
                    <table class="table2 table-borderless table-sm">
                        <tbody>
                            <tr>
                                <td>Ketua Himpunan</td>
                                <td>: <?= $col['ketua_himpunan'] ?></td>
                            </tr>
                            <?php foreach ($anggota['result'] as $t) :
                                if ($t['jabatan'] != 'Ketua Himpunan') :
                            ?>
                                    <tr>
                                        <td><?= $t['jabatan'] ?></td>
                                        <td>: <?= $t['nm_pd'] ?></td>
                                    </tr>
                            <?php endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                <?php else :
                    echo 'Anggota Belum Ditentukan';
                endif; ?>
            </div>

        </div>
        <script>
            const tab_menu1 = document.querySelector('#tab-menu1');
            const tab_menu2 = document.querySelector('#tab-menu2');
            const tab1 = document.querySelector('.tab-1');
            const tab2 = document.querySelector('.tab-2');
            tab_menu1.addEventListener('click', function() {
                tab2.classList.add('d-none');
                tab1.classList.remove('d-none');
            });
            tab_menu2.addEventListener('click', function() {
                tab1.classList.add('d-none');
                tab2.classList.remove('d-none');
            });
        </script>
    </div>

</section>