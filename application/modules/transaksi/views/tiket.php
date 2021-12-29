<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .tiket {
            width: 17cm;
            height: 5cm;
            margin: 10mm auto;
            border: 5px black;
            border-radius: 5px;
            /* background: red; */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .td {
            width: 150px;
        }
    </style>
</head>

<body onload="window.print();">
    <div class="tiket">
        <h3 style="text-align:center">TIKET MASUK</h3>
        <table>
        </table>
        <table class="table">
            <tr>
                <td style="width: 100px;">Nama</td>
                <td>:</td>
                <td class="td"><?= $detail->nama; ?></td>

                <td style="width: 100px;">Alamat</td>
                <td>:</td>
                <td><?= $detail->alamat; ?></td>
            </tr>
            <tr>
                <td>No HP </td>
                <td>:</td>
                <td><?= $detail->nohp; ?></td>

                <td>Jumlah Orang</td>
                <td>:</td>
                <td><?= $detail->jumlah; ?></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td>Rp. <?= number_format($detail->harga, 2, ',', '.'); ?></td>

                <td>Hari Tanggal</td>
                <td>:</td>
                <td><?= date('d F Y / H:i:s a', $detail->time); ?></td>
            </tr>

        </table>

    </div>
</body>

</html>