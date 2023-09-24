<?php

namespace App\Controllers;

use PDO;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\PenggunaModel;
use App\Models\PembelianModel;
use App\Models\PembayaranModel;
use App\Controllers\BaseController;
use App\Models\PembelianprodukModel;

class Internal extends BaseController
{
    protected $kategoriModel;
    protected $produkModel;
    protected $penggunaModel;
    protected $pembelianModel;
    protected $pembelianprodukModel;
    protected $pembayaranModel;
    protected $helpers = ['form', 'fungsi'];
    protected $db;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->produkModel = new ProdukModel();
        $this->penggunaModel = new PenggunaModel();
        $this->pembelianModel = new PembelianModel();
        $this->pembelianprodukModel = new PembelianprodukModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->db      = \Config\Database::connect();
    }

    public function logout()
    {
        // Hapus session pengguna
        $session = session();
        $session->remove(['idpengguna', 'nama', 'email', 'isLoggedIn']);

        // Redirect ke halaman setelah logout
        return redirect()->to('/home');
    }

    public function index()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }

        $data = [
            'title' => 'Dashboard',
            'transaksimenunggu' => $this->db->table('pembelian')->where('statusbeli', 'Sudah Upload Bukti Pembayaran')->countAllResults(),
            'transaksiproses' => $this->db->table('pembelian')->where('statusbeli', 'Pesanan Di Kirim')->orWhere('statusbeli', 'Pesanan Telah Sampai ke Pemesan')->orWhere('statusbeli', 'Pesanan sudah siap, silahkan di ambil')->countAllResults(),
            'transaksiselesai' => $this->db->table('pembelian')->where('statusbeli', 'Selesai')->countAllResults(),
            'pelanggan' => $this->db->table('pengguna')->where('level', 'Pembeli')->countAllResults(),
            'jenisproduk' => $this->db->table('produk')->countAllResults(),
            'jenisbahanbaku' => $this->db->table('pengguna')->where('level', 'Pembeli')->countAllResults(),
        ];
        return view('internal/index', $data);
    }



    public function kategori()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }

        $data = [
            'title' => 'Daftar Kategori',
            'kategori' => $this->kategoriModel->findAll(),
        ];

        return view('internal/kategori', $data);
    }

    public function tambahkategori()
    {

        $data = [
            'title' => 'Form Tambah Kategori',
            'validation' => \Config\Services::validation()

        ];

        return view('internal/tambahkategori', $data);
    }

    public function simpankategori()
    {
        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/internal/kategori');
    }
    public function ubahkategori($id_kategori)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Form Ubah Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->where(['id_kategori' => $id_kategori])->first(),

        ];

        return view('internal/ubahkategori', $data);
    }

    public function updatekategori($id_kategori)
    {
        $this->kategoriModel->save([
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/internal/kategori');
    }

    public function hapuskategori($id_kategori)
    {
        $this->kategoriModel->delete($id_kategori);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/internal/kategori');
    }

    public function produk()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Daftar Kategori',
            'produk' => $this->produkModel->getAll(),
        ];
        return view('internal/produk', $data);
    }

    public function tambahproduk()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Form Tambah Produk',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $this->produkModel->findAll(),

        ];

        return view('internal/tambahproduk', $data);
    }

    public function simpanproduk()
    {
        // ambilgambar
        $fileSampul = $this->request->getFile('foto_produk');
        // apakah tidak ada gambar
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            // pindah ke foto
            $fileSampul->move('foto', $namaSampul);
        }

        $this->produkModel->save([
            'nama_produk' => $this->request->getVar('nama_produk'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'harga_produk' => $this->request->getVar('harga_produk'),
            'stok_produk' => $this->request->getVar('stok_produk'),
            'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
            'foto_produk' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/internal/produk');
    }

    public function hapusproduk($id_produk)
    {
        // cari gambar berdasarkan id
        $produk = $this->produkModel->find($id_produk);

        // cek default
        if ($produk['foto_produk'] != 'default.png') {
            // hapus gambar
            unlink('foto/' . $produk['foto_produk']);
        }

        $this->produkModel->delete($id_produk);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/internal/produk');
    }


    public function ubahproduk($id_produk)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Form Ubah Produk',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $this->produkModel->find($id_produk),


        ];

        return view('internal/ubahproduk', $data);
    }

    public function updateproduk($id_produk)
    {
        // ambilgambar
        $fileSampul = $this->request->getFile('foto_produk');
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // generate nama file randon
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan gambar
            $fileSampul->move('foto', $namaSampul);

            if ($this->request->getVar('sampulLama') != 'default.png') {
                // hapus file lama
                unlink('foto/' . $this->request->getVar('sampulLama'));
            }
        }

        $this->produkModel->save([
            'id_produk' => $id_produk,
            'nama_produk' => $this->request->getVar('nama_produk'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'harga_produk' => $this->request->getVar('harga_produk'),
            'stok_produk' => $this->request->getVar('stok_produk'),
            'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
            'foto_produk' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/internal/produk');
    }

    public function pengguna()
    { // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if (session('level') == 'Pemilik Toko') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        $idpengguna = session('idpengguna');
        $pengguna = $this->db->table('pengguna')
            ->where('idpengguna !=', $idpengguna)
            ->orderBy('pengguna.idpengguna', 'desc')
            ->get()->getResultArray();
        $data = [
            'title' => 'Pengguna',
            'validation' => \Config\Services::validation(),
            'pengguna' => $pengguna,
        ];
        return view('internal/pengguna', $data);
    }

    public function tambahpengguna()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if (session('level') == 'Pemilik Toko') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        $data = [
            'title' => 'Pengguna',
            'validation' => \Config\Services::validation(),
            'pengguna' => $this->penggunaModel->findAll(),
        ];

        return view('internal/tambahpengguna', $data);
    }

    public function simpanpengguna()
    {
        $this->penggunaModel->save([
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'nohp' => $this->request->getVar('nohp'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambah.');
        return redirect()->to('/internal/pengguna');
    }

    public function ubahpengguna($idpengguna)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if (session('level') == 'Pemilik Toko') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        $data = [
            'title' => 'Pengguna',
            'validation' => \Config\Services::validation(),
            'pengguna' => $this->penggunaModel->find($idpengguna),
        ];
        return view('internal/ubahpengguna', $data);
    }


    public function updatepengguna($idpengguna)
    {
        $this->penggunaModel->save([
            'idpengguna' => $idpengguna,
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'nohp' => $this->request->getVar('nohp'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/internal/pengguna');
    }

    public function hapuspengguna($idpengguna)
    {
        $this->penggunaModel->delete($idpengguna);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/internal/pengguna');
    }

    public function pembelian()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if (session('level') == 'Pemilik Toko' or session('level') == 'Super Admin') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        $data['title'] = 'Transaksi';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $pembelian = $this->db->table('pembelian')
            ->join('pengguna', 'pembelian.id = pengguna.idpengguna')
            ->orderBy('pembelian.tanggalbeli', 'desc')
            ->orderBy('pembelian.idbeli', 'desc')
            ->get();

        $datapembelian = $pembelian->getResultArray();
        $dataproduk = [];
        foreach ($datapembelian as $row) {
            $idbeli = $row['idbeli'];
            $produk =
                $this->db->table('pembelianproduk')
                ->join('produk', 'pembelianproduk.id_produk = produk.id_produk')
                ->where('idbeli', $idbeli)
                ->get()->getResultArray();
            $dataproduk[$idbeli] = $produk;
        }
        $data['datapembelian'] = $datapembelian;
        $data['dataproduk'] = $dataproduk;

        return view('internal/pembelian', $data);
    }

    public function pembelianselesai()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if (session('level') == 'Pemilik Toko' or session('level') == 'Super Admin') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        $data['title'] = 'Transaksi';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $pembelian = $this->db->table('pembelian')
        ->join('pengguna', 'pembelian.id = pengguna.idpengguna')
        ->orderBy('pembelian.tanggalbeli', 'desc')
            ->orderBy('pembelian.idbeli', 'desc')
            ->get();

        $datapembelian = $pembelian->getResultArray();
        $dataproduk = [];
        foreach ($datapembelian as $row) {
            $idbeli = $row['idbeli'];
            $produk =
                $this->db->table('pembelianproduk')
                ->join('produk', 'pembelianproduk.id_produk = produk.id_produk')
                ->where('idbeli', $idbeli)
                ->get()->getResultArray();
            $dataproduk[$idbeli] = $produk;
        }
        $data['datapembelian'] = $datapembelian;
        $data['dataproduk'] = $dataproduk;

        return view('internal/pembelianselesai', $data);
    }

    public function pesanan()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data['title'] = 'Transaksi';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $pembelian = $this->db->table('pembelian')
        ->join('pengguna', 'pembelian.id = pengguna.idpengguna')
        ->orderBy('pembelian.tanggalbeli', 'desc')
            ->orderBy('pembelian.idbeli', 'desc')
            ->get();

        $datapembelian = $pembelian->getResultArray();
        $dataproduk = [];
        foreach ($datapembelian as $row) {
            $idbeli = $row['idbeli'];
            $produk =
                $this->db->table('pembelianproduk')
                ->join('produk', 'pembelianproduk.id_produk = produk.id_produk')
                ->where('idbeli', $idbeli)
                ->get()->getResultArray();
            $dataproduk[$idbeli] = $produk;
        }
        $data['datapembelian'] = $datapembelian;
        $data['dataproduk'] = $dataproduk;

        return view('internal/pesanan', $data);
    }

    public function pesanandetail($idbeli)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data['title'] = 'Transaksi';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $pembelian = $this->pembelianModel->joinPengguna($idbeli);
        $datapembelian = $pembelian;

        $produk = $this->pembelianprodukModel->where('idbeli', $idbeli)->findAll();
        $pembayaran = $this->db->table('pembayaran')
        ->where('idbeli', $idbeli)
        ->get()->getRowArray();

        $data['datapembelian'] = $datapembelian;
        $data['dataproduk'] = $produk;
        $data['databayar'] = $pembayaran;
        return view('internal/pesanandetail', $data);
    }

    public function pesananproses($idbeli)
    {

        $fileBukti = $this->request->getFile('bukti');
        $namaUer = $this->request->getVar('nama');
        $namaBukti = date("YmdHis") . '_' . $namaUer;
        // pindahkan gambar
        $fileBukti->move('bukti_makanan', $namaBukti);

        // $idbeli = $this->request->getVar('idbeli');

        $this->pembelianModel->save([
            'idbeli' => $idbeli,
            'statusbeli' => 'Sudah Upload Bukti Makanan',
            'bukti_makanan' => $namaBukti,
        ]);
        echo "<script>alert('Status Transaksi Berhasil Diupdate')</script>";
        return redirect()->to('/internal/pesanan');
        
    }

    public function pembayaran($idbeli)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if (session('level') == 'Pemilik Toko' or session('level') == 'Super Admin') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        $data['title'] = 'Transaksi';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $pembelian = $this->pembelianModel->joinPengguna($idbeli);
        $datapembelian = $pembelian;

        $produk = $this->pembelianprodukModel->where('idbeli', $idbeli)->findAll();
        $pembayaran = $this->db->table('pembayaran')
            ->where('idbeli', $idbeli)
            ->get()->getRowArray();

        $data['datapembelian'] = $datapembelian;
        $data['dataproduk'] = $produk;
        $data['databayar'] = $pembayaran;
        return view('internal/pembayaran', $data);
    }

    public function pembayaranproses($idbeli)
    {

        $resi = $this->request->getVar('resi');
        $statusbeli = $this->request->getVar('statusbeli');
        $this->pembelianModel->save([
            'idbeli' => $idbeli,
            'resipengiriman' => $resi,
            'statusbeli' => $statusbeli
        ]);
        if ($statusbeli == 'Selesai') {
            $dataproduk = $this->pembelianprodukModel->where('idbeli', $idbeli)->findAll();
            foreach ($dataproduk as $p) {
                $idproduk = $p['id_produk'];
                $jumlah = $p['jumlah'];
                $this->db->table('produk')
                    ->set('stok_produk', 'stok_produk-' . $jumlah, false)
                    ->where('id_produk', $idproduk)
                    ->update();
            }
        }
        echo "<script>alert('Status Transaksi Berhasil Diupdate')</script>";
        return redirect()->to('/internal/pembelian');
    }




    public function bahanbakutambah()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'namabahanbaku' => $this->request->getPost('namabahanbaku'),
                'stok' => $this->request->getPost('stok'),
            ];
            $this->db->table('bahanbaku')->insert($simpan);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to('/internal/bahanbakudaftar');
        } else {
            $data = [
                'title' => 'Tambah Bahan Baku',
            ];

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return view('internal/bahanbakutambah', $data);
        }
    }

    public function bahanbakuedit($id)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'namabahanbaku' => $this->request->getPost('namabahanbaku'),
                'stok' => $this->request->getPost('stok'),
            ];
            $this->db->table('bahanbaku')->where('idbahanbaku', $id)->update($simpan);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to('/internal/bahanbakudaftar');
        } else {
            $data = [
                'title' => 'Edit Bahan Baku',
                'id' => $id,
                'row' => $this->db->table('bahanbaku')->where('idbahanbaku', $id)->get()->getRow()

            ];

            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            return view('internal/bahanbakuedit', $data);
        }
    }

    public function bahanbakudaftar()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Daftar Bahan Baku',
            'bahanbaku' => $this->db->table('bahanbaku')->get()->getResult()
        ];
        return view('internal/bahanbakudaftar', $data);
    }

    public function bahanbakuhapus($id)
    {
        $this->db->table('bahanbaku')->where('idbahanbaku', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/internal/bahanbakudaftar');
    }


    public function bahanbakupembeliandaftar()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Daftar Pembelian Bahan Baku',
            'bahanbakupembelian' => $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->groupBy('kode')->get()->getResult()
        ];
        return view('internal/bahanbakupembeliandaftar', $data);
    }

    public function bahanbakupembeliantambah()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if ($this->request->getMethod() === 'post') {
            $kode = date('dmyHis');
            $tanggal = $this->request->getPost('tanggal');
            $idbahanbaku = $this->request->getPost('idbahanbaku');
            $simpan = [];
            foreach ($idbahanbaku as $key => $val) {
                $simpan[] = [
                    'kode' => $kode,
                    'idbahanbaku' => $this->request->getPost('idbahanbaku')[$key],
                    'harga' => $this->request->getPost('harga')[$key],
                    'jumlah' => $this->request->getPost('jumlah')[$key],
                    'total' => $this->request->getPost('total')[$key],
                    'grandtotal' => $this->request->getPost('grandtotalnon'),
                    'tanggal' => $tanggal,
                ];
                $this->db->table('bahanbaku')
                    ->set('stok', 'stok+' . $this->request->getPost('jumlah')[$key], false)
                    ->where('idbahanbaku', $this->request->getPost('idbahanbaku')[$key])
                    ->update();
            }
            $this->db->table('bahanbakupembelian')->insertBatch($simpan);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to('/internal/bahanbakupembeliandaftar');
        } else {
            $data = [
                'title' => 'Tambah Pembelian Bahan Baku',
                'bahanbaku' => $this->db->table('bahanbaku')->get()->getResult(),
            ];
            return view('internal/bahanbakupembeliantambah', $data);
        }
    }

    public function bahanbakupembelianedit($id)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if ($this->request->getMethod() === 'post') {
            $ambilpembelian = $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $id)->get()->getResult();
            foreach ($ambilpembelian as $pembelian) {
                $this->db->table('bahanbaku')
                    ->set('stok', 'stok-' . $pembelian->jumlah, false)
                    ->where('idbahanbaku', $pembelian->idbahanbaku)
                    ->update();
            }
            $this->db->table('bahanbakupembelian')->where('kode', $id)->delete();
            $tanggal = $this->request->getPost('tanggal');
            $idbahanbaku = $this->request->getPost('idbahanbaku');
            $simpan = [];
            foreach ($idbahanbaku as $key => $val) {
                $simpan[] = [
                    'kode' => $this->request->getPost('kode'),
                    'idbahanbaku' => $this->request->getPost('idbahanbaku')[$key],
                    'harga' => $this->request->getPost('harga')[$key],
                    'jumlah' => $this->request->getPost('jumlah')[$key],
                    'total' => $this->request->getPost('total')[$key],
                    'grandtotal' => $this->request->getPost('grandtotalnon'),
                    'tanggal' => $tanggal,
                ];
                $this->db->table('bahanbaku')
                    ->set('stok', 'stok+' . $this->request->getPost('jumlah')[$key], false)
                    ->where('idbahanbaku', $this->request->getPost('idbahanbaku')[$key])
                    ->update();
            }
            $this->db->table('bahanbakupembelian')->insertBatch($simpan);
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            return redirect()->to('/internal/bahanbakudaftar');
        } else {
            $data = [
                'title' => 'Edit Pembelian Bahan Baku',
                'id' => $id,
                'bahanbaku' => $this->db->table('bahanbaku')->get()->getResult(),
                'row' => $this->db->table('bahanbakupembelian')->where('kode', $id)->get()->getRow()

            ];
            return view('internal/bahanbakupembelianedit', $data);
        }
    }

    public function bahanbakupembelianhapus($id)
    {
        $ambilpembelian = $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $id)->get()->getResult();
        foreach ($ambilpembelian as $pembelian) {
            $this->db->table('bahanbaku')
                ->set('stok', 'stok-' . $pembelian->jumlah, false)
                ->where('idbahanbaku', $pembelian->idbahanbaku)
                ->update();
        }
        $this->db->table('bahanbakupembelian')->where('kode', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/internal/bahanbakupembeliandaftar');
    }

    public function bahanbakupenggunaandaftar()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Daftar penggunaan Bahan Baku',
            'bahanbakupenggunaan' => $this->db->table('bahanbakupenggunaan')->join('bahanbaku', 'bahanbakupenggunaan.idbahanbaku = bahanbaku.idbahanbaku')->groupBy('kode')->get()->getResult()
        ];
        return view('internal/bahanbakupenggunaandaftar', $data);
    }

    public function bahanbakupenggunaantambah()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if ($this->request->getMethod() === 'post') {
            $kode = date('dmyHis');
            $tanggal = $this->request->getPost('tanggal');
            $idbahanbaku = $this->request->getPost('idbahanbaku');
            $simpan = [];
            foreach ($idbahanbaku as $key => $val) {
                $simpan[] = [
                    'kode' => $kode,
                    'idbahanbaku' => $this->request->getPost('idbahanbaku')[$key],
                    'jumlah' => $this->request->getPost('jumlah')[$key],
                    'tanggal' => $tanggal,
                ];
                $this->db->table('bahanbaku')
                    ->set('stok', 'stok-' . $this->request->getPost('jumlah')[$key], false)
                    ->where('idbahanbaku', $this->request->getPost('idbahanbaku')[$key])
                    ->update();
            }
            $this->db->table('bahanbakupenggunaan')->insertBatch($simpan);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to('/internal/bahanbakupenggunaandaftar');
        } else {
            $data = [
                'title' => 'Tambah penggunaan Bahan Baku',
                'bahanbaku' => $this->db->table('bahanbaku')->get()->getResult(),
            ];
            return view('internal/bahanbakupenggunaantambah', $data);
        }
    }

    public function bahanbakupenggunaanedit($id)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if ($this->request->getMethod() === 'post') {
            $ambilpenggunaan = $this->db->table('bahanbakupenggunaan')->join('bahanbaku', 'bahanbakupenggunaan.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $id)->get()->getResult();
            foreach ($ambilpenggunaan as $penggunaan) {
                $this->db->table('bahanbaku')
                    ->set('stok', 'stok+' . $penggunaan->jumlah, false)
                    ->where('idbahanbaku', $penggunaan->idbahanbaku)
                    ->update();
            }
            $this->db->table('bahanbakupenggunaan')->where('kode', $id)->delete();
            $tanggal = $this->request->getPost('tanggal');
            $idbahanbaku = $this->request->getPost('idbahanbaku');
            $simpan = [];
            foreach ($idbahanbaku as $key => $val) {
                $simpan[] = [
                    'kode' => $this->request->getPost('kode'),
                    'idbahanbaku' => $this->request->getPost('idbahanbaku')[$key],
                    'jumlah' => $this->request->getPost('jumlah')[$key],
                    'tanggal' => $tanggal,
                ];
                $this->db->table('bahanbaku')
                    ->set('stok', 'stok-' . $this->request->getPost('jumlah')[$key], false)
                    ->where('idbahanbaku', $this->request->getPost('idbahanbaku')[$key])
                    ->update();
            }
            $this->db->table('bahanbakupenggunaan')->insertBatch($simpan);
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            return redirect()->to('/internal/bahanbakudaftar');
        } else {
            $data = [
                'title' => 'Edit penggunaan Bahan Baku',
                'id' => $id,
                'bahanbaku' => $this->db->table('bahanbaku')->get()->getResult(),
                'row' => $this->db->table('bahanbakupenggunaan')->where('kode', $id)->get()->getRow()

            ];
            return view('internal/bahanbakupenggunaanedit', $data);
        }
    }

    public function bahanbakupenggunaanhapus($id)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $ambilpenggunaan = $this->db->table('bahanbakupenggunaan')->join('bahanbaku', 'bahanbakupenggunaan.idbahanbaku = bahanbaku.idbahanbaku')->where('kode', $id)->get()->getResult();
        foreach ($ambilpenggunaan as $penggunaan) {
            $this->db->table('bahanbaku')
                ->set('stok', 'stok+' . $penggunaan->jumlah, false)
                ->where('idbahanbaku', $penggunaan->idbahanbaku)
                ->update();
        }
        $this->db->table('bahanbakupenggunaan')->where('kode', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/internal/bahanbakupenggunaandaftar');
    }

    public function laporanstokbahanbakudaftar()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if (session('level') == 'Pemilik Toko') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        $data = [
            'title' => 'Laporan Bahan Baku',
            'bahanbaku' => $this->db->table('bahanbaku')->get()->getResult()
        ];
        return view('internal/laporanstokbahanbakudaftar', $data);
    }


    public function laporanstokbahanbakudaftarcetak()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Laporan Bahan Baku',
            'bahanbaku' => $this->db->table('bahanbaku')->get()->getResult()
        ];
        return view('internal/laporanstokbahanbakudaftarcetak', $data);
    }

    public function laporanpembelianbahanbakudaftar()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if (session('level') == 'Pemilik Toko') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        if (!empty($this->request->getPost('tanggalawal'))) {
            $tanggalawal = $this->request->getPost('tanggalawal');
            $tanggalakhir = $this->request->getPost('tanggalakhir');
            $query = $this->db->table('bahanbakupembelian')->where('tanggal >=', $tanggalawal)->where('tanggal <=', $tanggalakhir)->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->groupBy('kode')->get()->getResult();
        } else {
            $tanggalawal = "kosong";
            $tanggalakhir = "kosong";
            $query = $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->groupBy('kode')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Pembelian Bahan Baku',
            'bahanbakupembelian' => $query
        ];
        return view('internal/laporanpembelianbahanbakudaftar', $data);
    }


    public function laporanpembelianbahanbakudaftarcetak($tanggalawal, $tanggalakhir)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        if ($tanggalawal != "kosong") {
            $query = $this->db->table('bahanbakupembelian')->where('tanggal >=', $tanggalawal)->where('tanggal <=', $tanggalakhir)->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->groupBy('kode')->get()->getResult();
        } else {
            $query = $this->db->table('bahanbakupembelian')->join('bahanbaku', 'bahanbakupembelian.idbahanbaku = bahanbaku.idbahanbaku')->groupBy('kode')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Pembelian Bahan Baku',
            'bahanbakupembelian' => $query
        ];
        return view('internal/laporanpembelianbahanbakudaftarcetak', $data);
    }

    public function laporanpemesanan()
    {
        if (session('level') == 'Pemilik Toko') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        if (!empty($this->request->getPost('tanggalawal'))) {
            $tanggalawal = $this->request->getPost('tanggalawal');
            $tanggalakhir = $this->request->getPost('tanggalakhir');
            $query = $this->db->table('pembelian')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idbeli', 'desc')->get()->getResult();
        } else {
            $tanggalawal = "kosong";
            $tanggalakhir = "kosong";
            $query = $this->db->table('pembelian')->orderBy('idbeli', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Pemesanan',
            'riwayat' => $query
        ];
        return view('internal/laporanpemesanan', $data);
    }

    public function laporanpemesanancetak($tanggalawal, $tanggalakhir)
    {
        if ($tanggalawal != "kosong") {
            $query = $this->db->table('pembelian')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idbeli', 'desc')->get()->getResult();
        } else {
            $query = $this->db->table('pembelian')->orderBy('idbeli', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Pemesanan',
            'riwayat' => $query
        ];
        return view('internal/laporanpemesanancetak', $data);
    }

    public function laporanpengiriman()
    {
        if (session('level') == 'Pemilik Toko') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        if (!empty($this->request->getPost('tanggalawal'))) {
            $tanggalawal = $this->request->getPost('tanggalawal');
            $tanggalakhir = $this->request->getPost('tanggalakhir');
            $query = $this->db->table('pembelian')->where('jenispengiriman', 'Kurir')->where('statusbeli', 'Selesai')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idbeli', 'desc')->get()->getResult();
        } else {
            $tanggalawal = "kosong";
            $tanggalakhir = "kosong";
            $query = $this->db->table('pembelian')->where('jenispengiriman', 'Kurir')->where('statusbeli', 'Selesai')->orderBy('idbeli', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Pengiriman',
            'riwayat' => $query
        ];
        return view('internal/laporanpengiriman', $data);
    }

    public function laporanpengirimancetak($tanggalawal, $tanggalakhir)
    {
        if ($tanggalawal != "kosong") {
            $query = $this->db->table('pembelian')->where('jenispengiriman', 'Kurir')->where('statusbeli', 'Selesai')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idbeli', 'desc')->get()->getResult();
        } else {
            $query = $this->db->table('pembelian')->where('jenispengiriman', 'Kurir')->where('statusbeli', 'Selesai')->orderBy('idbeli', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Pengiriman',
            'riwayat' => $query
        ];
        return view('internal/laporanpengirimancetak', $data);
    }

    public function laporanpenjualan()
    {
        if (session('level') == 'Pemilik Toko') {
        } else {
            session()->setFlashdata('msg', 'Anda tidak mempunyai hak untuk mengakses halaman ini');
            return redirect()->to(base_url('internal/'));
        }
        if (!empty($this->request->getPost('tanggalawal'))) {
            $tanggalawal = $this->request->getPost('tanggalawal');
            $tanggalakhir = $this->request->getPost('tanggalakhir');
            $query = $this->db->table('pembelian')->where('statusbeli', 'Selesai')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idbeli', 'desc')->get()->getResult();
        } else {
            $tanggalawal = "kosong";
            $tanggalakhir = "kosong";
            $query = $this->db->table('pembelian')->where('statusbeli', 'Selesai')->orderBy('idbeli', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Penjualan',
            'riwayat' => $query
        ];
        return view('internal/laporanpenjualan', $data);
    }

    public function laporanpenjualancetak($tanggalawal, $tanggalakhir)
    {
        if ($tanggalawal != "kosong") {
            $query = $this->db->table('pembelian')->where('statusbeli', 'Selesai')->where('date(waktu) >=', $tanggalawal)->where('date(waktu) <=', $tanggalakhir)->orderBy('idbeli', 'desc')->get()->getResult();
        } else {
            $query = $this->db->table('pembelian')->where('statusbeli', 'Selesai')->orderBy('idbeli', 'desc')->get()->getResult();
        }
        $data = [
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'title' => 'Laporan Penjualan',
            'riwayat' => $query
        ];
        return view('internal/laporanpenjualancetak', $data);
    }

    public function profiledit()
    {
        $idpengguna = session('idpengguna');
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data = [
            'title' => 'Edit Profil',
            'validation' => \Config\Services::validation(),
            'pengguna' => $this->penggunaModel->find($idpengguna),
        ];
        return view('internal/profiledit', $data);
    }


    public function updateprofil($idpengguna)
    {
        $this->penggunaModel->save([
            'idpengguna' => $idpengguna,
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'nohp' => $this->request->getVar('nohp'),
            'password' => $this->request->getVar('password'),
        ]);
        session()->setFlashdata('pesan', 'Profil berhasil diubah.');
        return redirect()->to('/internal/profiledit');
    }
}
