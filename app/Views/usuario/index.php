<div class="container">
    <h2>Usuários</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Form"> Novo <i class="fas fa-plus"></i></button>
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>NOME</td>
                <td>E-MAIL</td>
                <td>TELEFONE</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaUsuarios as $u) : ?>
                <tr>
                    <td><?=$u['id']?></td>
                    <td><?=$u['nome']?></td>
                    <td><?=$u['email']?></td>
                    <td><?=$u['telefone']?></td>
                    <td>
                        <?=anchor("Usuario/editar/".$u['id'], "<i class='fas fa-edit'></i>", ["class"=>"btn btn-primary"])?>
                        <?=anchor("Usuario/excluir/".$u['id'], " ", ["class"=>"fas fa-trash-alt btn btn-outline-danger delete-button", "data-nome"=>$u['nome'],"data-email"=>$u['email']])?>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>

<!-- Modal de cadastro -->
<div class="modal fade" id="Form" tabindex="-1" aria-labelledby="Form" aria-hidden="true">
    <?=form_open("Usuario/cadastrar")?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Usuário</h1>
            </div>
            <div class="modal-body">
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
                    <input id="telefone"  maxlength="15" placeholder="(00) 00000-0000" name="telefone" type="text" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <?=anchor("Usuario/index/","Cancelar", ["class"=>"btn btn-outline-secondary"])?>
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
            var Nome = this.getAttribute('data-Nome');
            var email = this.getAttribute('data-email');
            var confirmDelete = confirm("Você tem certeza que deseja deletar o aluno  " + Nome + " com o email "+ email +"?");
            
            if (confirmDelete) {
                window.location.href = this.getAttribute('href');
            }
        });
    });
});


function formatTelefone(telefone) {
    telefone = telefone.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
    telefone = telefone.replace(/(\d{2})(\d)/, "($1) $2"); // Coloca parênteses ao redor dos dois primeiros dígitos e espaço depois
    telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2"); // Coloca um hífen entre o quinto e o sexto dígitos
    return telefone;
}

document.getElementById('telefone').addEventListener('input', function (e) {
    e.target.value = formatTelefone(e.target.value);
});
</script>