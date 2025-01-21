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

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('errors'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Sukses!</h5>
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

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
                    <button type="button" title="Edit" class="btn btn-sm btn-info" onclick="edit('<?= ($row['barang_kode']) ?>')">
                        <i class="fas fa-edit"></i>
                    </button>

                    <form method="POST" action="/barang/hapus/<?= $row['barang_kode'] ?>" style="display: inline;" onsubmit="return hapusData();">
                        <input type="hidden" value="DELETE" name="_method">
                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    function edit(kode) {
        window.location.href = ('/barang/edit/' + kode);
    }

    function hapusData() {
        pesan = confirm('Yakin hapus data');

        if (pesan) {
            return true;
        } else {
            return false;
        }
    }
</script>
<?= $this->endSection() ?>