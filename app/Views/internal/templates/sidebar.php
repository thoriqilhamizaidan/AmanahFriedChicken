<?php
if (session('level') == 'Pemilik Toko') {
    $warna = "bg-gradient-primary";
} elseif (session('level') == 'Super Admin') {
    $warna = "bg-gradient-success";
} else {
    $warna = "bg-gradient-danger";
}
?>
<ul class="navbar-nav <?= $warna ?> sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>internal">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('foto/logo.png') ?>" width="50px" style="border-radius: 5px;">
        </div>
        <div class="sidebar-brand-text mx-3"><?= ucwords(session('level')) ?></div>
    </a>
    <hr class="sidebar-divider my-0">
    <?php
    if (session('level') == 'Pemilik Toko') { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/kategori">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kategori</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/produk">
                <i class="fas fa-fw fa-table"></i>
                <span>Produk</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/pembelian">
                <i class="fas fa-fw fa-table"></i>
                <span>Transaksi</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bahanbaku" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Bahan Baku</span>
            </a>
            <div id="bahanbaku" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('internal/') ?>bahanbakudaftar">Bahan Baku</a>
                    <a class="collapse-item" href="<?= base_url('internal/') ?>bahanbakupembeliandaftar">Pembelian Bahan Baku</a>
                    <a class="collapse-item" href="<?= base_url('internal/') ?>bahanbakupenggunaandaftar">Penggunaan Bahan Baku</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Laporan</span>
            </a>
            <div id="laporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('internal/') ?>laporanstokbahanbakudaftar">Stok Bahan Baku</a>
                    <a class="collapse-item" href="<?= base_url('internal/') ?>laporanpemesanan">Pemesanan</a>
                    <a class="collapse-item" href="<?= base_url('internal/') ?>laporanpengiriman">Pengiriman</a>
                    <a class="collapse-item" href="<?= base_url('internal/') ?>laporanpenjualan">Penjualan</a>
                    <a class="collapse-item" href="<?= base_url('internal/') ?>laporanpembelianbahanbakudaftar">Pembelian Bahan Baku</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/pengguna">
                <i class="fas fa-fw fa-table"></i>
                <span>Pengguna</span></a>
        </li>
    <?php } ?>
    <?php
    if (session('level') == 'Super Admin') { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/kategori">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kategori</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/produk">
                <i class="fas fa-fw fa-table"></i>
                <span>Produk</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/pembelian">
                <i class="fas fa-fw fa-table"></i>
                <span>Pesanan OnGoing</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/pembelianselesai">
                <i class="fas fa-fw fa-table"></i>
                <span>Pesanan Selesai</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bahanbaku" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Bahan Baku</span>
            </a>
            <div id="bahanbaku" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('internal/') ?>bahanbakudaftar">Bahan Baku</a>
                    <a class="collapse-item" href="<?= base_url('internal/') ?>bahanbakupembeliandaftar">Pembelian Bahan Baku</a>
                    <a class="collapse-item" href="<?= base_url('internal/') ?>bahanbakupenggunaandaftar">Penggunaan Bahan Baku</a>
                </div>
            </div>
        </li>
    <?php } ?>
    <?php
    if (session('level') == 'Pegawai') { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/kategori">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kategori</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/produk">
                <i class="fas fa-fw fa-table"></i>
                <span>Produk</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/bahanbakudaftar">
                <i class="fas fa-fw fa-folder"></i>
                <span>Bahan Baku</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/bahanbakupembeliandaftar">
                <i class="fas fa-fw fa-book"></i>
                <span>Pembelian Bahan Baku</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/bahanbakupenggunaandaftar">
                <i class="fas fa-fw fa-download"></i>
                <span>Penggunaan Bahan Baku</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>internal/pesanan">
                <i class="fas fa-fw fa-book"></i>
                <span>Pesanan</span></a>
        </li>
    <?php } ?>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>