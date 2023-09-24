<?= $this->extend('internal/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="<?= base_url('internal/bahanbakupembeliantambah') ?>" class="btn btn-primary my-3">Tambah Data</a>
            <h1 class="mt-2">Daftar Pembelian Bahan Baku</h1>
            <table class="table table-bordered" id="myTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <td>Tanggal</td>
                        <th>Bahan Baku</th>
                        <th>Grandtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bahanbakupembelian as $row) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= tanggal($row->tanggal); ?></td>
                            <td>
                                <?php
                                $ambilbahanbaku = $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $row->kode)->get()->getResult();
                                foreach ($ambilbahanbaku as $bahanbaku) {
                                    echo '- ' . $bahanbaku->namabahanbaku . ' x ' . $bahanbaku->jumlah . '<br>';
                                }
                                ?></td>
                            <td><?= rupiah($row->grandtotal); ?></td>
                            <td>
                                <a href="<?= base_url('internal/bahanbakupembelianedit/' . $row->kode) ?>" class="btn btn-warning m-1">Edit</a>
                                <a href="<?= base_url('internal/bahanbakupembelianhapus/' . $row->kode) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>