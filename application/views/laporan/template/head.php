<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
        }

        h2 {
            font-size: 18.6px;
        }

        p,
        div,
        #waktu {
            font-size: 16px;
            text-align: justify;
        }

        html {
            background-color: #000;
            width: 794px;
        }

        body {
            background-color: #fff;
            width: 536px;
            margin-right: 113px;
            margin-left: 100px;
            margin-top: 90px;
            margin-bottom: 90px;
        }

        .header tr td {
            text-align: center;
            line-height: 1.5;
        }

        #table,
        #table_no_border {
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

        #table_no_border td {
            border: 1px solid #fff;
            padding: 7px;
            line-height: 0.6cm;
        }

        .keuangan {
            background-color: #fff;
            border-collapse: collapse;
            width: 536px;
        }

        .keuangan td,
        .keuangan th {
            border: 1px solid #000;
            padding-left: 5px;
            padding-right: 5px;
            padding-bottom: 5px;
            padding-top: 5px;
            font-size: 13px;
            line-height: 0.5cm;
        }

        div .header {
            margin-top: -100px;
        }
    </style>
</head>

<body>