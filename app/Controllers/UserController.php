<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Users;

class UserController extends ResourceController
{
    use ResponseTrait;  
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new Users();
        // $limit = $this->request->getVar('limit');
        // $offset = $this->request->getVar('offset');
        $item = $model->where('deletedAt',null)->findAll();

        $data = [
            'status' => 200,
            'items' => $item
        ];

        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new Users();
        $model->where('deletedAt',null);
        $data = $model->find(['id'  => $id]);
        if (!$data) {
            $response = [
                'status' => 401,
                'data'   => [],
                'message'=> 'data is not found'
            ];
        }

        $response = [
            'status' => 200,
            'data'   => $data[0],
            'message'=> 'success'
        ];

        return $this->respond($response);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
        ]; 
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        
        if(!$this->validate($rules)) 
        {
            $response = [
                'status' => 409,
                'error' => true,
                'data'  => [],
                'messages' => $this->validator->getErrors()
            ];
            
        }
        
        $model = new Users();
        $model->save($data);
        $response = [
            'status' => 201,
            'error' => false,
            'data'  => $model,
            'messages' => [
                'success' => 'Data Inserted'
            ]
        ];
        
        
        return $this->respondCreated($response);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
        ]; 
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        
        if(!$this->validate($rules)) 
        {
            $response = [
                'status' => 409,
                'error' => true,
                'data'  => [],
                'messages' => $this->validator->getErrors()
            ];
            
        }

        $model = new Users();
        $find = $model->find(['id' => $id]);
        if(!$find){
            $response = [
                'status' => 409,
                'error' => true,
                'data'  => [],
                'messages' => 'Data not found'
            ];
            
        }

        $model->update($id, $data);
        $response = [
            'status' => 201,
            'error' => false,
            'data'  => $model,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new users();
        $find = $model->find(['id' => $id]);
        if(!$find){
            $response = [
                'status' => 409,
                'error' => true,
                'data'  => [],
                'messages' => 'Data not found'
            ];
            
        }
        $data = [
            'deletedAt' => date('Y-m-d H:i:s')
        ];
        $model->update($id,$data);
        
        $response = [
            'status' => 200,
            'error' => false,
            'messages' => [
                'success' => 'Data deleted'
            ]
        ];
        return $this->respond($response);
    }

    public function option() {
        $model = new Users();
        $model->where('deletedAt',null)->findAll();
        $option = [];
        foreach ($model as $value) {
            $option = [
                [$value->id] => $value->email
            ];
        }

        $data = [
            'status' => 200,
            'items' => $item
        ];
        return $this->respond($response);
    }
}
