<?= $this->extend('internal/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Pesanan Selesai</h1>
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Daftar</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Total Pembelian</th>
                            <th scope="col">Status Belanja</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($datapembelian as $b) : ?>
                            <?php if ($b['statusbeli'] === 'Selesai') : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $b['nama'] ?></td>
                                    <td>
                                        <ul>
                                            <?php foreach ($dataproduk[$b['idbeli']] as $p) : ?>
                                                <li>
                                                    <?= $p['nama_produk'] ?> x <?= $p['jumlah'] ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td><?= tanggal(date("Y-m-d", strtotime($b['waktu']))) . ' ' . date("H:i", strtotime($b['waktu'])); ?>
                                    </td>
                                    <td><?= rupiah($b['totalbeli'] + $b['ongkir']) ?></td>
                                    <td><?= $b['statusbeli'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>internal/pembayaran/<?= $b['idbeli'] ?>" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>