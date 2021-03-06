<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DetailLaporanModel;

class DetailLaporan extends ResourceController
{
    use ResponseTrait;

    // Get All News
    public function index()
    {
        $model = new DetailLaporanModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
    // Get Single News
    public function show($id = null)
    {
        $model = new DetailLaporanModel();
        $data = $model->getWhere(['id_feedback' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Mboten ditemukan :(' . $id);
        }
    }

    // create a DetailLaporan
    public function create()
    {
        $model = new DetailLaporanModel();
        $data = [
            'report_id' => $this->request->getPost('report_id'),
            'gambar' => $this->request->getPost('gambar')
        ];
        $data = json_decode(file_get_contents("php://input"));
        $data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($data, 201);
    }

    // update Detail Laporan
    public function update($id = null)
    {
        $model = new DetailLaporanModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'report_id' => $json->report_id,
                'gambar' => $json->gambar
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'report_id' => $input['report_id'],
                'gambar' => $input['gambar']
            ];
        }
        // Insert to Database
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }
    
    // Delete News
    public function delete($id = null)
    {
        $model = new DetailLaporanModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data Mboten ditemukan :( ' . $id);
        }
    }
}
