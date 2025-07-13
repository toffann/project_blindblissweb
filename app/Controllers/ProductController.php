<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Dompdf\Dompdf;

class ProductController extends BaseController
{
    protected $product;
    protected $categories = ['blind boxes', 'accessories', 'action figures']; // Mendefinisikan kategori


    function __construct()
    {
        $this->product = new ProductModel();
    }


    public function index()
    {
        $product = $this->product->findAll();
        $data['product'] = $product;
        $data['categories'] = $this->categories; // Meneruskan kategori ke view v_produk

        return view('v_produk', $data);
    }

    public function create()
    {
        $dataFoto = $this->request->getFile('foto');

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'jumlah' => $this->request->getPost('jumlah'),
            'kategori' => $this->request->getPost('kategori'), // Menambahkan kategori
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataForm['foto'] = $fileName;
            $dataFoto->move('NiceAdmin/assets/img/', $fileName);
        }

        $this->product->insert($dataForm);

        return redirect('produk')->with('success', 'Data Berhasil Ditambah');
    }
    public function edit($id)
    {
        $dataProduk = $this->product->find($id);

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'jumlah' => $this->request->getPost('jumlah'),
            'kategori' => $this->request->getPost('kategori'), // Menambahkan kategori
            'updated_at' => date("Y-m-d H:i:s")
        ];

       if ($this->request->getPost('check') == 1) {
            if ($dataProduk['foto'] != '' and file_exists("NiceAdmin/assets/img/" . $dataProduk['foto'] . "")) { 
                unlink("NiceAdmin/assets/img/" . $dataProduk['foto']);
            }
            
            $dataFoto = $this->request->getFile('foto');

            if ($dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('NiceAdmin/assets/img/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->product->update($id, $dataForm);

        return redirect('produk')->with('success', 'Data Berhasil Diubah');
    }

     public function delete($id)
    {
        $dataProduk = $this->product->find($id);

        if ($dataProduk['foto'] != '' and file_exists("NiceAdmin/assets/img/" . $dataProduk['foto'] . "")) { 
            unlink("NiceAdmin/assets/img/" . $dataProduk['foto']); 
        }

        $this->product->delete($id);

        return redirect('produk')->with('success', 'Data Berhasil Dihapus');
    }


    public function download()
    {
        //get data from database
        $product = $this->product->findAll();

        //pass data to file view
        $html = view('v_produkPDF', ['product' => $product]);

        //set the pdf filename
        $filename = date('y-m-d-H-i-s') . '-produk';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content (file view)
        $dompdf->loadHtml($html);

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }

    // method untuk detail prosuk
    public function detail($id)
    {
        $model = new \App\Models\ProductModel();
        $produk = $model->find($id);
    
        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Produk dengan ID $id tidak ditemukan.");
        }
    
         // Ambil produk terkait (semua produk kecuali produk yang sedang dilihat)
        $recommendedProducts = $model->where('id !=', $id)
                                    ->where('kategori', $produk['kategori']) // ADDED: Filter rekomendasi berdasarkan kategori
                                    ->findAll();

        // Debugging: Cek apakah produk terkait ditemukan
        if (empty($recommendedProducts)) {
            log_message('info', 'Tidak ada produk terkait ditemukan untuk produk ID: ' . $id);
        } else {
            log_message('info', 'Produk terkait ditemukan: ' . json_encode($recommendedProducts));
        }
    
        $data = [
            'produk_id' => $produk['id'],
            'produk_name' => $produk['nama'],
            'produk_price' => $produk['harga'],
            'produk_old_price' => $produk['harga_lama'] ?? $produk['harga'],
            'produk_description' => $produk['deskripsi'],
            'produk_image' => $produk['foto'],
             'produk_kategori' => $produk['kategori'], // Menambahkan kategori produk utama
            'page_title' => 'Detail Produk',
            'recommended_products' => $recommendedProducts // Menambahkan produk terkait ke data
        ];
    
        return view('v_detail_produk', $data);
    }


}
