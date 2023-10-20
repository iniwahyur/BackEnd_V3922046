<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    protected $table = 'products';

    protected $returnType = 'object';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'nama_product', 'description'];

    public function insertProduct($data)
    {
        $query = "INSERT INTO products (nama_product, description) VALUES (?, ?)";
        $this->db->query($query, [$data['nama_product'], $data['description']]);
        return $this->db->insertID();
    }

}
?>