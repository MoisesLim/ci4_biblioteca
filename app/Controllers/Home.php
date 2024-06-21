<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class Home extends BaseController
{   
    
    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }
    public function index()
    {
        $usuarios = $this->usuarioModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('home/index',['listaUsuarios' => $usuarios]);
        echo view('_partials/footer');

        $session = \Config\Services::session();
        $data['u'] = [
            'id' => $session->get('id'),
            'nome' => $session->get('nome'),
            'email' => $session->get('email'),
            'telefone' => $session->get('telefone')
        ];
    }

    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('/login'); // Redireciona para a página de login ou outra página apropriada
    }
}
