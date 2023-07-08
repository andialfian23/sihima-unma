<section class="s-content s-content--top-padding">
    <div class="row narrow">

        <div class="col-full s-content__header" data-aos="fade-up">
            <?= $this->session->flashdata('message'); ?>
        </div>

    </div>

    <form action="<?= base_url('Register') ?>" method="POST">
        <div class="row">
            <div class="col-five tab-full">

                <div class="alert-box alert-box--notice hideit">
                    <ul>
                        <li>
                            Gunakan <b>Email</b> dan <b>Nomor Telepon</b> yang aktif pada form Registrasi.
                        </li>
                        <li>
                            * Bagian yang wajib diisi.
                        </li>
                    </ul>
                </div>
                <div class="alert-box alert-box--success hideit">
                    <ul>
                        <li>
                            - Anda akan mendapatkan QRcode dan akan ditampilkan dilayar setelah berhasil melakukan registrasi.
                        </li>
                        <li>
                            - QRcode anda juga akan dikirim melalui email yang anda inputkan !!!
                        </li>
                        <li>
                            - QRcode dapat digunakan untuk absensi pada kegiatan yang diselenggarakan oleh Himpunan Mahasiswa Universitas Majalengka.
                        </li>
                    </ul>
                </div>
                <div class="alert-box alert-box--info hideit">
                    <ul>
                        <li>
                            - Jika kegiatan yang diikuti dilaksanakan secara online /hybrid maka
                            Link presensi akan dikirim melalui alamat email yang anda inputkan.
                        </li>

                        <li>
                            - Link tersebut, akan digunakan untuk melakukan proses presensi peserta Dan akan berfungsi ketika sudah waktunya proses presensi.
                        </li>
                        <li>
                            - Setelah proses registrasi selesai, cetak PDF informasi peserta
                            (untuk meminimalisir ketika link presensi tidak terkirim ke alamat email yang anda inpputkan).
                            Pada PDF tersebut, selain menampilkan informasi peserta terdapat link untuk melakukan proses presensi kegiatan.

                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-six tab-full">
                <h3 class="text-center display-1 display-1--with-line-sep">Form Registrasi</h3>

                <div>
                    <label for="email">*Email</label>
                    <input name="email" class="full-width" type="text" placeholder="hima@gmail.com" id="email">
                    <?= form_error('email', '<div class="col-twelve"><small class="text-danger">', '</small></div>') ?>
                </div>
                <div>
                    <label for="nama">*Nama Lengkap</label>
                    <input name="nama" class="full-width" type="text" placeholder="RADHS" id="nama">
                    <?= form_error('nama', '<div class="col-twelve"><small class="text-danger">', '</small></div>') ?>
                </div>
                <div>
                    <label for="alamat">*Alamat</label>
                    <input name="alamat" class="full-width" type="text" placeholder="Jl.Pangeran Muhamad - Majalengka" id="alamat">
                    <?= form_error('alamat', '<div class="col-twelve"><small class="text-danger">', '</small></div>') ?>
                </div>
                <div>
                    <label for="asal_sekolah">Asal Sekolah</label>
                    <input name="asal_sekolah" class="full-width" type="text" id="asal_sekolah">
                    <?= form_error('asal_sekolah', '<div class="col-twelve"><small class="text-danger">', '</small></div>') ?>
                </div>
                <div>
                    <label for="telp">*Nomor Telepon</label>
                    <input name="telp" class="full-width" type="text" placeholder="0811111111" id="telp">
                    <?= form_error('telp', '<div class="col-twelve"><small class="text-danger">', '</small></div>') ?>
                </div>
                <!-- <div class="">
                    <label>Kegiatan</label>
                    <div class="cl-custom-select">
                        <select class="full-width" id="kegiatan">
                            <option value="Option 1">Questions</option>
                            <option value="Option 2">Report</option>
                            <option value="Option 3">Others</option>
                        </select>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-full">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <?php if ($kegiatan->num_rows() > 0) : ?>
                            <table class="table responsive table-bordered table-sm" <?= ($kegiatan->num_rows() > 5) ? 'id="dataTable"' : ''; ?> width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>--</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Waktu</th>
                                        <th>Tempat</th>
                                        <th>Penyelenggara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kegiatan->result_array() as $t) :
                                        if ($t['mulai'] != null) :
                                            $mulai = $t['mulai'];
                                            $selesai = $t['selesai'];
                                            $pelaksanaan = waktu_pelaksanaan($mulai, $selesai);
                                            $waktu = $pelaksanaan['tanggal'];
                                        else :
                                            $waktu = $t['tgl_kegiatan'];
                                        endif;
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="listCheckbox" id="listCheckbox" name="no_kg[]" value="<?= $t['no_kegiatan'] ?>" checked />
                                            </td>
                                            <td><?= $t['nama_kegiatan'] ?></td>
                                            <td>
                                                <?= $waktu; ?>
                                            </td>
                                            <td><?= $t['tempat'] ?></td>
                                            <td><?= $t['singkatan'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-full">
                <div class="col-md-12">
                    <input class="btn--primary full-width mt-2" type="submit" value="Submit" <?= ($kegiatan->num_rows() < 1) ? 'disabled' : ''; ?>>
                </div>
            </div>
        </div>
    </form>

</section> <!-- end styles -->