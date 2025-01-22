<table class="table table-sm table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama barang</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>#</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $nomor = 1;
        foreach ($dataTemp->getResultArray() as $row) :
        ?>

        <tr>
            <td><?= $nomor++; ?></td>
            <td><?= $row['barang_kode'] ?></td>
            <td><?= $row['barang_nama'] ?></td>
            <td><?= $row['barang_harga'] ?></td>
            <td><?= $row['barang_harga'] ?></td>
        </tr>

        <?php endforeach ?>
    </tbody>
</table>