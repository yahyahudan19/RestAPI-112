<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\LaporanModel;

class Laporan extends ResourceController
{
    use ResponseTrait;

    // Get All Laporan
    public function index()
    {
        $model = new LaporanModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    // Get Single Laporan
    public function show($id = null)
    {
        $model = new LaporanModel();
        $data = $model->getWhere(['id_pelapor' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Mboten ditemukan :(' . $id);
        }
    }

    // create a Laporam
    public function create()
    {
        $model = new LaporanModel();
        $data = [
            'id_admin' => $this->request->getPost('id_admin'),
            'no_tiket' => $this->request->getPost('no_tiket'),
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'kejadian' => $this->request->getPost('kejadian'),
            'lokasi_kejadian' => $this->request->getPost('lokasi_kejadian'),
            'tanggal' => $this->request->getPost('tanggal'),
            'nama_pelapor' => $this->request->getPost('nama_pelapor'),
            'tindak_lanjut' => $this->request->getPost('tindak_lanjut'),
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

    // update Laporan
    public function update($id = null)
    {
        $model = new LaporanModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'id_admin' => $json->id_admin,
                'no_tiket' => $json->no_tiket,
                'nama_petugas' => $json->nama_petugas,
                'kejadian' => $json->kejadian,
                'lokasi_kejadian' => $json->lokasi_kejadian,
                'tanggal' => $json->tanggal,
                'nama_pelapor' => $json->nama_pelapor,
                'tindak_lanjut' => $json->tindak_lanjut
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'id_admin' => $input['id_admin'],
                'nama_petugas' => $input['nama_petugas'],
                'kejadian' => $input['kejadian'],
                'lokasi_kejadian' => $input['lokasi_kejadian'],
                'tanggal' => $input['tanggal'],
                'nama_pelapor' => $input['nama_pelapor'],
                'tindak_lanjut' => $input['tindak_lanjut']
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
    
    // Delete Laporan
    public function delete($id = null)
    {
        $model = new LaporanModel();
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