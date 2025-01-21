<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Form Edit Barang
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Barang</li>
<li class="breadcrumb-item active">Edit</li>
<?= $this->endSection('breadcrumb') ?>

<?= $this->section('subtitle') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/barang')">
    <i class="fas fa-backward"> Kembali</i>
</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Sukses!</h5>
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?= form_open_multipart('/barang/updatedata') ?>
<div class="form-group row">
    <label for="barang_kode" class="col-sm-3 col-form-label">Kode Barang</label>
    <div class="col-sm-7">
        <input type="text" name="barang_kode" id="barang_kode" class="form-control <?= session('errors.barang_kode') ? 'is-invalid' : '' ?>" value="<?= old('barang_kode', $barang_kode) ?>" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="barang_nama" class="col-sm-3 col-form-label">Nama Barang</label>
    <div class="col-sm-7">
        <input type="text" name="barang_nama" id="barang_nama" class="form-control <?= session('errors.barang_nama') ? 'is-invalid' : '' ?>" value="<?= old('barang_nama', $barang_nama) ?>">
    </div>
</div>
<div class="form-group row">
    <label for="kategori_id" class="col-sm-3 col-form-label">Pilih Kategori</label>
    <div class="col-sm-7">
        <select name="kategori_id" id="kategori_id" class="form-control <?= session('errors.kategori_id') ? 'is-invalid' : '' ?>">
            <option selected disabled>Pilih Kategori</option>
            <?php foreach ($datakategori as $kat) : ?>
                <option value="<?= $kat['id'] ?>" <?= old('kategori_id', $kategori_id) == $kat['id'] ? 'selected' : '' ?>><?= $kat['kategori_nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="satuan_id" class="col-sm-3 col-form-label">Pilih Satuan</label>
    <div class="col-sm-7">
        <select name="satuan_id" id="satuan_id" class="form-control <?= session('errors.satuan_id') ? 'is-invalid' : '' ?>">
            <option selected disabled>Pilih Satuan</option>
            <?php foreach ($datasatuan as $sat) : ?>
                <option value="<?= $sat['id'] ?>" <?= old('satuan_id', $satuan_id) == $sat['id'] ? 'selected' : '' ?>><?= $sat['satuan_nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="barang_harga" class="col-sm-3 col-form-label">Harga</label>
    <div class="col-sm-7">
        <input type="number" name="barang_harga" id="barang_harga" class="form-control <?= session('errors.barang_harga') ? 'is-invalid' : '' ?>" value="<?= old('barang_harga', $barang_harga) ?>" min="0">
    </div>
</div>
<div class="form-group row">
    <label for="barang_stok" class="col-sm-3 col-form-label">Stok</label>
    <div class="col-sm-7">
        <input type="number" name="barang_stok" id="barang_stok" class="form-control <?= session('errors.barang_stok') ? 'is-invalid' : '' ?>" value="<?= old('barang_stok', $barang_stok) ?>" min="0">
    </div>
</div>
<div class="form-group row">
    <label for="gambar" class="col-sm-3 col-form-label">Gambar Barang <span class="text-danger text-sm">(<i>Opsional</i>)</span></label>
    <div class="col-sm-7">
        <?php if (!empty($barang_gambar)) : ?>
            <div class="mb-3">
                <img src="<?= base_url($barang_gambar) ?>" alt="Gambar Barang" class="img-thumbnail" style="max-width: 200px;">
            </div>
        <?php endif; ?>
        <input type="file" name="gambar" id="gambar" class="form-control <?= session('errors.gambar') ? 'is-invalid' : '' ?>">
    </div>
</div>

<!-- <div class="form-group row">
    <label for="gambar" class="col-sm-3 col-form-label">Upload Gambar <span class="text-danger text-sm">(<i>Jika Ada</i>)</span></label>
    <div class="col-sm-7">
        <input type="file" name="gambar" id="gambar" class="form-control <?= session('errors.gambar') ? 'is-invalid' : '' ?>">
    </div>
</div> -->
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label"></label>
    <div class="col-sm-7">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>
</div>
<?= form_close() ?>

<?= $this->endSection() ?>