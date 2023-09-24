<?= $this->extend('internal/templates/index'); ?>

<?= $this->section('page-content'); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="/internal/tambahproduk" class="btn btn-primary my-3">Tambah Data</a>
            <h1 class="mt-2">Daftar Produk</h1>
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
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Foto Produk</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($produk as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $p['nama_produk']; ?></td>
                                <td><?= $p['nama_kategori']; ?></td>
                                <td><?= $p['harga_produk']; ?></td>
                                <td><?= $p['stok_produk']; ?></td>
                                <td><?= $p['deskripsi_produk']; ?></td>
                                <td><img src="/foto/<?= $p['foto_produk']; ?>" alt="" width="150px"></td>
                                <td>
                                    <a href="/internal/ubahproduk/<?= $p['id_produk'] ?>" class="btn btn-warning m-1">Edit</a>
                                    <a href="/internal/hapusproduk/<?= $p['id_produk'] ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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