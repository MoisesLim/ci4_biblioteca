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
                        <button type="button" class="btn btn-outline-danger delete-button" data-id="<?=$u['id']?>" data-nome="<?=$u['nome']?>" data-email="<?=$u['email']?>" data-telefone="<?=$u['telefone']?>" data-toggle="modal" data-target="#confirmDeleteModal">
                            <i class="fas fa-trash-alt"></i>
                        </button>
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

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir o usuário com as seguintes informações?</p>
                <ul id="userInfoList" class="list-group">
                    <!-- As informações do usuário selecionado serão preenchidas aqui -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmDeleteButton" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-button');
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var nome = this.getAttribute('data-nome');
            var email = this.getAttribute('data-email');
            var telefone = this.getAttribute('data-telefone');
            document.getElementById('userInfoList').innerHTML = `
                <li class="list-group-item"><strong>Nome:</strong> ${nome}</li>
                <li class="list-group-item"><strong>Email:</strong> ${email}</li>
                <li class="list-group-item"><strong>Telefone:</strong> ${telefone}</li>
            `;
            var deleteUrl = this.getAttribute('href');
            document.getElementById('confirmDeleteButton').addEventListener('click', function() {
                window.location.href = deleteUrl;
            });
            $('#confirmDeleteModal').modal('show');
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