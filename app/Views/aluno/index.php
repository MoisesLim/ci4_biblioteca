<div class="container">
    <h2>Aluno</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Form"> Novo <i class="fas fa-plus"></i></button>
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>CPF</td>
                <td>NOME</td>
                <td>EMAIL</td>
                <td>TELEFONE</td>
                <td>TURMA</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaAlunos as $a) : ?>
            <tr>
                <td><?=$a['id']?></td>
                <td><?=$a['cpf']?></td>
                <td><?=$a['nome']?></td>
                <td><?=$a['email']?></td>
                <td><?=$a['telefone']?></td>
                <td><?=$a['turma']?></td>
                <td>
                    <?=anchor("Aluno/editar/".$a['id'], " ", ["class"=>"fas fa-edit btn btn-primary"])?>
                    <?=anchor("Aluno/excluir/".$a['id'], " ", ["class"=>"fas fa-trash-alt btn btn-outline-danger delete-button", "data-id"=>$a['id']])?>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="Form" tabindex="-1" aria-labelledby="Form" aria-hidden="true">
    <?=form_open("Aluno/cadastrar")?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Aluno</h1>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input id="cpf" name="cpf" type="text" maxlength="14" placeholder="000.000.000-00" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input id="telefone" name="telefone" maxlength="15" placeholder="(00) 00000-0000" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="turma">Turma</label>
                    <select class="form-control" id="turma" name="turma" required>
                        <option value="1A">1A</option>
                        <option value="1B">1B</option>
                        <option value="1C">1C</option>
                        <option value="1D">1D</option>
                        <option value="2A">2A</option>
                        <option value="2B">2B</option>
                        <option value="2C">2C</option>
                        <option value="2D">2D</option>
                        <option value="3A">3A</option>
                        <option value="3B">3B</option>
                        <option value="3C">3C</option>
                        <option value="3D">3D</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <?=anchor("Aluno/index/", "Cancelar", ["class"=>"btn btn-outline-secondary"])?>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </div>
    <?=form_close()?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-button');
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var id = this.getAttribute('data-id');
            var confirmDelete = confirm("Você tem certeza que deseja deletar o aluno com ID " + id + "?");
            
            if (confirmDelete) {
                window.location.href = this.getAttribute('href');
            }
        });
    });
});
</script>
