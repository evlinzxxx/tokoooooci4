<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 2px solid #000000;
            text-align: center;
        }
    </style>
</head>

<body>
    <div style="font-size:60px ; color: '#dddd'">
        <i>Invoice</i>
    </div>
    <p>
        <i>Precious Skin Care</i>
        <br>Jakarta, Indonesia
        <br>02223456876
    </p>
    <hr>
    <hr>
    <p>
        Pembeli : <?= $pembeli->username ?><br>
        Alamat : <?= $transaksi->alamat ?><br>
        Transaksi No : <?= $transaksi->id ?><br>
        Tanggal : <?= date('Y-m-d', strtotime($transaksi->created_date)) ?>
    </p>
    <table cellpadding="6">
        <tr>
            <th><strong>Barang</strong></th>
            <th><strong>Harga Satuan</strong></th>
            <th><strong>Jumlah</strong></th>
            <th><strong>Ongkir</strong></th>
            <th><strong>Total Harga</strong></th>
        </tr>
        <tr>
            <td><?= $barang->nama ?></td>
            <td><?= "Rp " . number_format($barang->harga, 2, ',', '.') ?></td>
            <td><?= $transaksi->jumlah ?></td>
            <td><?= "Rp " . number_format($transaksi->ongkir, 2, ',', '.') ?>/item</td>
            <td><?= "Rp " . number_format($transaksi->total_harga, 2, ',', '.') ?></td>
        </tr>
    </table>
</body>

</html>