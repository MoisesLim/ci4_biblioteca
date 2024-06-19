<!-- indica o inicio do index, "o corpo do site " -->

    <div class="container">
        <h2>Obra</h2>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Form"> Novo <i class="fas fa-plus"></i></button>
    <table class="table">
    </div>
    <thead>
       <tr>
        <td>ID</td>
        <td>TITULO</td>
        <td>ISBN</td>
        <td>CATEGORIA</td>
        <td>ANO</td>
        <td>EDITORA</td>

    </thead>
    <TBody>
        <?php foreach($listaObras as $o) :?>
            <tr>
                <td>
                    <?=$o['id']?>
                </td>
                <td>
                    <?=$o['titulo']?>
                </td>
                <td>
                    <?=$o['isbn']?>
               </td>
                <td>
                    <?=$o['categoria']?></td>
                <td>
                    <?=$o['ano_publicacao']?>
                </td>
                <td>
                    <?=$o['id_editora']?>
                </td>
                    <td>
                    <?=anchor("Obra/editar/".$o['id']," ",["class"=>"fas fa-edit btn btn-primary"])?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Delet"> <i class="fas fa-trash-alt"></i></button>
               </td>
            </tr>
        <?php endforeach?>
    </TBody>
</table>

<!-- Modal -->
<div class="modal fade" id="Form" tabindex="-1" aria-labelledby="Form" aria-hidden="true">
        <?=form_open("Obra/cadastrar")?>
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Obra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                   <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input id="isbn" name="isbn" type="text" maxlength="17" placeholder="XXX-X-XX-XXXXXX-X" class="form-control" required>
                   </div>
                   <div class="form-group">
                        <label for="titulo">titulo</label>
                        <input id="titulo" name="titulo" type="text" class="form-control" required>
                   </div>
                   <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <input id="categoria" name="categoria" type="text" class="form-control" required>
                   </div>
                   <div class="form-group">
                        <label for="ano_publicacao">ano_publicacao</label>
                        <input id="ano_publicacao" maxlength="4" placeholder="YYYY" name="ano_publicacao" type="text" class="form-control" required>
                   </div>
                   <div class="form-group" >
                      <label for="editora">Editora</label>
                      <select class="form-control" id="id_editora" name="id_editora" requered>
                        <option selected hidden>Selecione uma Editora</option>
                        <?php foreach($listaEditoras as $editora) : ?>
                            <option value="<?=$editora['id']?>"><?=$editora['nome']?></option>
                            <?php endforeach ?>
                      </select>
                    </div>

                </div>
                        <div class="modal-footer">
                        <?=anchor("Obra/index/","Cancelar", ["class"=>"btn btn-outline-secondary"])?>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
        </div>
    </div>
    <?=form_close()?>
</div>

<div class="modal fade" id="Delet" tabindex="-1" aria-labelledby="Form" aria-hidden="true">
        <?=form_open("Aluno/cadastrar")?>
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar</h1>
                <?php foreach($listaObras as $o) :?>
            
            </div>
                <div class="modal-body">
                   <div class="form-group">

                      <label for="nome">Você deseja deletar o Obra?</label>
                      
                   </div>
                </div>
                        <div class="modal-footer">
                        <?=anchor("obra/index/","Cancelar", ["class"=>"btn btn-outline-secondary"])?>
                        <?=anchor("obra/excluir/".$o["id"],"Sim ",["class"=>" btn btn-outline-danger"])?>
                        <?php endforeach ?>
                        </div>
        </div>
    </div>
    <?=form_close()?>
</div>


<script>

function formatISBN(isbn) {
            isbn = isbn.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
            isbn = isbn.replace(/(\d{3})(\d)/, "$1-$2"); // Coloca um hífen após os primeiros três dígitos
            isbn = isbn.replace(/(\d)(\d{2})/, "$1-$2"); // Coloca um hífen após o quarto dígito
            isbn = isbn.replace(/(\d{2})(\d{6})/, "$1-$2"); // Coloca um hífen após os seis dígitos subsequentes
            isbn = isbn.replace(/(\d{6})(\d)/, "$1-$2"); // Coloca um hífen após os seis dígitos subsequentes
            return isbn;
        }

        document.getElementById('isbn').addEventListener('input', function (e) {
            e.target.value = formatISBN(e.target.value);
        });

        function formatAno(ano) {
            return ano.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
        }
        document.getElementById('ano').addEventListener('input', function (e) {
            e.target.value = formatAno(e.target.value);
        });
        
</script>