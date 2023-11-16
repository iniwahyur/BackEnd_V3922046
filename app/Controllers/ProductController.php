<?php

namespace App\Controllers;
use App\Models\ProductModel;
use codeigniter\API\ResponseTrait;
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
            // Validation failed, display errors
            $data['validation'] = $this->validator;
            return view('add_product', $data);
        }
    }

    return view('add_product');
}

public function insertProductApi() {
    $requestData = $this->request->getJSON();

    $validation = $this->validate([
        'nama_product' => 'required',
        'description' => 'required'
    ]);

    if (!$validation) {
        $this->response->setStatusCode(400);
        return $this->response->setJSON([
            'code'=> 400,
            'status'=> 'BAD REQUEST',
            'data' => null
        ]);
    }

    $data = [
        'nama_product' => $requestData->nama_product,
        'description' => $requestData->description
    ];

    $insert = $this->product->insertProduct($data);

    if ($insert) {
        return $this->respond([
            'code'=> 200,
            'status'=> 'OK',
            'data'=> $data
        ]);
    } else {
        $this->response->setStatusCode(500);
        return $this->response->setJSON([
            'code'=> 500,
            'status'=> 'INTERNAL SERVER ERROR',
            'data' => null
        ]);
    }
}

    public function readProduct(){
        $products = $this->product->findAll();
        $data = [
            'product' => $products
        ];
        return view('product', $data);
    }


    public function readProductApi(){
        $products = $this->product->findAll();

        return $this->respond(
            [
                'code' => 200,
                'status' => "OK",
                'data' => $products
            ]
        );
    }

    
    public function getProduct($id) {

        $product = $this->product->where('id',$id)->first();
        $data = [
            'product' => $product
        ];
        return view('edit_product', $data);
    }


    public function getProductApi($id){
        $product = $this->product->where('id', $id)->first();

        if (!$product){
            $this->response->setStatusCode(404);
            return $this->response->setJSON(
            [
                'code' => 404,
                'status' => "NOT FOUND",
                'data' => "product not found"
            ]
        );   
    }
        return $this->respond(
            [
                'code' => 200,
                'status' => "OK",
                'data' => $product
            ]
        );
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

    public function updateProductApi($id) {
        $requestData = $this->request->getJSON();
    
        $validation = $this->validate([
            'nama_product' => 'required',
            'description' => 'required',
        ]);
    
        if (!$validation) {
            $this->response->setStatusCode(400);
            return $this->response->setJSON([
                'code'=> 400,
                'status'=> 'BAD REQUEST',
                'data' => 'null'
            ]);
        }
    
        $data = [
            'nama_product' => $requestData->nama_product,
            'description' => $requestData->description,
        ];
    
        $update = $this->product->update($id, $data);
    
        if ($update) {
            return $this->respond([
                'code'=> 200,
                'status'=> 'OK',
                'data'=> $data
            ]);
        } else {
            $this->response->setStatusCode(500);
            return $this->response->setJSON([
                'code'=> 500,
                'status'=> 'INTERNAL SERVER ERROR',
                'data' => 'null'
            ]);
        }
    }

    
    public function deleteProduct($id) {
        $this->product->delete($id);
        return redirect()->to(base_url('readproduct'));
    }

    public function deleteProductApi($id) {
        // Assuming you have a deleteProduct method in your model to handle deletion
        $delete = $this->product->delete($id);
    
        if ($delete) {
            return $this->respond([
                'code'=> 200,
                'status'=> 'OK',
                'data'=> ['id' => $id]
            ]);
        } else {
            $this->response->setStatusCode(500);
            return $this->response->setJSON([
                'code'=> 500,
                'status'=> 'INTERNAL SERVER ERROR',
                'data' => null
            ]);
        }
    }
    

}