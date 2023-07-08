<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Info Peserta</title>
    <script src="https://hima.unma.ac.id/wordsmith_theme/js/jquery.min.js"></script>
    <style>
        .article {
            width: 250px;
            font-family: "Nunito Sans", sans-serif;
            /*background-color: #ccc;*/
            border: 2px solid #000;
            padding: 3px;
            display: inline-block;
        }

        .info-kegiatan {
            margin-top: 0px;
            margin-left: 10px;
            position: absolute;
            display: inline-block;
            width: 600px;
            font-family: "Nunito Sans", sans-serif;
            /*background-color: #ccc;*/
            padding: 10px;
            border: 2px solid #000;
            overflow-wrap: break-word;
        }

        .item-entry {
            width: 100%;

        }

        .item-entry__thumb img {
            width: 100%;
        }

        .item-entry__text p {
            text-align: center;

        }

        .item-entry__cat {
            text-align: center;
        }

        a {

            text-decoration: none;
        }

        @media print {
            .hilang {
                display: none;
            }
        }
    </style>

</head>

<body>
    <div class="article">
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
                    <strong><?= $col['nama'] ?></strong><br><br>

                    <?= $col['alamat'] ?><br><br>
                    <?= $col['email'] ?><br><br>
                    <?= $col['telp'] ?><br><br>
                    <button class="hilang" type="button">PRINT PDF</button>
                </p>
            </div>
        </div> <!-- item-entry -->
    </div>


    <div class="info-kegiatan">
        <br>

        Link Informasi : <br><br>
        <a href="<?= $link_informasi ?>"><i><?= $link_informasi ?></i></a>

        <br><br>
        <?= $data_link; ?>


    </div>


    <script>
        window.print();

        $(function() {
            $('.hilang').click(function() {
                window.print();
            });
        });
    </script>

</body>

</html>