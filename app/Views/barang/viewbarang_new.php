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
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Filter Kategori</label>
            <select name="kategori" id="kategori" class="form-control form-control-sm">
                <option value="">Pilih</option>
                <?php foreach ($datakategori as $kat): ?>
                    <option value="<?= $kat['id'] ?>"><?= $kat['kategori_nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>
</div>
<table class="table table-striped table-bordered" id="databarang" style="width:100%">
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th style="width:15%">Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
    $(document).ready(function() {
        table = $('#databarang').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/barang/listData',
                data: function(d) {
                    d.kategori = $('#kategori').val()
                }
            },
            order: [],
            columns: [{
                    data: 'no',
                },
                {
                    data: 'barang_kode'
                },
                {
                    data: 'barang_nama'
                },
                {
                    data: 'kategori_nama'
                },
                {
                    data: 'barang_harga'
                },
                {
                    data: 'barang_stok'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ],
        });
    });

    $('#kategori').change(function(e) {
        e.preventDefault();
        table.ajax.reload();
    });

    function edit(kode) {
        window.location.href = ('/barang/edit/' + kode);
    }

    function hapus(kode) {
        Swal.fire({
            title: "Hapus Barang?",
            html: `Yakin data barang dengan kode <strong>${kode}</strong> di hapus?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus data!",
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform AJAX request to delete the data
                $.ajax({
                    url: `/barang/hapus/${kode}`, // Update the URL to match your backend route
                    type: "GET",
                    success: function(response) {
                        // Show success alert
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message || "Data berhasil dihapus.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 3000,
                        }).then(() => {
                            // Optionally reload the table or refresh the page
                            table.ajax.reload(); // Refresh the page to see the changes
                        });
                    },
                    error: function(xhr) {
                        // Show error alert
                        Swal.fire({
                            title: "Error!",
                            text: xhr.responseJSON?.message || "Terjadi kesalahan saat menghapus data.",
                            icon: "error",
                        });
                    },
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>