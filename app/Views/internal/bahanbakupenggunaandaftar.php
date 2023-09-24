<?= $this->extend('internal/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="<?= base_url('internal/bahanbakupenggunaantambah') ?>" class="btn btn-primary my-3">Tambah Data</a>
            <h1 class="mt-2">Daftar Penggunaan Bahan Baku</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>
            <table class="table table-bordered" id="myTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <td>Tanggal</td>
                        <th>Bahan Baku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bahanbakupenggunaan as $row) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= tanggal($row->tanggal); ?></td>
                            <td>
                                <?php
                                $ambilbahanbaku = $this->db->table('bahanbakupenggunaan')->join('bahanbaku', 'bahanbakupenggunaan.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $row->kode)->get()->getResult();
                                foreach ($ambilbahanbaku as $bahanbaku) {
                                    echo '- ' . $bahanbaku->namabahanbaku . ' x ' . $bahanbaku->jumlah . '<br>';
                                }
                                ?></td>
                            <td>
                                <a href="<?= base_url('internal/bahanbakupenggunaanedit/' . $row->kode) ?>" class="btn btn-warning m-1">Edit</a>
                                <a href="<?= base_url('internal/bahanbakupenggunaanhapus/' . $row->kode) ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>