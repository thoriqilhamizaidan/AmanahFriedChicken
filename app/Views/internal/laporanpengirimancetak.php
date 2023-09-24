<html>
<title>Laporan Pengiriman</title>
<style type="text/css">
    body {
        -webkit-print-color-adjust: exact;
        padding: 50px;
    }

    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #table td,
    #table th {
        padding: 8px;
        padding-top: 5px;
        border: 1px solid black;
    }

    #table tr {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 5px;
        padding-bottom: 5px;
        text-align: left;
        background-color: #ff0000;
        color: white;
    }

    @page {
        size: auto;
        margin: 0;
    }
</style>
<?php
$this->db = db_connect();
?>

<body>
    <table style='width:600; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
        <tr>
            <td><img src="<?= base_url('foto/logo.png') ?>" width="90" height="90"></td>
            <td>
                <center>
                    <font size="6"><b>AMANAH FRIED CHICKEN</b></font><br>
                    <font size="2">Jl. Pangeran Jayakarta No.Kel, RT.003/RW.006, Harapan Mulya, Kec. Medan Satria<br>Kota Bekasi, Jawa Barat 17143
                        Telp. 0856-9111-3122
                    </font><br>
                </center>
            </td>
        </tr>
    </table>
    <br>
    <center>
        <span>-----------------------------------------------------------------------------------------------------------------------</span>
        <?php
        if ($tanggalawal != "kosong") { ?>
            <h4>LAPORAN PENGIRIMAN<br><?= strtoupper(tanggal($tanggalawal) . ' - ' . tanggal($tanggalakhir)) ?></h4>
        <?php } else { ?>
            <h4>LAPORAN PENGIRIMAN</h4>
        <?php } ?>
    </center>
    <br>
    <table class="table table-bordered table-striped" id="table" width="670px">
        <thead>
            <tr>
                <th>No.</th>
                <th>Pemesan</th>
                <th>Tanggal</th>
                <th>Daftar Pembelian</th>
                <th>No. Resi</th>
                <th>Ongkir</th>
                <th>Grandtotal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($riwayat as $row) {
                $pemesan = $this->db->table('pengguna')
                    ->where('idpengguna', $row->id)
                    ->get()
                    ->getRow();
            ?>
                <tr>
                    <td>
                        <?= $no ?>
                    </td>
                    <td>
                        <?= $pemesan->nama ?>
                    </td>
                    <td>
                        <?= tanggal(date("Y-m-d", strtotime($row->waktu))) . ' ' . date("H:i", strtotime($row->waktu)); ?>
                    </td>
                    <td>
                        <?php
                        $ambilproduk = $this->db->table('pembelianproduk')->where('idbeli', $row->idbeli)->join('produk', 'pembelianproduk.id_produk = produk.id_produk')->get()->getResult();
                        foreach ($ambilproduk as $produk) {
                            echo '- ' . $produk->nama_produk . ' x ' . $produk->jumlah . '<br>';
                        }
                        ?>
                    </td>
                    <td>
                        <?= $row->resipengiriman ?>
                    </td>
                    <td>
                        <?= rupiah($row->ongkir) ?>
                    </td>
                    <td>
                        <?= rupiah($row->totalbeli) ?>
                    </td>
                    <td>
                        <?= $row->statusbeli ?>
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>

</html>