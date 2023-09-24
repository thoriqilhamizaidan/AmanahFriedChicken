<?= $this->extend('internal/templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Bahan Baku</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('internal/bahanbakutambah') ?>" method="post">
                        <div class="form-group">
                            <label>Nama Bahan Baku</label>
                            <input type="text" class="form-control" name="namabahanbaku">
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" class="form-control" name="stok" value="0">
                        </div>
                        <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>