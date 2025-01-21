<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Manajemen Data Barang
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Barang</li>
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
<button class="btn btn-sm btn-primary" onclick="location.href=('/barang/tambah')"><i class="fas fa-plus-circle"></i> Tambah Barang</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Stok</th>
            <th style="width:15%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        foreach ($tampildata->getResultArray() as $row): // Remove the semicolon
        ?>
            <tr>
                <td><?= $nomor++ ?></td>
                <td><?= ($row['barang_kode']) ?></td>
                <td><?= ($row['barang_nama']) ?></td>
                <td><?= ($row['kategori_nama']) ?></td>
                <td><?= ($row['satuan_nama']) ?></td>
                <td><?= number_format($row['barang_harga'], 0) ?></td>
                <td><?= ($row['barang_stok']) ?></td>
                <td>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection() ?>