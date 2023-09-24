<?= $this->extend('home/templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section mb-5 col-12">
                <h2 class="text-uppercase">Register</h2>
            </div>
        </div>
        <div class="col-md-12 my-auto">
            <form action="/home/registersimpan" method="POST">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label>No. HP</label>
                    <input type="number" name="nohp" class="form-control">
                </div>
                <input type="hidden" name="level" value="Pembeli" class="form-control">
                <br>
                <button class="btn btn-danger btn-block" type="submit">Daftar</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>