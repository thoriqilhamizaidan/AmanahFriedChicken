<?= $this->extend('internal/templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="<?= base_url('internal/laporanstokbahanbakudaftarcetak') ?>" target="_blank" class="btn btn-success my-3">Download Laporan</a>
            <h1 class="mt-2"><?= $title ?></h1>
            <table class="table table-bordered" id="myTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Bahan Baku</th>
                        <th scope="col">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bahanbaku as $row) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $row->namabahanbaku; ?></td>
                            <td><?= $row->stok; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>