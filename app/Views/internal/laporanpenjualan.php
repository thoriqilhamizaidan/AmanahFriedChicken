<?= $this->extend('internal/templates/index'); ?>

<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Laporan Penjualan</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>
            <form method="post" accept="<?= base_url('internal/laporanpembelianbahanbakudaftar') ?>">
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="mb-2">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tanggalawal" value="<?= $tanggalawal ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="mb-2">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tanggalakhir" value="<?= $tanggalakhir ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary text-white" style="margin-top:30px">Cari</button>
                            <a href="<?= base_url('internal/laporanpenjualancetak/' . $tanggalawal . '/' . $tanggalakhir) ?>" target="_blank" class="btn btn-success" style="margin-top:30px">Download Laporan</a>

                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pemesan</th>
                            <th>Tanggal</th>
                            <th>Daftar Pembelian</th>
                            <th>Grandtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($riwayat as $row) {
                            $pemesan = $this->db->table('pengguna')
                                ->where('idpengguna', $row->id)
                                ->get()
                                ->getRow();
                        ?>
                            <tr>
                                <td>
                                    <?= $no ?>
                                </td>
                                <td>
                                    <?= $pemesan->nama ?>
                                </td>
                                <td>
                                    <?= tanggal(date("Y-m-d", strtotime($row->waktu))) . ' ' . date("H:i", strtotime($row->waktu)); ?>
                                </td>
                                <td>
                                    <?php
                                    $ambilproduk = $this->db->table('pembelianproduk')->where('idbeli', $row->idbeli)->join('produk', 'pembelianproduk.id_produk = produk.id_produk')->get()->getResult();
                                    foreach ($ambilproduk as $produk) {
                                        echo '- ' . $produk->nama_produk . ' x ' . $produk->jumlah . '<br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= rupiah($row->totalbeli) ?>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?= $this->endSection(); ?>