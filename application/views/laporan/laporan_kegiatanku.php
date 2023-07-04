<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        h2 {
            font-size: 18.6px;
        }

        p,
        div,
        #waktu {
            font-size: 12pt;
            /* 16px = 12pt */
            text-align: justify;
        }

        html {
            margin-top: 56px;
            margin-bottom: 56px;
            margin-right: 56px;
            margin-left: 56px;
        }

        .header tr td {
            text-align: center;
            line-height: 1.5;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
        }


        #table td,
        #table th {
            border: 1px solid #000;
            padding: 8px;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }

        h4 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h4>DAFTAR KEGIATAN HIMPUNAN YANG DIIKUTI</h4>
    <h4><?= $_SESSION['nama_fak'] ?></h4>
    <h4><?= $_SESSION['nama_prodi'] ?></h4>
    <br>
    <table border="0">
        <tr>
            <td>
                NPM
            </td>
            <td>
                : <?= $_SESSION['id_mahasiswa_pt'] ?>
            </td>
        </tr>
        <tr>
            <td>
                Nama Lengkap
            </td>
            <td>
                : <?= $_SESSION['nama'] ?>
            </td>
        </tr>
        <tr>
            <td>
                Program Studi
            </td>
            <td>
                : <?= $_SESSION['nama_prodi'] ?>
            </td>
        </tr>
    </table>
    <br>
    <table id="table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Sebagai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($tampil->result_array() as $t) :
            ?>
                <tr>
                    <td scope="row" align="center"><?= $no; ?></td>
                    <td><?= date_id($t['tgl_kegiatan']) ?></td>
                    <td><?= $t['nama_kegiatan'] ?></td>
                    <td align="center"><?= $t['sebagai'] ?></td>
                    <td align="center"><?= $t['status'] ?></td>
                </tr>
            <?php $no++;
            endforeach; ?>
        </tbody>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td width="65%">&nbsp;</td>
            <td width="35%" align="center">
                Ketua Himpunan,
                <br><br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td align="center">TTD<br><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"> (<b><?= $kahim ?></b>)</td>
        </tr>
    </table>

</body>

</html>