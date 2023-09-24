<?= $this->extend('home/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Pembayaran</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong>NO PEMBELIAN: <?= $datapembelian['idbeli'] ?></strong><br>
                Status Barang : <?= $datapembelian['statusbeli'] ?><br>
                Total Pembelian : Rp. <?= number_format($datapembelian['totalbeli']) ?><br>
                Pengiriman : <?= $datapembelian['jenispengiriman'] ?><br>
                Ongkir : Rp. <?= number_format($datapembelian['ongkir']) ?><br>
                Total Bayar : Rp. <?= number_format($datapembelian['totalbeli'] + $datapembelian['ongkir']) ?>
            </div>
            <div class="col-md-6">
                <strong>NAMA : <?= $datapembelian['nama'] ?></strong><br>
                Telepon : <?= $datapembelian['nohp'] ?><br>
                Email : <?= $datapembelian['email'] ?>
                Kota : <?= $datapembelian['kota'] ?><br>
                Alamat Pengiriman : <?= $datapembelian['alamatpengiriman'] ?><br>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="bg-danger text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($dataproduk as $p) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['harga'] ?></td>
                            <td><?= $p['jumlah'] ?></td>
                            <td><?= $p['subharga'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center mb-5 mt-5">
            <div class="col-md-5 my-auto">
                <img width="100%" src="<?= base_url() ?>foto/pembayaran.png">
            </div>
            <div class="col-md-7 my-auto">
                <p>Kirim Bukti Pembayaran</p>
                <b>No Rek :7635107090 </b>
                <br>
                <br>
                <div class="alert alert-info">Total Tagihan Anda : <strong>Rp. <?= number_format($datapembelian['totalbeli'] + $datapembelian['ongkir']) ?><br></strong></div>

                <form method="post" action="/home/pembayaransimpan/<?= $datapembelian['idbeli'] ?>" enctype="multipart/form-data">


                    <div class="form-group">
                        <label>Nama Rekening</label>
                        <input type="text" name="nama" class="form-control" value="<?= $datapembelian['nama'] ?>" required>

                    </div>
                    <div class="form-group">
                        <label>Tanggal Transfer</label>
                        <input type="date" name="tanggaltransfer" class="form-control" value="<?= date('Y-m-d') ?>" required>

                    </div>
                    <div class="form-group">
                        <label>Foto Bukti</label>
                        <input type="file" name="bukti" class="form-control" required>
                    </div>
                    <button class="btn btn-danger float-right" type="submit">Simpan</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>