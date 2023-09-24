<?= $this->extend('internal/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form method="post" accept="<?= base_url('internal/laporanpembelianbahanbakudaftar') ?>">
                <div class="row">
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
                            <a href="<?= base_url('internal/laporanpembelianbahanbakudaftarcetak/' . $tanggalawal . '/' . $tanggalakhir) ?>" target="_blank" class="btn btn-success" style="margin-top:30px">Download Laporan</a>

                        </div>
                    </div>
                </div>
            </form>
            <h1 class="mt-2"><?= $title ?></h1>
            <table class="table table-bordered" id="myTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Bahan Baku</th>
                        <th>Grandtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bahanbakupembelian as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= tanggal($row->tanggal); ?></td>
                            <td>
                                <?php
                                $ambilbahanbaku = $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $row->kode)->get()->getResult();
                                foreach ($ambilbahanbaku as $bahanbaku) {
                                    echo '- ' . $bahanbaku->namabahanbaku . ' x ' . $bahanbaku->jumlah . '<br>';
                                }
                                ?></td>
                            <td><?= rupiah($row->grandtotal); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>