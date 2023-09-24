<html>
<?php
$this->db = db_connect();
?>
<title>Laporan Stok Bahan Baku</title>
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
        background-color: #4CAF50;
        color: white;
    }

    @page {
        size: auto;
        margin: 0;
    }
</style>

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
            <h4>LAPORAN PEMBELIAN BAHAN BAKU<br><?= strtoupper(tanggal($tanggalawal) . ' - ' . tanggal($tanggalakhir)) ?></h4>
        <?php } else { ?>
            <h4>LAPORAN PEMBELIAN BAHAN BAKU</h4>
        <?php } ?>
    </center>
    <br>
    <table class="table table-bordered table-striped" id="table" width="670px">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Bahan Baku</th>
                <th>Grandtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($bahanbakupembelian as $row) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= tanggal($row->tanggal); ?></td>
                    <td>
                        <?php
                        $ambilbahanbaku = $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $row->kode)->get()->getResult();
                        foreach ($ambilbahanbaku as $bahanbaku) {
                            echo '- ' . $bahanbaku->namabahanbaku . ' x ' . $bahanbaku->jumlah . '<br>';
                        }
                        ?></td>
                    <td><?= rupiah($row->grandtotal); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>

</html>