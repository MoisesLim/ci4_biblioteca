<?php

namespace App\Controllers;

use App\Controllers\BaseController; 
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmprestimoModel;
use App\Models\LivroModel;
use App\Models\AlunoModel;
use App\Models\ObraModel;
use App\Models\UsuarioModel;

class Emprestimo extends BaseController
{   
    private $emprestimoModel;
    
    public function __construct(){
        $this->alunoModel = new AlunoModel();
        $this->livroModel = new LivroModel();
        $this->obraModel = new ObraModel();
        $this->usuarioModel = new UsuarioModel();
        $this->emprestimoModel = new EmprestimoModel();

    }

    // mostra a tela inicial faz com que a variavel $dados receba todos os dados da tabela obra e transforma em um array listaobra
    public function index() 
    {
        $dados = $this->emprestimoModel->findAll();
        $alunos = $this->alunoModel->findAll();
        $usuarios = $this->usuarioModel->findAll();
        $livros = $this->livroModel->findAll();
        $obras = $this->obraModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('emprestimo/index',['listaEmprestimo' => $dados,'listaLivros'=>$livros,'listaObras'=>$obras,'listaUsuarios'=>$usuarios,'listaAlunos'=>$alunos]);
        echo view('_partials/footer');
    }
     //cadastra o emprestimo, coloca uma senha  e redireciona para a tela inicial
     public function cadastrar(){ 
        $emprestimo = $this->request->getPost();
        $this->emprestimoModel->save($emprestimo);
        $this->livroModel->update($emprestimo['id_livro'],['disponivel' => 0]);
        return redirect()->to('Emprestimo/index');
    }
     
    //faz com que o emprestimo possa editar os dados do emprestimo e utiliza a variavel $dados para receber os dados do emprestimo e pode-lo editar
    public function editar($id){
        $dados = $this->emprestimoModel->find($id);
        $this->livroModel->update($dados['id_livro'],['disponivel' => 1]);
        $alunos = $this->alunoModel->find();
        $usuarios = $this->usuarioModel->find();
        $livros = $this->livroModel->find();
        $obra = $this->obraModel->find();
        echo view('_partials/header');
        echo view('emprestimo/edit',[
            'emprestimo' => $dados,
            'listaLivros'=>$livros,
            'listaUsuarios'=>$usuarios,
            'listaObras'=>$obra,
            'listaAlunos'=>$alunos
        ]);
        echo view('_partials/footer');

    }

    //salva os dados editados do emprestimo
    public function salvar(){
        $emprestimo = $this->request->getPost();
        $this->livroModel->update($emprestimo['id_livro'],['disponivel' => 0]);
        $this->emprestimoModel->save($emprestimo);
        return redirect()->to('emprestimo/index');
    }
    
    //exclui o emprestimo
    public function excluir($id){
        $this->emprestimoModel->delete($id);
        return redirect()->to('Emprestimo/index');
    }
}