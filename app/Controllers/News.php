<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NewsModel;

class News extends ResourceController
{
    use ResponseTrait;

    // Get All News
    public function index()
    {
        $model = new NewsModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
    // Get Single News
    public function show($id = null)
    {
        $model = new NewsModel();
        $data = $model->getWhere(['id_news' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Mboten ditemukan :(' . $id);
        }
    }
    // create a news
    public function create()
    {
        $model = new NewsModel();
        $data = [
            'tagline_news' => $this->request->getPost('tagline_news'),
            'date_news' => $this->request->getPost('date_news'),
            'judul_news' => $this->request->getPost('judul_news'),
            'isi_news' => $this->request->getPost('isi_news'),
            'isi2_news' => $this->request->getPost('isi2_news'),
            'isi3_news' => $this->request->getPost('isi3_news'),
            'isi4_news' => $this->request->getPost('isi4_news'),
            'visible_news' => $this->request->getPost('visible_news'),
            'dokumentasi_news' => $this->request->getPost('dokumentasi_news'),
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

    // update News
    public function update($id = null)
    {
        $model = new NewsModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'tagline_news' => $json->tagline_news,
                'date_news' => $json->date_news,
                'judul_news' => $json->judul_news,
                'isi_news' => $json->isi_news,
                'isi2_news' => $json->isi2_news,
                'isi3_news' => $json->isi3_news,
                'isi4_news' => $json->isi4_news,
                'visible_news' => $json->visible_news,
                'dokumentasi_news' => $json->dokumentasi_news
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'tagline_news' => $input['tagline_news'],
                'date_news' => $input['date_news'],
                'judul_news' => $input['judul_news'],
                'isi_news' => $input['isi_news'],
                'isi2_news' => $input['isi2_news'],
                'isi3_news' => $input['isi3_news'],
                'isi4_news' => $input['isi4_news'],
                'visible_news' => $input['visible_news'],
                'dokumentasi_news' => $input['dokumentasi_news']
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
        $model = new NewsModel();
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