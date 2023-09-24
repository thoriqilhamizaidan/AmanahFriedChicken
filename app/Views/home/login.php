<?= $this->extend('home/templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Login</h2>
            </div>
        </div>
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-warning">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <div class="col-md-12 my-auto">
            <form action="/home/doLogin" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <br>
                <button class="btn btn-danger btn-block" type="submit">Masuk</button>
            </form>
            <div class="text-center">
                <a class="small" href="/home/register">Buat Akun Baru</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>