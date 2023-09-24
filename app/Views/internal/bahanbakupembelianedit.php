<?= $this->extend('internal/templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
$this->db = db_connect();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Pembelian Bahan Baku</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('internal/bahanbakupembelianedit/' . $id) ?>" method="post">
                        <div class="form-group">
                            <label>Tanggal Pembelian</label>
                            <input type="hidden" class="form-control" name="kode" value="<?= $row->kode ?>">
                            <input type="date" class="form-control" name="tanggal" value="<?= $row->tanggal ?>">
                        </div>
                        <table class="table table-bordered table-striped" id="tabelform">
                            <?php
                            $ambilpembelian = $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $row->kode)->get()->getResult();
                            $no = 1;
                            foreach ($ambilpembelian as $pembelian) {
                            ?>
                                <tr id="row<?= $no ?>">
                                    <td width="30%">
                                        <div class="form-group idbahanbakuharga">
                                            <label class="mb-2">Nama Bahan Baku</label>
                                            <select name="idbahanbaku[]" id="" data-width="100%" class="form-control idbahanbaku selectcari" required>
                                                <option value="">Pilih</option>
                                                <?php foreach ($bahanbaku as $data) { ?>
                                                    <option <?php if ($pembelian->idbahanbaku == $data->idbahanbaku) echo 'selected'; ?> value="<?= $data->idbahanbaku ?>"><?= $data->namabahanbaku ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-3">
                                            <label class="mb-2">Harga Satuan</label>
                                            <input type="text" value="<?= $pembelian->harga ?>" name="harga[]" oninput="check()" onchange="check()" class="form-control harga" required>
                                        </div>
                                    </td>
                                    <td width="15%">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">Jumlah</label>
                                            <input type="number" value="<?= $pembelian->jumlah ?>" min="0" name="jumlah[]" oninput="check()" onchange="check()" class="form-control jumlah" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-3">
                                            <label class="mb-2">Total</label>
                                            <input type="text" name="total[]" value="<?= $pembelian->total ?>" class="form-control total" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-3">
                                            <?php if ($no == 1) { ?>
                                                <button type="button" name="add" id="addkegiatan" class="btn btn-success" style="margin-top:30px">+</button>
                                            <?php } else { ?>
                                                <button type="button" name="remove" id="<?= $no ?>" class="btn btn-danger btn_remove" style="margin-top:30px">X</button>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Total Harga Barang</label>
                                    <input class="form-control" id="grandtotal" name="grandtotal" type="number" readonly>
                                    <input class="form-control" id="grandtotalnon" name="grandtotalnon" type="hidden" required>
                                </div>
                            </div>
                        </div>
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
        var i = <?= $no ?>;

        $('#addkegiatan').click(function() {
            i++;
            var html = `
            <tr id="row${i}">
                <td width="30%">
                    <div class="form-group idbahanbakuharga">
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
                        <label class="mb-2">Harga</label>
                        <input type="number" name="harga[]" value="0" class="form-control harga" oninput="check()" onchange="check()" required>
                    </div>
                </td>
                <td width="15%">
                    <div class="form-group mb-3">
                        <label class="mb-2">Jumlah</label>
                        <input type="number" value="1" min="0" name="jumlah[]" class="form-control jumlah" oninput="check()" onchange="check()" required>
                    </div>
                </td>
                <td>
                    <div class="form-group mb-3">
                        <label class="mb-2">Total</label>
                        <input type="text" name="total[]" class="form-control total" value="0" readonly>
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
            hitunggrandtotal()
        });

        $(document).on('input', '.jumlah', function() {
            var $row = $(this).closest('tr');
            var jumlah = $(this).val();
            var harga = $row.find('.harga').val();
            var total = parseInt(jumlah) * parseInt(harga);
            if (!isNaN(total)) {
                $row.find('.total').val(total);
            } else {
                $row.find('.total').val(0);
            }

            hitunggrandtotal(); // Recalculate grand total after changing quantity
        });

        $(document).on('change', '.jumlah', function() {
            hitunggrandtotal(); // Recalculate grand total after changing quantity
        });

        $(document).on('input', '.harga', function() {
            var $row = $(this).closest('tr');
            var jumlah = $row.find('.jumlah').val();
            var harga = $(this).val();
            var total = parseInt(jumlah) * parseInt(harga);
            if (!isNaN(total)) {
                $row.find('.total').val(total);
            } else {
                $row.find('.total').val(0);
            }

            hitunggrandtotal(); // Recalculate grand total after changing price
        });

        $(document).on('change', '.harga', function() {
            hitunggrandtotal(); // Recalculate grand total after changing price
        });

        $(document).ready(function() {
            $(".total").each(function() {
                setInterval(hitunggrandtotal, 100);
            });
        });

        function hitunggrandtotal() {
            var sum = 0;
            $(".total").each(function() {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $('#grandtotal').val(sum.toFixed(2));
            $('#grandtotalnon').val(sum);

            $(".subtotal").each(function(index) {
                var jumlah = $(this).closest('tr').find('.jumlah').val();
                var harga = $(this).closest('tr').find('.harga').val();
                var total = parseInt(jumlah) * parseInt(harga);
                if (!isNaN(total)) {
                    $(this).val(total);
                } else {
                    $(this).val(0);
                }
            });
        }
    });
</script>
<?= $this->endSection(); ?>