<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amanah Fried Chicken</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/owl.theme.default.min.css">


    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/aos.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/style.css">
    <link href="<?= base_url() ?>assets/DataTables/datatables.min.css" rel="stylesheet" />

</head>

<body>
    <?php if (session()->getFlashdata('alert') !== NULL) : ?>
        <script>
            alert("<?= session()->getFlashdata('alert') ?>");
        </script>
    <?php endif; ?>

    <div class="site-wrap">

        <div class="site-navbar bg-white py-2">

            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <div class="site-logo">
                            <a href="<?= base_url() ?>home" class="js-logo-clone">Amanah Fried Chicken</a>
                        </div>
                    </div>
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li><a href="<?= base_url() ?>home">Home</a></li>
                                <li><a href="<?= base_url() ?>home/produk">Produk</a></li>
                                <li class="has-children">
                                    <a href="#">Kategori</a>
                                    <ul class="dropdown">
                                        <?php foreach ($kategori as $k) : ?>
                                            <li><a href="<?= base_url() ?>home/kategori/<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>

                                </li>
                                <?php if (session()->get('isLoggedIn')) : ?>
                                    <li class="has-children">
                                        <a href="#">Akun</a>
                                        <ul class="dropdown">
                                            <li><a href="<?= base_url() ?>home/profil/<?= session()->get('idpengguna') ?>">Profil Akun</a></li>
                                            <li><a href="<?= base_url() ?>home/keranjang">Keranjang</a></li>
                                            <li><a href="<?= base_url() ?>home/riwayat">Riwayat Pembelian</a></li>
                                            <li><a href="<?= base_url() ?>home/logout">Logout</a></li>
                                        </ul>
                                    </li>
                                <?php else : ?>
                                    <li><a href="<?= base_url() ?>home/login">Login</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                    <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
                </div>
            </div>
        </div>


        <?= $this->renderSection('page-content'); ?>



        <footer class="site-footer custom-border-top">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-lg-6">
                        <div class="block-5 mb-5">
                            <h3 class="footer-heading mb-4">Contact Info</h3>
                            <ul class="list-unstyled">
                                <li class="address">Jl. Pangeran Jayakarta No.Kel, RT.003/RW.006, Harapan Mulya, Kec. Medan Satria, Kota Bekasi, Jawa Barat 17143</li>
                                <li class="phone"><a href="https://wa.me/6281319173747">081319173747</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <p>
                            Dibuat oleh : Thoriq Ilhami Zaidan
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?= base_url() ?>assets/home/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/jquery-ui.js"></script>
    <script src="<?= base_url() ?>ssets/home/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/aos.js"></script>

    <script src="<?= base_url() ?>assets/home/js/main.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!-- Data Tables JS -->

    <script src="<?= base_url() ?>assets/DataTables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "ALL"]
                ]
            });
        });
    </script>
</body>

</html>