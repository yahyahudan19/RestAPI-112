<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FeedbackModel;

class Feedback extends ResourceController
{
    use ResponseTrait;

    // Get All News
    public function index()
    {
        $model = new FeedbackModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
    // Get Single Feedback
    public function show($id = null)
    {
        $model = new FeedbackModel();
        $data = $model->getWhere(['id_feedback' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Mboten ditemukan :(' . $id);
        }
    }
    // create a Feedback
    public function create()
    {
        $model = new FeedbackModel();
        $data = [
            'nama_feedback' => $this->request->getPost('nama_feedback'),
            'alamat_feedback' => $this->request->getPost('alamat_feedback'),
            'noHp_feedback' => $this->request->getPost('noHp_feedback'),
            'penyebab_feedback' => $this->request->getPost('penyebab_feedback'),
            'q1_feedback' => $this->request->getPost('q1_feedback'),
            'q2_feedback' => $this->request->getPost('q2_feedback'),
            'q3_feedback' => $this->request->getPost('q3_feedback'),
            'q4_feedback' => $this->request->getPost('q4_feedback'),
            'q5_feedback' => $this->request->getPost('q5_feedback')
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

    // update feedback
    public function update($id = null)
    {
        $model = new FeedbackModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'nama_feedback' => $json->nama_feedback,
                'alamat_feedback' => $json->alamat_feedback,
                'noHp_feedback' => $json->noHp_feedback,
                'penyebab_feedback' => $json->penyebab_feedback,
                'q1_feedback' => $json->q1_feedback,
                'q2_feedback' => $json->q2_feedback,
                'q3_feedback' => $json->q3_feedback,
                'q4_feedback' => $json->q4_feedback,
                'q5_feedback' => $json->q5_feedback
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'nama_feedback' => $input['nama_feedback'],
                'alamat_feedback' => $input['alamat_feedback'],
                'noHp_feedback' => $input['noHp_feedback'],
                'penyebab_feedback' => $input['penyebab_feedback'],
                'q1_feedback' => $input['q1_feedback'],
                'q2_feedback' => $input['q2_feedback'],
                'q3_feedback' => $input['q3_feedback'],
                'q4_feedback' => $input['q4_feedback'],
                'q5_feedback' => $input['q5_feedback']
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

    // Delete Feedback
    public function delete($id = null)
    {
        $model = new FeedbackModel();
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
