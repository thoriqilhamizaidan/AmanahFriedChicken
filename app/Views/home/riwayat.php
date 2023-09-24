<?= $this->extend('home/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Pembelian Berlangsung</h2>
            </div>
            <form class="col-md-12" method="post">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel">
                        <thead>
                            <tr>
                                <th class="product-number" width="1%">No</th>
                                <th class="product-item" width="30%">Daftar</th>
                                <th>Pengiriman</th>
                                <th>Tanggal</th>
                                <th width="17%">Total</th>
                                <th>Opsi</th>
                                <th class="product-thumbnail">Bukti Makanan</th>
                                <th class="product-thumbnail">Bukti Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($databeli as $b) : ?>
                                <?php if ($b['statusbeli'] !== 'Selesai') : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td>
                                            <ul><?php foreach ($dataproduk[$b['idbelireal']] as $p) : ?>

                                                    <li>
                                                        <?= $p['nama_produk'] ?> x <?= $p['jumlah'] ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td><?= $b['jenispengiriman'] ?></td>
                                        <td><?= tanggal(date("Y-m-d", strtotime($b['waktu']))) . ' ' . date("H:i", strtotime($b['waktu'])) ?></td>
                                        <td>Rp. <?php echo number_format($b["totalbeli"] + $b["ongkir"]); ?>
                                        </td>
                                        <td>
                                            <?php if ($b['statusbeli'] == "Belum Bayar") {
                                                $deadline = date('Y-m-d H:i', strtotime($b['waktu'] . ' +1 day'));
                                                $harideadline = date('Y-m-d', strtotime($b['waktu'] . ' +1 day'));
                                                $jamdeadline = date('H:i', strtotime($b['waktu'] . ' +1 day'));
                                                if (date('Y-m-d H:i') >= $deadline) {
                                                    echo 'Waktu pembayaran telah habis';
                                                } else { ?>
                                                    <a href="<?= base_url() ?>home/pembayaran/<?= $b['idbelireal'] ?>" class="btn btn-danger">Upload Bukti Pembayaran</a>
                                                <?php }
                                            } elseif ($b['statusbeli'] == "Sudah Upload Bukti Pembayaran") { ?>
                                                <a class="btn btn-danger text-white">Pesanan di Proses</a>
                                            <?php
                                            } elseif ($b['statusbeli'] == "Sudah Upload Bukti Makanan") { ?>
                                                <a class="btn btn-danger text-white">Menunggu Konfirmasi Admin</a>
                                            <?php } elseif ($b['statusbeli'] == "Pesanan Di Kirim") { ?>
                                                <a class="btn btn-danger text-white">Pesanan Anda Sedang Di Kirim, Mohon Di Tungggu</a>
                                                <br><br>
                                                <p><a target="_blank" href="https://cekresi.com">No Resi : <?= $b['resipengiriman'] ?></a></p>
                                            <?php } elseif ($b['statusbeli'] == "Pesanan sudah siap, silahkan di ambil") { ?>
                                                <a class="btn btn-info text-white">Pesanan sudah siap, silahkan di ambil</a>
                                            <?php } elseif ($b['statusbeli'] == "Pesanan Telah Sampai ke Pemesan") { ?>
                                                <a data-toggle="modal" data-target="#selesai<?= $i ?>" class="btn btn-success text-white">Konfirmasi Selesai</a>
                                            <?php } elseif ($b['statusbeli'] == "Selesai") { ?>
                                                Selesai
                                            <?php } elseif ($b['statusbeli'] == "Pesanan Di Tolak") { ?>
                                                <a class="btn btn-danger text-white">Pesanan Anda Di Tolak</a>
                                            <?php } ?>

                                        </td>
                                        <td><img width="100px" src="/bukti_makanan/<?= $b['bukti_makanan'] ?>" alt=""></td>
                                        <td><img width="100px" src="/bukti/<?= $b['bukti'] ?>" alt=""></td>
                                    </tr>
                            <?php $i++;
                                endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row mb-5">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Riwayat Pembelian</h2>
            </div>
            <form class="col-md-12" method="post">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel">
                        <thead>
                            <tr>
                                <th class="product-number" width="1%">No</th>
                                <th class="product-item" width="30%">Daftar</th>
                                <th>Pengiriman</th>
                                <th>Tanggal</th>
                                <th width="17%">Total</th>
                                <th>Opsi</th>
                                <th class="product-thumbnail">Bukti Makanan</th>
                                <th class="product-thumbnail">Bukti Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($databeli as $b) : ?>
                                <?php if ($b['statusbeli'] == 'Selesai') : ?>

                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td>
                                            <ul><?php foreach ($dataproduk[$b['idbelireal']] as $p) : ?>

                                                    <li>
                                                        <?= $p['nama_produk'] ?> x <?= $p['jumlah'] ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td><?= $b['jenispengiriman'] ?></td>
                                        <td><?= tanggal(date("Y-m-d", strtotime($b['waktu']))) . ' ' . date("H:i", strtotime($b['waktu'])) ?></td>
                                        <td>Rp. <?php echo number_format($b["totalbeli"] + $b["ongkir"]); ?>
                                        </td>
                                        <td>
                                            <?php if ($b['statusbeli'] == "Belum Bayar") {
                                                $deadline = date('Y-m-d H:i', strtotime($b['waktu'] . ' +1 day'));
                                                $harideadline = date('Y-m-d', strtotime($b['waktu'] . ' +1 day'));
                                                $jamdeadline = date('H:i', strtotime($b['waktu'] . ' +1 day'));
                                                if (date('Y-m-d H:i') >= $deadline) {
                                                    echo 'Waktu pembayaran telah habis';
                                                } else { ?>
                                                    <a href="<?= base_url() ?>home/pembayaran/<?= $b['idbelireal'] ?>" class="btn btn-danger">Upload Bukti Pembayaran</a>
                                                <?php }
                                            } elseif ($b['statusbeli'] == "Sudah Upload Bukti Pembayaran") { ?>
                                                <a class="btn btn-danger text-white">Pesanan di Proses</a>
                                            <?php
                                            } elseif ($b['statusbeli'] == "Sudah Upload Bukti Makanan") { ?>
                                                <a class="btn btn-danger text-white">Menunggu Konfirmasi Admin</a>
                                            <?php } elseif ($b['statusbeli'] == "Pesanan Di Kirim") { ?>
                                                <a class="btn btn-danger text-white">Pesanan Anda Sedang Di Kirim, Mohon Di Tungggu</a>
                                                <br><br>
                                                <p><a target="_blank" href="https://cekresi.com">No Resi : <?= $b['resipengiriman'] ?></a></p>
                                            <?php } elseif ($b['statusbeli'] == "Pesanan sudah siap, silahkan di ambil") { ?>
                                                <a class="btn btn-info text-white">Pesanan sudah siap, silahkan di ambil</a>
                                            <?php } elseif ($b['statusbeli'] == "Pesanan Telah Sampai ke Pemesan") { ?>
                                                <a data-toggle="modal" data-target="#selesai<?= $i ?>" class="btn btn-success text-white">Konfirmasi Selesai</a>
                                            <?php } elseif ($b['statusbeli'] == "Selesai") { ?>
                                                Selesai
                                            <?php } elseif ($b['statusbeli'] == "Pesanan Di Tolak") { ?>
                                                <a class="btn btn-danger text-white">Pesanan Anda Di Tolak</a>
                                            <?php } ?>

                                        </td>
                                        <td><img width="100px" src="/bukti_makanan/<?= $b['bukti_makanan'] ?>" alt=""></td>
                                        <td><img width="100px" src="/bukti/<?= $b['bukti'] ?>" alt=""></td>
                                    </tr>
                            <?php $i++;
                                endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <?php
        $no = 1;
        $idbelis = [];
        foreach ($databeli as $data) {

        ?>
            <div class="modal fade" id="selesai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan Selesai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="/home/selesai">
                            <div class="modal-body">
                                <h5>Apakah anda yakin ingin mengkonfirmasi pesanan telah selesai ?</h5>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" class="form-contol" value="<?= $data['idbeli'] ?>" name="idbeli">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="selesai" value="selesai" class="btn btn-danger">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
            $no++;
        } ?>
    </div>
</div>
</div>
<?= $this->endSection(); ?>