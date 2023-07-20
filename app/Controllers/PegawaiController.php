<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Pegawai;

class PegawaiController extends ResourceController
{
    use ResponseTrait;  
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new Pegawai();
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
        $model = new Pegawai();
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
            'user_id' => ['rules' => 'required'],
            'name' => ['rules' => 'required'],
            'nohp'  => [ 'rules' => 'integer|min_length[10]|max_length[20]'],
            /*'foto' =>  [
                'uploaded[foto]',
                'mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]',
                'max_size[foto,4096]',
            ]*/
        ]; 
        $data = [
            'user_id' => $this->request->getVar('user_id'),
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'nohp' => $this->request->getVar('nohp'),
            'gender' => $this->request->getVar('gender'),
            'martialStatus' => $this->request->getVar('martialStatus'),
            'bod' => $this->request->getVar('bod'),
            'status' => 'active',
            'foto' => '',
            'startDate' => $this->request->getVar('startDate'),
            'endDate' => $this->request->getVar('endDate')
        ];

        $model = new Pegawai();
        $model->save($data);
        $response = [
            'status' => 201,
            'error' => false,
            'data'  => $model,
            'messages' => [
                'success' => 'Data Inserted'
            ]
        ];
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
            'user_id' => ['rules' => 'required'],
            'name' => ['rules' => 'required'],
            'nohp'  => [ 'rules' => 'integer|min_length[10]|max_length[20]'],
            /*'foto' =>  [
                'uploaded[foto]',
                'mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]',
                'max_size[foto,4096]',
            ]*/
        ]; 
        $data = [
            'user_id' => $this->request->getVar('user_id'),
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'nohp' => $this->request->getVar('nohp'),
            'gender' => $this->request->getVar('gender'),
            'martialStatus' => $this->request->getVar('martialStatus'),
            'bod' => $this->request->getVar('bod'),
            'status' => 'active',
            'foto' => '',
            'startDate' => $this->request->getVar('startDate'),
            'endDate' => $this->request->getVar('endDate'),
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

        $model = new Pegawai();
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
        $model = new Pegawai();
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

        $model->update($id, $data);
        $response = [
            'status' => 201,
            'error' => false,
            'data'  => $model,
            'messages' => [
                'success' => 'Data Inserted'
            ]
        ];
    }
}
