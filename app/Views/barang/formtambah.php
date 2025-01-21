<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Form Tambah Barang
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Barang</li>
<li class="breadcrumb-item active">Tambah</li>
<?= $this->endSection('breadcrumb') ?>

<?= $this->section('subtitle') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/barang')">
    <i class="fas fa-backward"> Kembali</i>
</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= form_open_multipart('barang/simpandata') ?>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">Kode Barang</label>
    <div class="col-sm-7">
        <input type="text" name="barang_kode" id="barang_id" class="form-control" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">Nama Barang</label>
    <div class="col-sm-7">
        <input type="text" name="barang_nama" id="barang_id" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">Pilih Kategori</label>
    <div class="col-sm-7">
        <select name="kategori_id" id="kategori_id" class="form-control">
            <option selected disabled>Pilih Kategori</option>

            <?php foreach ($datakategori as $kat) : ?>
                <option value="<?= $kat['id'] ?>"><?= $kat['kategori_nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">Pilih Satuan</label>
    <div class="col-sm-7">
        <select name="satuan_id" id="satuan_id" class="form-control">
            <option selected disabled>Pilih Satuan</option>

            <?php foreach ($datasatuan as $sat) : ?>
                <option value="<?= $sat['id'] ?>"><?= $sat['satuan_nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">Harga</label>
    <div class="col-sm-7">
        <input type="number" name="barang_harga" id="barang_harga" class="form-control" min="0">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">Stok</label>
    <div class="col-sm-7">
        <input type="number" name="barang_stok" id="barang_stok" class="form-control" min="0">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label">Upload Gambar <span class="text-danger text-sm">(<i>Jika Ada</i>)</span></label>
    <div class="col-sm-7">
        <input type="file" name="gambar" id="gambar" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-3 col-form-label"></label>
    <div class="col-sm-7">
        <input type="submit" value="Simpan" class="btn btn-primary">
    </div>
</div>
<?= form_close() ?>

<?= $this->endSection() ?>