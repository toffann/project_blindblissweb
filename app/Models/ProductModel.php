<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
	protected $table = 'product'; 
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'nama', 'harga', 'harga_lama', 'deskripsi', 'jumlah', 'foto', 'created_at', 'updated_at'
	];  
}