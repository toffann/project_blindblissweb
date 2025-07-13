<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
	protected $table = 'product'; 
	protected $primaryKey = 'id';
	    protected $allowedFields    = ['nama', 'harga', 'deskripsi', 'jumlah', 'foto', 'kategori', 'created_at', 'updated_at']; // Menamambahkan 'kategori'

}