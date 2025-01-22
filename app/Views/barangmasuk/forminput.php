<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Input Barang Masuk
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
<li class="breadcrumb-item active">Barang Masuk</li>
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
<button class="btn btn-sm btn-primary" onclick="location.href=('/barangmasuk')"><i class="fas fa-plus-circle"></i> Tambah Barang</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Input Faktur Barang Masuk</label>
        <input type="text" class="form-control" placeholder="No.Faktur" name="faktur" id="faktur">
    </div>
    <div class="form-group col-md-6">
        <label for="">Tanggal Faktur</label>
        <input type="date" class="form-control" placeholder="No.Faktur" name="tglfaktur" id="tglfaktur" value="<?= date('Y-m-d') ?>">
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary">
        Input Barang
    </div>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="">Kode Barang</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Input Kode Barang" name="barang_kode" id="barang_kode">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="tombolCariBarang">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="">Nama Barang</label>
                <input type="text" class="form-control" name="barang_nama" id="barang_nama" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="">Harga Jual</label>
                <input type="number" class="form-control" name="barang_harga" id="barang_harga" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="">Harga Beli</label>
                <input type="number" class="form-control" name="hargabeli" id="hargabeli">
            </div>
            <div class="form-group col-md-1">
                <label for="">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah">
            </div>
            <div class="form-group col-md-1">
                <label for="">Aksi</label>
                <div class="input-group">
                    <button type="button" class="btn btn-sm btn-info mr-1" title="Tambah Item" id="tombolTambahItem">
                        <i class="fas fa-plus-square"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" title="Reload Data" id="tombolReload">
                        <i class="fas fa-sync"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row" id="tampilDataTemp">

        </div>
    </div>
</div>

<script>
    function dataTemp() {
        let faktur = $('#faktur').val();

        $.ajax({
            type: "post",
            url: "/barangmasuk/dataTemp",
            data: {
                faktur: faktur
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('#tampilDataTemp').html(response.data)
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n ' + thrownError);
            }
        })
    }

    $(document).ready(function() {
        dataTemp();
    });
</script>

<?= $this->endsection() ?>