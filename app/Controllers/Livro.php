<?php

namespace App\Controllers;

use App\Controllers\BaseController; 
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LivroModel;
use App\Models\ObraModel;


class Livro extends BaseController
{   
    private $livroModel;
    
    public function __construct(){
        $this->LivroModel = new LivroModel();
        $this->ObraModel = new ObraModel();

    }

    // mostra a tela inicial faz com que a variavel $dados receba todos os dados da tabela obra e transforma em um array listaobra
    public function index() 
    {
        $dados = $this->LivroModel->findAll();
        $obra = $this->ObraModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('livro/index',['listaLivros' => $dados,'listaObras'=>$obra]);
        echo view('_partials/footer');
    }
    //cadastra o livro, coloca uma senha  e redireciona para a tela inicial
    public function cadastrar(){ 
        $Livro = $this->request->getPost();
        $this->LivroModel->save($Livro);
        return redirect()->to('livro/index');
    }
     
    //faz com que o livro possa editar os dados do livro e utiliza a variavel $dados para receber os dados do livro e pode-lo editar
    public function editar($id){
        $dados = $this->LivroModel->find($id);
        $dadosObra = $this->ObraModel->find();
        echo view('_partials/header');
        echo view('livro/edit',[
            'livro' => $dados,
            'listaObras'=>$dadosObra
        ]);
        echo view('_partials/footer');

    }

    //salva os dados editados do livro
    public function salvar(){
        $livro = $this->request->getPost();
        $this->LivroModel->save($livro);
        return redirect()->to('livro/index');
    }
    
    //exclui o livro
    public function excluir($id){
        $this->LivroModel->delete($id);
        return redirect()->to('livro/index');
    }
    public function adicionarObra(){
        $this->obralivroModel->save(
        $this->request->getPost()
    );
    return redirect()->to(
        'livro/editar/'.$this->request->getPost('id_livro')
    );
    }
    public function deletarAutorlivro($id, $id_obra)
{
    $this->obralivroModel->where('id_livro', $id)
                         ->where('id_obra', $id_obra)
                         ->delete();
    return redirect()->to('Livro/editar/'.$id);
}
}




