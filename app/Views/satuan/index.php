<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
<div class="row">
    ini title
</div>
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Satuan</li>
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
<div class="row">
    ini subtitle
</div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="row">
    ini content
</div>
<?= $this->endSection() ?>