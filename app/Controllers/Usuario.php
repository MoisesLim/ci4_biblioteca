<?php

namespace App\Controllers;

use App\Controllers\BaseController; 
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{   
    private $usuarioModel;
    
    public function __construct(){
        $this->usuarioModel = new usuarioModel();
    }

    // mostra a tela inicial faz com que a variavel $dados receba todos os dados da tabela usuario e transforma em um array listaUsuario
    public function index() 
    {
        $dados = $this->usuarioModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('usuario/index',['listaUsuarios' => $dados]);
        echo view('_partials/footer');
    }
    //cadastra o usuario, coloca uma senha  e redireciona para a tela inicial
    public function cadastrar(){ 
        $usuario = $this->request->getPost();
        $usuario['senha'] = md5("senhaforte");
        $this->usuarioModel->save($usuario);
        return redirect()->to('Usuario/index');
    }
     
    //faz com que o usuario possa editar os dados do usuario e utiliza a variavel $dados para receber os dados do usuario e pode-lo editar
    public function editar($id){
        $dados = $this->usuarioModel->find($id);
        echo view('_partials/header');
        echo view('usuario/edit',['usuario' => $dados]);
        echo view('_partials/footer');

    }

    //salva os dados editados do usuario
    public function salvar(){
        $usuario = $this->request->getPost();
        $this->usuarioModel->save($usuario);
        return redirect()->to('Usuario/index');
    }
    
    //exclui o usuario
    public function excluir($id){
        $this->usuarioModel->delete($id);
        return redirect()->to('Usuario/index');
    }

}