<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\PenggunaModel;

use App\Models\PembelianModel;
use App\Models\PembayaranModel;
use App\Controllers\BaseController;
use App\Models\PembelianprodukModel;

class Home extends BaseController
{

    protected $kategoriModel;
    protected $produkModel;
    protected $penggunaModel;
    protected $pembelianModel;
    protected $pembelianprodukModel;
    protected $pembayaranModel;
    protected $db;

    protected $helpers = ['form','fungsi'];

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

    public function login()
    {
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();
        return view('home/login', $data);
    }

    public function register()
    {
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();
        return view('home/register', $data);
    }

    public function registersimpan()
    {
        $this->penggunaModel->save([
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'nohp' => $this->request->getVar('nohp'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level')
        ]);

        session()->setFlashdata('alert', 'Pendaftaran Berhasil');

        return redirect()->to('/home/index');
    }


    public function doLogin()
    {
        $session = session();
        // Validasi input
        $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        // Ambil data dari input form
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Cari pengguna berdasarkan alamat email
        $pengguna = $this->penggunaModel->where('email', $email)->first();
        if ($pengguna) {
            $pass = $pengguna['password'];
            if ($password === $pass) {
                if ($pengguna['level'] == 'Super Admin') {
                    $ses_data = [
                        'idpengguna' => $pengguna['idpengguna'],
                        'nama' => $pengguna['nama'],
                        'email' => $pengguna['email'],
                        'level' => $pengguna['level'],
                        'nohp' => $pengguna['nohp'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    session()->setFlashdata('alert', 'Anda berhasil login');
                    return redirect()->to('/internal');
                } elseif ($pengguna['level'] == 'Pembeli') {
                    $ses_data = [
                        'idpengguna' => $pengguna['idpengguna'],
                        'nama' => $pengguna['nama'],
                        'email' => $pengguna['email'],
                        'nohp' => $pengguna['nohp'],
                        'level' => $pengguna['level'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    session()->setFlashdata('alert', 'Anda berhasil login');
                    return redirect()->to('/home');
                } elseif ($pengguna['level'] == 'Pemilik Toko') {
                    $ses_data = [
                        'idpengguna' => $pengguna['idpengguna'],
                        'nama' => $pengguna['nama'],
                        'email' => $pengguna['email'],
                        'nohp' => $pengguna['nohp'],
                        'level' => $pengguna['level'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    session()->setFlashdata('alert', 'Anda berhasil login');
                    return redirect()->to('/internal');
                } elseif ($pengguna['level'] == 'Pegawai') {
                    $ses_data = [
                        'idpengguna' => $pengguna['idpengguna'],
                        'nama' => $pengguna['nama'],
                        'email' => $pengguna['email'],
                        'nohp' => $pengguna['nohp'],
                        'level' => $pengguna['level'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    session()->setFlashdata('alert', 'Anda berhasil login');
                    return redirect()->to('/internal');
                }
            } else {
                $session->setFlashdata('msg', 'Password salah');

                return redirect()->to('/home/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email tidak terdaftar');
            return redirect()->to('/home/login');
        }
    }

    public function logout()
    {
        // Hapus session pengguna
        $session = session();
        $session->remove(['idpengguna', 'nama', 'email', 'nohp', 'level', 'isLoggedIn', 'keranjang']);
        session()->setFlashdata('alert', 'Anda Telah Logout');
        // Redirect ke halaman setelah logout
        return redirect()->to('/home');
    }



    public function index()
    {
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();
        return view('home/index', $data);
    }

    public function produk()
    {
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();
        return view('home/produk', $data);
    }

    public function kategori($id_kategori)
    {
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $carikategori = $this->kategoriModel->where('id_kategori', $id_kategori)->first();
        $cariproduk = $this->produkModel->getProduk($id_kategori);

        $data['datakategori'] = $carikategori;
        $data['dataproduk'] = $cariproduk;


        return view('home/kategori', $data);
    }

    public function detail($id_produk)
    {
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $cariproduk = $this->produkModel->where('id_produk', $id_produk)->first();
        $data['dataproduk'] = $cariproduk;

        return view('home/detail', $data);
    }

    public function keranjangtambah()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->setFlashdata('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }

        $id_produk = $this->request->getVar('id_produk'); // Ambil ID produk dari form
        $jumlah = $this->request->getVar('jumlah'); // Ambil kuantitas dari form

        $keranjang = session()->get('keranjang'); // Ambil keranjang dari sesi

        if ($keranjang === null) {
            // Jika keranjang tidak ada dalam sesi, inisialisasi sebagai array kosong
            $keranjang = [];
        }

        // Tambahkan produk ke keranjang atau update kuantitas jika produk sudah ada
        if (isset($keranjang[$id_produk])) {
            $keranjang[$id_produk] += $jumlah;
        } else {
            $keranjang[$id_produk] = $jumlah;
        }

        session()->set('keranjang', $keranjang); // Simpan keranjang ke sesi
        session()->setFlashdata('alert', 'Berhasil menambahkan barang ke keranjang');
        return redirect()->to('/home/keranjang'); // Redirect ke halaman keranjang
    }

    public function keranjang()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->setFlashdata('alert', 'Anda belum login. Silakan login terlebih dahulu.');

            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $keranjang = session()->get('keranjang'); // Ambil keranjang dari sesi'
        $data['keranjang'] = $keranjang;
        return view('home/keranjang', $data); // Tampilkan tampilan keranjang dengan data keranjang
    }

    public function keranjanghapus($id_produk)
    {

        $keranjang = session()->get('keranjang'); // Ambil keranjang dari sesi

        if (isset($keranjang[$id_produk])) {
            unset($keranjang[$id_produk]); // Hapus item keranjang berdasarkan ID produk
            session()->set('keranjang', $keranjang); // Simpan kembali keranjang yang telah dihapus ke sesi
        }


        return redirect()->to('/home/keranjang'); // Redirect ke halaman keranjang
    }

    public function checkout()
    {
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }

        $keranjang = session()->get('keranjang'); // Ambil keranjang dari sesi'
        $data['keranjang'] = $keranjang;

        $caripengguna = session()->get('idpengguna');
        $pengguna = $this->penggunaModel->where('idpengguna', $caripengguna)->first();
        $data['pengguna'] = $pengguna;
        return view('home/checkout', $data);
    }

    public function doCheckout()
    {

        $notransaksi = '#TP' . date("Ymdhis");
        $id = session()->get('idpengguna');
        $tanggalbeli = date("Y-m-d");
        $waktu = date("Y-m-d H:i:s");
        $totalbeli = $this->request->getVar('dua');
        $alamatpengirim = $this->request->getVar('alamatpengiriman');
        $kota = $this->request->getVar('kota');
        $ongkir = $this->request->getVar('ongkir');
        if ($kota == "Ambil Sendiri") {
            $jenispengiriman  = "Ambil Sendiri";
            $kota = "Bekasi";
        } else {
            $jenispengiriman  = "Kurir";
        }
        $this->pembelianModel->save([
            'notransaksi' => $notransaksi,
            'id' => $id,
            'tanggalbeli' => $tanggalbeli,
            'totalbeli' => $totalbeli,
            'alamatpengiriman' => $alamatpengirim,
            'jenispengiriman ' => $jenispengiriman,
            'kota' => $kota,
            'ongkir' => $ongkir,
            'statusbeli' => 'Belum Bayar',
            'waktu' => $waktu
        ]);

        $keranjang = session()->get('keranjang');
        $idbeli = $this->pembelianModel->getInsertID();

        foreach ($keranjang as $id_produk => $jumlah) {
            $produk = $this->produkModel->where('id_produk', $id_produk)->first();
            $totalharga = $produk['harga_produk'] * $jumlah;
            $nama = $produk['nama_produk'];
            $harga = $produk['harga_produk'];

            $this->pembelianprodukModel->save([
                'idbeli' => $idbeli,
                'id_produk' => $produk['id_produk'],
                'nama' => $nama,
                'harga' => $harga,
                'subharga' => $totalharga,
                'jumlah' => $jumlah,
            ]);
        }


        unset($_SESSION["keranjang"]);
        session()->setFlashdata('alert', 'Berhasil Checkout');
        return redirect()->to('/home/riwayat');
    }

    public function riwayat()
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }

        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $idpengguna = session()->get('idpengguna');
        $data['idpengguna'] = $idpengguna;


        $databeli = $this->pembelianModel->leftJoin($idpengguna);


        $dataproduk = [];
        foreach ($databeli as $row) {
            $idbeli = $row['idbelireal'];
            $produk = $this->pembelianprodukModel->join($idbeli);
            $dataproduk[$idbeli] = $produk;
        }

        // $databeli = array_reverse($databeli);
        $data['databeli'] = $databeli;
        $data['dataproduk'] = $dataproduk;

        return view('home/riwayat', $data);
    }
    

    public function pembayaran($idbelireal)
    {
        // Periksa apakah pengguna sudah login atau tidak
        if (!session()->get('isLoggedIn')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            return redirect()->to('/home/login'); // Ganti dengan URL halaman login Anda 
        }
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();

        $idpengguna = session()->get('idpengguna');
        $data['idpengguna'] = $idpengguna;

        $idbeli = $idbelireal;
        $pembelian = $this->pembelianModel->joinPengguna($idbeli);
        $datapembelian = $pembelian;
        $produk = $this->pembelianprodukModel->where('idbeli', $idbeli)->findAll();

        $data['datapembelian'] = $datapembelian;
        $data['dataproduk'] = $produk;
        // dd($data['dataproduk']);
        return view('home/pembayaran', $data);
    }

    public function pembayaransimpan($idbeli)
    {

        $fileBukti = $this->request->getFile('bukti');
        $namaUer = $this->request->getVar('nama');
        $namaBukti = date("YmdHis") . '_' . $namaUer;
        // pindahkan gambar
        $fileBukti->move('bukti', $namaBukti);

        // $idbeli = $this->request->getVar('idbeli');
        $tanggaltransfer = $this->request->getVar('tanggaltransfer');
        $tanggal = date("Y-m-d");

        $this->pembayaranModel->save([
            'idbeli' => $idbeli,
            'nama' => $this->request->getVar('nama'),
            'tanggaltransfer' => $tanggaltransfer,
            'tanggal' => $tanggal,
            'bukti' => $namaBukti,
        ]);

        $this->pembelianModel->save([
            'idbeli' => $idbeli,
            'statusbeli' => 'Sudah Upload Bukti Pembayaran'
        ]);
        session()->setFlashdata('alert', 'Terima Kasih, mohon menunggu Pesanan anda');
        return redirect()->to('/home/riwayat');
    }

    public function selesai()
    {
        $idbeli = $this->request->getVar('idbeli');
        $this->pembelianModel->save([
            'idbeli' => $idbeli,
            'statusbeli' => 'Selesai'
        ]);

        session()->setFlashdata('alert', 'Terima Kasih');

        return redirect()->to('/home/riwayat');
    }

    public function profil($idpengguna)
    {
        $data['title'] = 'Amanah Fried Chicken';
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['produk'] = $this->produkModel->getAll();
        $data['pengguna'] = $this->penggunaModel->find($idpengguna);

        return view('home/profil', $data);
    }

    public function profilubah($idpengguna)
    {
        $pass = $this->request->getVar('password');
        if ($pass == "") {
            $password = $this->request->getVar('passwordlama');
        } else {
            $password = $this->request->getVar('password');
        }

        $this->penggunaModel->save([
            'idpengguna' => $idpengguna,
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'nohp' => $this->request->getVar('nohp'),
            'password' => $password
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah');
        return redirect()->to('/home/profil/' . $idpengguna);
    }
}
