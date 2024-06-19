<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AutorModel;

class Autor extends BaseController
{
    private $autorModel;
    
    public function __construct(){
        $this->autorModel = new autorModel();
    }
    

    public function index()
        {
            $dados = $this->autorModel->findAll();
            echo view('_partials/header');
            echo view('_partials/navbar');
            echo view('autor/index',['listaAutores' => $dados]);
            echo view('_partials/footer');
        }
        public function cadastrar(){
            $autor = $this->request->getPost();
            $this->autorModel->save($autor);
            return redirect()->to('autor/index');
        }
        public function editar($id){
            $dados = $this->autorModel->find($id);
            echo view('_partials/header');
           
            echo view('autor/edit',['autor' => $dados]);
            echo view('_partials/footer');
    
        }
        public function salvar(){
            $autor = $this->request->getPost();
            $this->autorModel->save($autor);
            return redirect()->to('autor/index');
        }
        public function excluir($id){
            $this->autorModel->delete($id);
            return redirect()->to('autor/index');
        }
}
