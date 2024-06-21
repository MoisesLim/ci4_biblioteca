<!-- indica o inicio do index, "o corpo do site " -->

<div class="container">
    <h2>Obra</h2>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Form">Novo <i class="fas fa-plus"></i></button>
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
    <td>AÇÕES</td>
</thead>
<tbody>
    <?php foreach($listaObras as $o) :?>
        <?php
            // Obter os nomes dos autores relacionados a esta obra
            $autoresNomes = array();
            foreach ($listaAutoresObras as $lao) {
                if ($lao['id_obra'] == $o['id']) {
                    foreach ($listaAutores as $autor) {
                        if ($autor['id'] == $lao['id_autor']) {
                            $autoresNomes[] = $autor['nome'];
                        }
                    }
                }
            }
            $autoresNomesStr = implode(', ', $autoresNomes);
        ?>
        <tr data-id="<?= $o['id'] ?>" data-isbn="<?= $o['isbn'] ?>" data-titulo="<?= $o['titulo'] ?>" data-categoria="<?= $o['categoria'] ?>" data-ano="<?= $o['ano_publicacao'] ?>" data-editora="<?= $o['id_editora'] ?>" data-autores="<?= $autoresNomesStr ?>">
            <td><?=$o['id']?></td>
            <td><?=$o['titulo']?></td>
            <td><?=$o['isbn']?></td>
            <td><?=$o['categoria']?></td>
            <td><?=$o['ano_publicacao']?></td>
            <td><?=$o['id_editora']?></td>
            <td>
                <?=anchor("Obra/editar/".$o['id'], " ", ["class" => "fas fa-edit btn btn-primary"])?>
                <?=anchor("Obra/excluir/".$o['id'], " ", ["class"=>"fas fa-trash-alt btn btn-outline-danger delete-button", "data-titulo"=>$o['titulo'],"data-isbn"=>$o['isbn']])?>
           </td>
        </tr>
    <?php endforeach?>
</tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="Form" tabindex="-1" aria-labelledby="Form" aria-hidden="true">
    <?=form_open("Obra/cadastrar", ["onsubmit" => "return validateForm()"])?>
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
                    <span id="isbn-error" class="error-message">Formato do ISBN incorreto</span>
                </div>
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input id="titulo" name="titulo" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <input id="categoria" name="categoria" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="ano_publicacao">Ano da Publicação</label>
                    <input id="ano_publicacao" maxlength="4" placeholder="YYYY" name="ano_publicacao" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editora">Editora</label>
                    <select class="form-control" id="id_editora" name="id_editora" required>
                        <option selected hidden>Selecione uma Editora</option>
                        <?php foreach($listaEditoras as $editora) : ?>
                            <option value="<?=$editora['id']?>"><?=$editora['nome']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <?=anchor("Obra/index/", "Cancelar", ["class" => "btn btn-outline-secondary"])?>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </div>
    <?=form_close()?>
</div>

<style>
    .error-message {
        display: none;
        color: red;
        margin-top: 5px;
    }
</style>

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
        let value = e.target.value;
        value = formatISBN(value);
        e.target.value = value;
    });

    function validateForm() {
        const isbn = document.getElementById('isbn').value;
        const errorMessage = document.getElementById('isbn-error');
        if (isbn.length !== 17) {
            errorMessage.style.display = 'block';
            return false; // Impede o envio do formulário
        } else {
            errorMessage.style.display = 'none';
            return true; // Permite o envio do formulário
        }
    }

    function formatAno(ano) {
        return ano.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
    }

    document.getElementById('ano_publicacao').addEventListener('input', function (e) {
        e.target.value = formatAno(e.target.value);
    });

    document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-button');
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var titulo = this.getAttribute('data-titulo');
            var isbn = this.getAttribute('data-isbn');
            var confirmDelete = confirm("Você tem certeza que deseja deletar a obra " + titulo +" com o isbn :" + isbn + "?");
            
            if (confirmDelete) {
                window.location.href = this.getAttribute('href');
            }
        });
    });
});
</script>
