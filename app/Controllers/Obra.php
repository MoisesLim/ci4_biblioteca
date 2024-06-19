<?php

namespace App\Controllers;

use App\Controllers\BaseController; 
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObraModel;
use App\Models\EditoraModel;
use App\Models\AutorModel;
use App\Models\AutorObraModel;

class Obra extends BaseController
{   
    private $obraModel;
    
    public function __construct(){
        $this->editoraModel = new EditoraModel();
        $this->obraModel = new ObraModel();
        $this->autorModel = new AutorModel();
        $this->autorObraModel = new AutorObraModel();

    }

    // mostra a tela inicial faz com que a variavel $dados receba todos os dados da tabela obra e transforma em um array listaobra
    public function index() 
    {
        $dados = $this->obraModel->findAll();
        $editoras = $this->editoraModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/index',['listaObras' => $dados,'listaEditoras'=>$editoras]);
        echo view('_partials/footer');
    }
    //cadastra o obra, coloca uma senha  e redireciona para a tela inicial
    public function cadastrar(){ 
        $obra = $this->request->getPost();
        $this->obraModel->save($obra);
        return redirect()->to('Obra/index');
    }
     
    //faz com que o obra possa editar os dados do obra e utiliza a variavel $dados para receber os dados do obra e pode-lo editar
    public function editar($id){
        $dados = $this->obraModel->find($id);
        $dadosEditora = $this->obraModel->find();
        $dadosAutor = $this->autorModel->find();
        $dadosAutorObras = $this->autorObraModel->find();
        echo view('_partials/header');
        echo view('obra/edit',[
            'obra' => $dados,
            'listaAutores'=>$dadosAutor,
            'listaAutoresObras'=>$dadosAutorObras
        ]);
        echo view('_partials/footer');

    }

    //salva os dados editados do obra
    public function salvar(){
        $obra = $this->request->getPost();
        $this->obraModel->save($obra);
        return redirect()->to('obra/index');
    }
    
    //exclui o obra
    public function excluir($id){
        $this->obraModel->delete($id);
        return redirect()->to('Obra/index');
    }
    public function adicionarAutor(){
        $this->autorObraModel->save(
        $this->request->getPost()
    );
    return redirect()->to(
        'Obra/editar/'.$this->request->getPost('id_obra')
    );
    }
    public function deletarAutorObra($id, $id_autor)
{
    $this->autorObraModel->where('id_obra', $id)
                         ->where('id_autor', $id_autor)
                         ->delete();
    return redirect()->to('obra/editar/'.$id);
}
}




