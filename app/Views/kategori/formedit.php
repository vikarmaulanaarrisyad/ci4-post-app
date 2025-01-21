<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Form Edit Kategori
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Kategori</li>
<li class="breadcrumb-item active">Edit</li>
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
<?= form_button('', '<i class="fas fa-backward"></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('kategori') . "')"
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= form_open('kategori/updatedata/' . $id, '', [
    'kategori_id' => $id
]) ?>

<!-- Display error messages if available -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Display success message if available -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="form-group">
    <label for="kategori_nama">Nama Kategori</label>
    <?= form_input('kategori_nama', $kategori_nama, [
        'class' => 'form-control',
        'name' => 'kategori_nama',
        'id' => 'kategori_nama',
        'autofocus' => true,
    ]) ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Update', [
        'class' => 'btn btn-primary'
    ]) ?>
</div>

<?= form_close() ?>
<?= $this->endSection() ?>