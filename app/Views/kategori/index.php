<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Manajemen Data Kategori
<?= $this->endSection('title') ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Kategori</li>
<?= $this->endSection('breadcrumb') ?>

<?= $this->section('subtitle') ?>
<?= form_button('', '<i class="fas fa-plus-circle"></i> Tambah Data', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('kategori/formtambah') . "')"
]) ?>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Sukses!</h5>
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('errors'); ?>
    </div>
<?php endif; ?>

<?= form_open('/kategori/index') ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari data kategori" name="cari" value="<?= $cari ?>">
    <div class="input-group-append">
        <button class="btn btn-outline-primary" type="submit" id="tombolcari" name="tombolcari"><i class="fas fa-search"></i></button>
    </div>
</div>
<?= form_close() ?>

<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th>Nama Kategori</th>
            <th style="width:15%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1 + (($noHalaman - 1) * 5);
        foreach ($tampilData as $row): // Remove the semicolon
        ?>
            <tr>
                <td><?= $nomor++ ?></td>
                <td><?= esc($row['kategori_nama']) ?></td> <!-- Use esc() to prevent XSS -->
                <td>
                    <button class="btn btn-info" title="Edit Data" onclick="editData('<?= $row['id'] ?>')"><i class="fas fa-edit"></i></button>

                    <form method="POST" action="/kategori/hapus/<?= $row['id'] ?>" style="display: inline;" onsubmit="hapusData();">
                        <input type="hidden" value="DELETE" name="_method">
                        <button type="submit" class="btn btn-danger" title="Hapus Data"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div class="float-center">
    <?= $pager->links('kategori', 'paging'); ?>
</div>

<script>
    function editData(id) {
        window.location.href = ('/kategori/formedit/' + id);
    }

    function hapusData() {
        const pesan = confirm('Yakin data kategori dihapus?');
        return pesan; // Form hanya dikirim jika pengguna menekan OK
    }
</script>


<?= $this->endSection() ?>