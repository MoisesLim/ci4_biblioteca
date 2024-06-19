
    
    <div class="container">
        <h2>Emprestimo</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Form">Novo <i class="fas fa-plus"></i></button>
    <table class="table">
    </div>
    <thead>
       <tr>
        <td>ID</td>
        <td>INICIO</td>
        <td>FIM</td>
        <td>PRAZO</td>
        <td>LIVRO</td>
        <td>USUARIO</td>
        <td>ALUNO</td>
    </thead>
    <TBody>
    <?php foreach($listaEmprestimo as $em) : ?>
        <?php
        $data_inicio = $em['data_inicio'];
        $data_inicio = explode('-',$data_inicio);
        $data_inicio = mktime(0,0,0,$data_inicio[1],$data_inicio[2],$data_inicio[0]);
        $data_fim = $em['data_fim'];
        $data_fim = explode('-',$data_fim);
        $data_fim = mktime(0,0,0,$data_fim[1],$data_fim[2],$data_fim[0]);
            $prazo = $em['data_prazo']*24*60*60;
            $prazo += $data_inicio;
           ?>
        <tr>
            <td>
                <?=$em['id'] ?>
            </td>
            <td>
                <?=date('d/m/Y',$data_inicio) ?>
            </td>
            <td>
                <?=date( 'd/m/Y', $data_fim) ?>
            </td>
            <td>
                <?=date( 'd/m/Y', $prazo)?>
            </td>
            <td>
               <?php 
                   foreach($listaLivros as $livro):
                       if($em['id_livro'] == $livro['id']):
                           foreach($listaObras as $obra):
                               if($livro['id_obra'] == $obra['id']):
                                   echo $obra['titulo'];
                               endif;
                           endforeach;
                       endif;
                   endforeach;
               ?>
       </td>
       <td>
           <?php foreach($listaUsuarios as $u):?>
               <?php if($em['id_usuario'] == $u['id']) echo $u['nome']; ?>
           <?php endforeach ?>
       </td>
            <td>
                <?php foreach($listaAlunos as $a):?>
                    <?php if($em['id_aluno'] == $a['id']) echo $a['nome']; ?>
                <?php endforeach ?>
            </td>
            <td>
                <?=anchor("Emprestimo/editar/".$em['id']," ",["class"=>"fas fa-edit btn btn-primary"])?>
                <?=anchor("Emprestimo/excluir/".$em["id"]," ",["class"=>"fas fa-trash-alt btn btn-outline-danger"])?>
               
            </td>
            <td>
                <?php
            if($data_fim - $prazo <= 0){
                echo '<p class="text-success">Dentro do prazo</p>';
            }else{echo '<p class="text-danger">Fora do Prazo</p>';}?>
            </td>
        </tr>
    <?php endforeach ?>
</TBody>


</table>

<!-- Modal -->
<div class="modal fade" id="Form" tabindex="-1" aria-labelledby="Form" aria-hidden="true">
        <?=form_open("Emprestimo/cadastrar")?>
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Emprestimo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                   <div class="form-group">
                        <label for="data_inicio">Data de Inicio</label>
                        <input id="data_inicio" name="data_inicio" type="date" class="form-control" required>
                   </div>
                   <div class="form-group">
                        <label for="data_prazo">Prazo</label>
                        <input id="data_prazo" name="data_prazo" type="int" class="form-control" required>
                   </div>
                   <div class="form-group">
                        <label for="id_livro">Livro</label>
                        <select class="form-control" id="id_livro" name="id_livro" >
    <option selected hidden required>Selecione um Livro</option>
    <?php 
    $obrasExibidas = array();
    foreach($listaLivros as $livro):
        foreach($listaObras as $obra):
            if ($livro['id_obra'] == $obra['id'] && !in_array($obra['id'], $obrasExibidas)):
                array_push($obrasExibidas, $obra['id']);
    ?>
                <option value="<?=$livro['id']?>"><?=$obra['titulo']?></option>
    <?php 
            endif;
        endforeach;
    endforeach;
    ?>
</select>

                   </div>
                   <div class="form-group">
                       <label for="id_usuario">Usuario</label>
                       <select class="form-control" id="id_usuario" name="id_usuario" required>
                        <option selected hidden >Selecione um Usuario</option>
                        <?php foreach($listaUsuarios as $usuarios):?>
                               <option  value="<?=$usuarios['id']?>"><?=$usuarios['nome']?>
                            </option>
                            <?php endforeach ?>
                      </select>
                   </div>
                   <div class="form-group">
                        <label for="id_aluno">Aluno</label>
                        <select class="form-control" id="id_aluno" name="id_aluno" required>
                        <option selected hidden >Selecione um Aluno</option>
                            <?php foreach($listaAlunos as $aluno):?>
                                <option  value="<?=$aluno['id']?>"><?=$aluno['nome']?>
                        </option>
                            <?php endforeach ?>
                      </select>
                   </div>
                        <div class="modal-footer">
                        <?=anchor("emprestimo/index/","Cancelar", ["class"=>"btn btn-outline-secondary"])?>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
        </div>
    </div>
    <?=form_close()?>
</div>

