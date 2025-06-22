<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    protected $product;

    function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
    }

    public function index()
    {
        $product = $this->product->findAll();
        $data['product'] = $product;
        return view('v_home', $data);
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


    public function keranjang($id = null)
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
}
