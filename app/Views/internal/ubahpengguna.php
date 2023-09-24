<?= $this->extend('internal/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Pengguna</h6>
                </div>
                <div class="card-body">
                    <form action="/internal/updatepengguna/<?= $pengguna['idpengguna'] ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?= $pengguna['nama']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="<?= $pengguna['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" value="<?= $pengguna['password']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="number" class="form-control" name="nohp" value="<?= $pengguna['nohp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="level" required>
                                <option <?php if ($pengguna['level'] == 'Super Admin') echo 'selected'; ?> value="Super Admin">Super Admin</option>
                                <option <?php if ($pengguna['level'] == 'Pegawai') echo 'selected'; ?> value="Pegawai">Pegawai</option>
                                <option <?php if ($pengguna['level'] == 'Pembeli') echo 'selected'; ?> value="Pembeli">Pembeli</option>
                                <option <?php if ($pengguna['level'] == 'Pemilik Toko') echo 'selected'; ?> value="Pemilik Toko">Pemilik Toko</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="tambah">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>