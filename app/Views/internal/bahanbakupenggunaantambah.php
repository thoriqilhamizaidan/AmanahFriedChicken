<?= $this->extend('internal/templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Penggunaan Bahan Baku</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('internal/bahanbakupenggunaantambah') ?>" method="post">
                        <div class="form-group">
                            <label>Tanggal Penggunaan</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
                        </div>
                        <table class="table table-bordered table-striped" id="tabelform">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="mb-2">Nama Bahan Baku</label>
                                        <select name="idbahanbaku[]" id="" data-width="100%" class="form-control idbahanbaku selectcari" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($bahanbaku as $data) { ?>
                                                <option value="<?= $data->idbahanbaku ?>"><?= $data->namabahanbaku ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-3">
                                        <label class="mb-2">Jumlah</label>
                                        <input type="number" value="1" min="0" name="jumlah[]" oninput="check()" onchange="check()" class="form-control jumlah" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-3">
                                        <button type="button" name="add" id="addkegiatan" class="btn btn-success" style="margin-top:30px">+</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-primary float-right" name="tambah">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        var i = 1;

        $('#addkegiatan').click(function() {
            i++;
            var html = `
            <tr id="row${i}">
                <td>
                    <div class="form-group">
                        <label class="mb-2">Nama Bahan Baku</label>
                        <select name="idbahanbaku[]" class="form-control idbahanbaku selectcari" required>
                            <option value="">Pilih</option>
                            <?php foreach ($bahanbaku as $data) { ?>
                                <option value="<?= $data->idbahanbaku ?>"><?= $data->namabahanbaku ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-3">
                        <label class="mb-2">Jumlah</label>
                        <input type="number" value="1" min="0" name="jumlah[]" class="form-control jumlah" oninput="check()" onchange="check()" required>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-3">
                        <button type="button" name="remove" class="btn btn-danger btn_remove" style="margin-top:30px">X</button>
                    </div>
                </td>
            </tr>`;

            $('#tabelform').append(html);
        });

        $(document).on('click', '.btn_remove', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
<?= $this->endSection(); ?>