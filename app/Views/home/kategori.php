<?= $this->extend('home/templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Kategori : <?= $datakategori['nama_kategori'] ?></h2>
            </div>
        </div>
        <?php if (empty($dataproduk)) : ?>
            <div class="alert alert-danger">Produk <strong><?= $datakategori["nama_kategori"] ?></strong> Kosong</div>
        <?php else : ?>
            <div class="row">
                <?php foreach ($dataproduk as $p) : ?>
                    <div class="col-lg-4 col-md-6 item-entry mb-4">
                        <a href="<?= base_url() ?>home/detail/<?= $p['id_produk'] ?>" class="product-item md-height bg-gray d-block">
                            <img src="<?= base_url() ?>/foto/<?= $p['foto_produk']; ?>" alt="Image" class="img-fluid">
                        </a>
                        <h2 class="item-title"><a href="<?= base_url() ?>home/detail/<?= $p['id_produk'] ?>"><?= $p['nama_produk']; ?></a></h2>
                        <strong class="item-price">Rp.<?= $p['harga_produk'] ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection(); ?>