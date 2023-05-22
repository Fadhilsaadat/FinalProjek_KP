<?php

namespace App\Controllers;

use App\Models\SaranaModel;
use CodeIgniter\Controller;

class SaranaController extends Controller
{
    protected $mRequest;

    public function __construct()
    {
        $this->mRequest = service("request");
    }

    public function index()
    {
        $model = new SaranaModel();
        $data['sarana'] = $model->findAll();
        $data['title'] = 'Sarana & Prasarana';
        return view('sarana/index', $data);
    }

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        $model = new SaranaModel();

        $data = [
            'nama_sarana' => $this->mRequest->getPost('nama_sarana')
        ];

        $model->save($data);

        return redirect()->to('/sarana');
    }

    public function edit($id)
    {
        $model = new SaranaModel();
        $data['sarana'] = $model->find($id);
        return view('edit', $data);
    }

    public function update()
    {
        $model = new SaranaModel();
        $id = $this->mRequest->getVar('id');

        $data = [
            'nama_sarana' => $this->mRequest->getPost('nama_sarana')
        ];

        $model->update($id, $data);

        return redirect()->to('/sarana');
    }

    public function delete($id)
    {
        $model = new SaranaModel();
        $model->delete($id);
        return redirect()->to('/sarana');
    }
}
