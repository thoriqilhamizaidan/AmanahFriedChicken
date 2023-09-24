<?= $this->extend('home/templates/index'); ?>

<?= $this->section('page-content'); ?>


<div class="container">
    <div class="row">
        <div class="col mt-4">
            <h2>Profil</h2>
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif; ?>
            <form method="post" action="/home/profilubah/<?= $pengguna['idpengguna'] ?>" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="<?php echo $pengguna['nama']; ?>" type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="<?php echo $pengguna['email']; ?>" type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input min="0" value="<?php echo $pengguna['nohp']; ?>" type="number" class="form-control" name="nohp">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                        <input type="hidden" class="form-control" name="passwordlama" value="<?php echo $pengguna['password']; ?>">
                        <span class="text-primary">Kosongkan Password jika tidak ingin mengganti</span>
                    </div>
                    <button class="btn btn-danger float-right pull-right" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>