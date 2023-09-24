<?= $this->extend('internal/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
                </div>
                <div class="card-body">
                    <form action="/internal/simpanproduk" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Kategori Produk</label>
                            <select class="form-control" name="id_kategori">
                                <option value="" selected="true" disabled="disabled">Pilih Kategori</option>
                                <?php foreach ($kategori as $key => $value) : ?>

                                    <option value="<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></option>

                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga Produk</label>
                            <input type="number" min="0" class="form-control" name="harga_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Stok Produk</label>
                            <input type="number" min="0" class="form-control" name="stok_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <input type="text" class="form-control" name="deskripsi_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Foto Produk</label>
                            <div class="custom-file" style="margin-bottom: 10px;">
                                <input type="file" class="form-control" name="foto_produk">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>