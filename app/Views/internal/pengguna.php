<?= $this->extend('internal/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="/internal/tambahpengguna" class="btn btn-primary my-3">Tambah Data</a>
            <h1 class="mt-2">Daftar Pengguna</h1>
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
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No. HP</th>
                            <th scope="col">Level</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pengguna as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $p['nama']; ?></td>
                                <td><?= $p['email']; ?></td>
                                <td><?= $p['nohp']; ?></td>
                                <td><?= $p['level']; ?></td>
                                <td>
                                    <a href="/internal/ubahpengguna/<?= $p['idpengguna'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="/internal/hapuspengguna/<?= $p['idpengguna'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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