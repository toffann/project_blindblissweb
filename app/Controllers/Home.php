<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;
    protected $categories = ['blind boxes', 'accessories', 'action figures']; // Daftar kategori


    function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel;
        $this->transaction_detail = new TransactionDetailModel;
    }

    public function index()
    {
        $sort = $this->request->getGet('sort');
        $category = $this->request->getGet('category'); // Ambil parameter kategori
        
        $query = $this->product; // ADDED: Inisialisasi query builder

        // Menambahkan filter kategori jika ada
        if (!empty($category) && in_array($category, $this->categories)) {
            $query = $query->where('kategori', $category);
        }

        if ($sort === 'price_asc') {
            $product = $this->product->orderBy('harga', 'ASC')->findAll();
        } elseif ($sort === 'price_desc') {
            $product = $this->product->orderBy('harga', 'DESC')->findAll();
        } else {
            $product = $this->product->findAll();
        }
        $data['product'] = $product;
        $data['sort'] = $sort; // pass current sort to view
        $data['current_category'] = $category; // AMengirim kategori aktif ke view
        $data['categories'] = $this->categories; // Mengirim daftar kategori ke view

        return view('v_home', $data);
    }

    public function history()
    {
        $username = session()->get('username');
        $data['username'] = $username;

        $buy = $this->transaction->where('username', $username)->findAll();
        $data['buy'] = $buy;

        $product = [];

        if (!empty($buy)) {
            foreach ($buy as $item) {
                $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

                if (!empty($detail)) {
                    $product[$item['id']] = $detail;
                }
            }
        }

        $data['product'] = $product;

        return view('v_history', $data);
    }

    // bagian metode hello unutk menampilkan data product dan kategori
    public function hello($name = null)
    {
        $data['nama'] = $name;
        $data['title'] = "Judul halaman";
        return view('front', $data);
    }

    public function produk()
    {
        $data = [
            'title' => 'Produk'
        ];
        echo view('layout/header', $data);
        echo view('layout/sidebar');
        echo view('content/produk');
        echo view('layout/footer');
    }


    // ADDED: Metode untuk menampilkan halaman F.A.Q
    public function faq()
    {
        $data['title'] = "F.A.Q"; // Menetapkan judul halaman untuk breadcrumb atau title tag
        // Anda bisa menambahkan data lain yang dibutuhkan untuk halaman FAQ di sini
        // Misalnya, daftar pertanyaan dan jawaban dari database atau array statis
        return view('v_faq', $data); // Merender view v_faq.php
    }

    
    /*public function keranjang($id = null)
    {
        $data = [
            'kat' => [
                'Alat Tulis',
                'Pakaian',
                'Pertukangan',
                'Elektronik',
                'Snack'
            ],
        ];
        $meta = ['title' => 'kategori'];
        if (!is_null($id)) {
            echo $data['kat'][$id];
        } else {
            echo view('layout/header', $meta);
            echo view('layout/sidebar');
            echo view('content/keranjang', $data);
            echo view('layout/footer');
        }
    }
    // return view itu untuk mengembalikan file ke dalam folder view
    */

}
    
