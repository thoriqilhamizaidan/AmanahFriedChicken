
<?= $this->extend('home/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Keranjang</h2>
            </div>
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-number">No</th>
                                <th class="product-thumbnail">Foto Produk</th>
                                <th class="product-name">Produk</th>
                                <th class="product-price">Harga</th>
                                <th class="product-quantity">Jumlah</th>
                                <th class="product-total">Total Harga</th>
                                <th class="product-remove">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if (!empty($_SESSION['keranjang'])) { ?>
                                <?php foreach ($keranjang as $id_produk => $jumlah) : ?>
                                    <?php $produkModel = new \App\Models\ProdukModel();
                                    $produk = $produkModel->where('id_produk', $id_produk)->first();
                                    $totalharga = $produk['harga_produk'] * $jumlah; ?>

                                    <tr class="text-center">
                                        <th scope="row"><?= $i++ ?></th>
                                        <td class="product-thumbnail"> <img src="<?= base_url() ?>/foto/<?= $produk['foto_produk']; ?>" alt="" class="img-fluid"></td>
                                        <td><?= $produk['nama_produk'] ?></td>
                                        <td>Rp. <?= $produk['harga_produk'] ?></td>
                                        <td><?= $jumlah ?></td>
                                        <td>Rp. <?= $totalharga ?></td>

                                        <td><a href="/home/keranjanghapus/<?= $produk['id_produk'] ?>" class="btn btn-primary height-auto btn-sm">X</a></td>
                                    </tr>


                            <?php endforeach;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </form>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button class="btn btn-outline-primary btn-sm btn-block" onclick="window.location='/home/produk'">Lanjut Belanja</button>
                    </div>
                    <div class="col-md-6">

                        <button class="btn btn-primary btn-lg btn-block" onclick="window.location='/home/checkout'">Proses Checkout</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>