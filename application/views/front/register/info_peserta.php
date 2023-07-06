<section class="s-content s-content--top-padding">
    <div class="row narrow d-print-none">

        <div class="col-full s-content__header" data-aos="fade-up">
            <?= $this->session->flashdata('message'); ?>
        </div>

    </div>
    <div class="row entries-wrap wide">
        <div class="entries">
            <div class="col-block d-print-none">

                <div class="alert-box alert-box--info hideit">
                    <p>
                        QRcode dapat digunakan untuk proses presensi di semua kegiatan yang di selenggarakan oleh Himpunan Mahasiswa Universitas Majalengka selagi tidak bersifat <i>online / daring</i>.
                    </p>
                    <i class="fa fa-times alert-box__close"></i>
                </div>
                <div class="alert-box alert-box--notice hideit">
                    <p>
                        Simpan QRcode anda agar tidak hilang !!!<br>
                    </p>
                    <button class="btn btn--primary full-width b-print" type="submit">PDF</button>
                    <i class="fa fa-times alert-box__close"></i>
                </div>
                <script>
                    var b_print = document.querySelector('.b-print');
                    b_print.addEventListener('click', function(n) {
                        window.print();
                    });
                </script>
            </div>
            <article class="col-five col-block">
                <div class="item-entry" data-aos="zoom-in">
                    <div class="item-entry__thumb">

                        <img src="<?= img_qrcode($qrcode) ?>" alt="">

                    </div>
                    <div class="item-entry__text">
                        <div class="item-entry__cat">
                            ID Peserta :
                            <a href="#">
                                <b><?= $col['id_peserta'] ?></b>
                            </a>
                        </div>
                        <p>
                            <strong><?= $col['nama'] ?></strong><br>

                            <?= $col['alamat'] ?><br>
                            <?= $col['email'] ?><br>
                            <?= $col['telp'] ?>
                        </p>
                    </div>
                </div> <!-- item-entry -->
            </article> <!-- end article -->
        </div>
    </div>
</section>