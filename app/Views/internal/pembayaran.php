<?= $this->extend('internal/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Pembelian</h3>
                            <hr>
                            <strong>NO PEMBELIAN: <?= $datapembelian['idbeli'] ?></strong><br>
                            Tanggal : <?= tanggal($datapembelian['tanggalbeli']) ?><br>
                            Status : <strong><?= $datapembelian['statusbeli'] ?></strong><br>
                            Total Pembelian : <?= rupiah($datapembelian['totalbeli']) ?><br>
                            Pengiriman : <?= $datapembelian['jenispengiriman'] ?><br>
                            Ongkir : <?= rupiah($datapembelian['ongkir']) ?><br>
                            Total Bayar : <?= rupiah($datapembelian['totalbeli'] + $datapembelian['ongkir']) ?>
                        </div>
                        <div class="col-md-6">
                            <h3>Pelanggan</h3>
                            <hr>
                            <strong>NAMA : <?= $datapembelian['nama'] ?></strong><br>
                            Telepon : <?= $datapembelian['nohp'] ?><br>
                            Email : <?= $datapembelian['email'] ?><br>
                            Kota : <?= $datapembelian['kota'] ?><br>
                            Alamat Pengiriman : <?= $datapembelian['alamatpengiriman'] ?><br>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered">
                        <thead>
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
                                    <td><?= rupiah($p['harga']) ?></td>
                                    <td><?= $p['jumlah'] ?></td>
                                    <td><?= rupiah($p['subharga']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">

                <?php if ($datapembelian['statusbeli'] != "Selesai") { ?>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Konfirmasi</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <th>Nama</th>
                                                <th><?= $databayar['nama'] ?></th>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Transfer</th>
                                                <th><?= date("d-m-Y", strtotime($databayar['tanggaltransfer'])) ?></th>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Upload Bukti Pembayaran</th>
                                                <th><?= date("d-m-Y", strtotime($databayar['tanggal'])) ?></th>
                                            </tr>
                                        </table>
                                        <form method="post" action="/internal/pembayaranproses/<?= $datapembelian['idbeli'] ?>">
                                            <?php
                                            if ($datapembelian['jenispengiriman'] != "Ambil Sendiri") { ?>
                                                <div class="form-group">
                                                    <label>Masukkan No Resi Pengiriman</label>
                                                    <input type="text" class="form-control" name="resi" value="<?= $datapembelian['resipengiriman'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="statusbeli">
                                                        <option <?php if ($datapembelian['statusbeli'] == 'Pesanan Di Tolak') echo 'selected'; ?> value="Pesanan Di Tolak">Pesanan Di Tolak</option>
                                                        <option <?php if ($datapembelian['statusbeli'] == 'Pesanan Di Kirim') echo 'selected'; ?> value="Pesanan Di Kirim">Pesanan Di Kirim</option>
                                                        <option <?php if ($datapembelian['statusbeli'] == 'Pesanan Telah Sampai ke Pemesan') echo 'selected'; ?> value="Pesanan Telah Sampai ke Pemesan">Pesanan Telah Sampai ke Pemesan</option>
                                                        <option <?php if ($datapembelian['statusbeli'] == 'Selesai') echo 'selected'; ?> value="Selesai">Selesai</option>
                                                    </select>
                                                </div>
                                            <?php } else { ?>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="statusbeli">
                                                        <option <?php if ($datapembelian['statusbeli'] == 'Pesanan Di Tolak') echo 'selected'; ?> value="Pesanan Di Tolak">Pesanan Di Tolak</option>
                                                        <option <?php if ($datapembelian['statusbeli'] == 'Pesanan sudah siap, silahkan di ambil') echo 'selected'; ?> value="Pesanan sudah siap, silahkan di ambil">Pesanan sudah siap, silahkan di ambil</option>
                                                        <option <?php if ($datapembelian['statusbeli'] == 'Selesai') echo 'selected'; ?> value="Selesai">Selesai</option>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                            <button class=" btn btn-danger float-right pull-right" type="submit">Simpan</button>
                                            <br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Bukti Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Bukti Pembayaran</h4>
                                    <img src="/bukti/<?= $databayar['bukti'] ?>" alt="" class="img-responsive" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Bukti Makanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Bukti Makanan</h4>
                                    <img src="/bukti_makanan/<?= $datapembelian['bukti_makanan'] ?>" alt="" class="img-responsive" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>