<?php

namespace App\Controllers;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class ProductController extends BaseController {

    use ResponseTrait;

    protected $product;
    public function __construct(){
        $this->product = new ProductModel();
    }

    public function insertProduct() {
        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nama_product' => 'required',
                'description' => 'required',
            ];
    
            if ($this->validate($validationRules)) {
                $data = [
                    'nama_product' => $this->request->getPost('nama_product'),
                    'description' => $this->request->getPost('description'),
                ];
    
                $this->product->insert($data);
                return redirect()->to(base_url('readproduct'));
            } else {
                return view('add_product');
            }
        }
    
        return view('add_product');
    }
    

    public function readProduct(){
        $products = $this->product->findAll();
        $data = [
            'product' => $products
        ];
        return view('product', $data);
    }

    public function getProduct($id) {

        $product = $this->product->where('id',$id)->first();
        $data = [
            'product' => $product
        ];
        return view('edit_product', $data);
    }

    public function updateProduct($id) {
        $nama_product = $this->request->getVar('nama_product');
        $description = $this->request->getVar('description');
        
        $data = [
            'nama_product' => $nama_product,
            'description' => $description
        ];
        $this->product->update($id, $data);
        return redirect()->to(base_url('readproduct'));
    }

    public function deleteProduct($id) {
        $this->product->delete($id);
        return redirect()->to(base_url('readproduct'));
    }

    public function readProductApi(){
        $products = $this->product->findAll();
        
        return $this->respond([
            'code' => 200,
            'status' => 'OK',
            'data' => $products
        ]);

    }

    public function getProductApi($id) {
        $product = $this->product->where("id", $id)->first();

        if (!$product){
            $this->response->setStatusCode(404);
            return $this->response->setJSON(
                [
                    'code' => 404,
                    'status' => 'NOT FOUND',
                    'data' => 'product not found'
                ]
            );
        }

        return $this->respond([
            'code' => 200,
            'status' => 'OK',
            'data' => $product
        ]);
    }
}
