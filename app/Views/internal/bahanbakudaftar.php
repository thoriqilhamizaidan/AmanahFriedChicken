<?= $this->extend('internal/templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="<?= base_url('internal/bahanbakutambah') ?>" class="btn btn-primary my-3">Tambah Data</a>
            <h1 class="mt-2">Daftar Bahan Baku</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>
            <table class="table table-bordered" id="myTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Bahan Baku</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bahanbaku as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->namabahanbaku; ?></td>
                            <td><?= $row->stok; ?></td>
                            <td>
                                <a href="<?= base_url('internal/bahanbakuedit/' . $row->idbahanbaku) ?>" class="btn btn-warning m-1">Edit</a>
                                <a href="<?= base_url('internal/bahanbakuhapus/' . $row->idbahanbaku) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>