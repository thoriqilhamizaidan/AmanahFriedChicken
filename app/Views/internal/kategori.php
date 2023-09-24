<?= $this->extend('internal/templates/index'); ?>

<?= $this->section('page-content'); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="/internal/tambahkategori" class="btn btn-primary my-3">Tambah Data</a>
            <h1 class="mt-2">Daftar Kategori</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kategori as $k) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $k['nama_kategori']; ?></td>
                                <td>
                                    <a href="/internal/ubahkategori/<?= $k['id_kategori'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="/internal/hapuskategori/<?= $k['id_kategori'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>