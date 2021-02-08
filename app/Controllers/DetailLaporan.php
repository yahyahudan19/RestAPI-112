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
