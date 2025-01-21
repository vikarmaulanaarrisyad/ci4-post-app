<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
<div class="row">
    ini title
</div>
<?= $this->endSection('title') ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Barang</li>
<?= $this->endSection('breadcrumb') ?>

<?= $this->section('subtitle') ?>
<div class="row">
    ini subtitle
</div>
<?= $this->endSection('subtitle') ?>


<?= $this->section('content') ?>
<div class="row">
    ini content
</div>
<?= $this->endSection('content') ?>