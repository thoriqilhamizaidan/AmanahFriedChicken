<?= $this->extend('home/templates/index'); ?>

<?= $this->section('page-content'); ?>



<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="item-entry">
                    <a href="#" class="product-item md-height d-block">
                        <img src="<?= base_url() ?>/foto/<?= $dataproduk['foto_produk']; ?>" alt="" class="img-fluid">
                    </a>

                </div>

            </div>
            <div class="col-md-6">
                <h2 class="text-black"><?= $dataproduk['nama_produk'] ?></h2>
                <p><?= $dataproduk['deskripsi_produk'] ?></p>

                <p><strong class="text-primary h4">Rp. <?= $dataproduk['harga_produk'] ?></strong></p>
                <form action="/home/keranjangtambah" method="post">
                    <input type="hidden" name="id_produk" value="<?= $dataproduk['id_produk'] ?>">
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" name="jumlah" value="1" placeholder="" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <p><button type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Masukan ke Keranjang</button></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>