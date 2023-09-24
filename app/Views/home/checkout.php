<?= $this->extend('home/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Checkout</h2>
            </div>
            <div class="col-md-12">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-number">No</th>
                                <th class="product-name">Produk</th>
                                <th class="product-price">Harga</th>
                                <th class="product-quantity">Jumlah</th>
                                <th class="product-total">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php $totalbelanja = 0; ?>
                            <?php if (!empty($_SESSION['keranjang'])) { ?>
                                <?php foreach ($keranjang as $id_produk => $jumlah) : ?>
                                    <?php $produkModel = new \App\Models\ProdukModel();
                                    $produk = $produkModel->where('id_produk', $id_produk)->first();
                                    $totalharga = $produk['harga_produk'] * $jumlah; ?>
                                    <tr class="text-center">
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $produk['nama_produk'] ?></td>
                                        <td>Rp. <?= $produk['harga_produk'] ?></td>
                                        <td><?= $jumlah ?></td>
                                        <td>Rp. <?= $totalharga ?></td>
                                    </tr>
                                    <?php $totalbelanja += $totalharga; ?>
                            <?php endforeach;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <form class="col-md-12" method="post" action="/home/doCheckout">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" readonly value="<?= $pengguna['nama'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>No. Handphone Pelanggan</label>
                                <input type="text" readonly value="<?= $pengguna['nohp'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap Pengiriman</label>
                                <input type="hidden" name="totalberatnya" value="">
                                <textarea class="form-control" name="alamatpengiriman" placeholder="Masukkan Alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Kota Pengiriman</label>
                                <select name="kota" class="form-control" required id="Sone" onchange="check()">
                                    <option value="">Pilih Kota</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Bekasi">Bekasi</option>
                                    <option value="Ambil Sendiri">Ambil Sendiri</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" id="dua" name="dua" value="<?php echo $totalbelanja ?>">
                            <div class="form-group">
                                <label>Ongkir Pengiriman</label>
                                <input class="form-control" name="ongkir" type="number" readonly required id="res">
                            </div>
                            <div class="form-group">
                                <label>Total Belanja + Ongkir</label>
                                <input class="form-control" id="result" required readonly type="number">
                            </div>
                            <button class="btn btn-danger pull-right btn-lg" name="checkout">Checkout</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function check() {
            var val = document.getElementById('Sone').value;
            if (val == 'Ambil Sendiri') {
                document.getElementById('res').value = "0";
            } else if (val == 'Jakarta') {
                document.getElementById('res').value = "15000";
            }  else if (val == 'Bekasi') {
                document.getElementById('res').value = "10000";
            } 
            var num1 = document.getElementById("res").value;
            var num2 = document.getElementById("dua").value;
            result = parseInt(num1) + parseInt(num2);
            document.getElementById("result").value = result;
        }
    </script>
    <?= $this->endSection(); ?>