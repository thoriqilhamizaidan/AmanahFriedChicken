<?= $this->extend('home/templates/index'); ?>


<?= $this->section('page-content'); ?>



<div class="site-blocks-cover inner-page" style="background-image: url('<?= base_url() ?>/assets/home/images/Fried-Chicken.png'); background-repeat: no-repeat; background-size: cover; background-position: center; background-color: #212529;">
    <div class=" container">
        <div class="row">
            <div class="col-md-5 ml-auto order-md-2 align-self-start">
                <div class="site-block-cover-content">
                    <h2 class="sub-title">Selamat Datang di</h2>
                    <h1>Amanah Fried Chicken</h1>
                    <p><a href="<?= base_url() ?>home/produk" class="btn btn-black rounded-0"> Pesan Sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Produk</h2>
            </div>
        </div>
        <div class="row">
            <?php foreach (array_slice($produk, 0, 3) as $p) : ?>
                <div class="col-lg-4 col-md-6 item-entry mb-4">
                    <a href="<?= base_url() ?>home/detail/<?= $p['id_produk'] ?>" class="product-item md-height bg-gray d-block">
                        <img src="<?= base_url() ?>/foto/<?= $p['foto_produk']; ?>" alt="Image" class="img-fluid">
                    </a>
                    <h2 class="item-title"><a href="<?= base_url() ?>home/detail/<?= $p['id_produk'] ?>"><?= $p['nama_produk']; ?></a></h2>
                    <strong class="item-price">Rp.<?= $p['harga_produk'] ?></strong>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>

<?= $this->endSection(); ?>