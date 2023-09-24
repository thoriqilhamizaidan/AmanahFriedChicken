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

                <?php if ($datapembelian['statusbeli'] != "Selesai" && $datapembelian['statusbeli'] != 'Sudah Upload Bukti Makanan')  { ?>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Konfirmasi</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="/internal/pesananproses/<?= $datapembelian['idbeli'] ?>" enctype="multipart/form-data">
                                            <input type="hidden" value="<?= $databayar['nama'] ?>" name="nama">
                                            <div class="form-group">
                                                <label>Foto Bukti</label>
                                                <input type="file" name="bukti" class="form-control" required>
                                            </div>
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