<div class="container p-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 bg-dark text-white p-4" data-bs-theme="dark">
            <?= form_open("Emprestimo/salvar") ?>
            <input type="hidden" name="id" id="id" value='<?= $emprestimo['id'] ?>'>
            
            <div class="row p-2">
                <div class="col-2">
                    <label for="data_inicio">Data Início</label>
                </div>
                <div class="col-10">
                    <input type="date" name="data_inicio" id="data_inicio" class="form-control" value='<?= $emprestimo['data_inicio'] ?>'>
                </div>
            </div>
            
            <div class="row p-2">
                <div class="col-2">
                    <label for="data_fim">Data Final</label>
                </div>
                <div class="col-10">
                    <input type="date" name="data_fim" id="data_fim" class="form-control" value='<?= $emprestimo['data_fim'] ?>'>
                </div>
            </div>
            
            <div class="row p-2">
                <div class="col-2">
                    <label for="data_prazo">Prazo</label>
                </div>
                <div class="col-10">
                    <input type="int" name="data_prazo" id="data_prazo" class="form-control" value='<?= $emprestimo['data_prazo'] ?>'>
                </div>
            </div>
            
            <div class="row p-2">
                <div class="col-2">
                    <label for="id_livro">Livro</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="id_livro" name="id_livro">
                        <?php
                        foreach ($listaLivros as $livro) {
                            foreach ($listaObras as $obra) {
                                if ($livro['id_obra'] == $obra['id']) {
                                    $selected = $emprestimo['id_livro'] == $livro['id'] ? 'selected' : '';
                                    echo "<option value='{$livro['id']}' $selected>{$obra['titulo']}</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="row p-2">
                <div class="col-2">
                    <label for="id_aluno">Aluno</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="id_aluno" name="id_aluno">
                        <?php foreach($listaAlunos as $aluno) : ?>
                            <?php $selected = $emprestimo['id_aluno'] == $aluno['id'] ? 'selected' : ''; ?>
                            <option value="<?= $aluno['id'] ?>" <?= $selected ?>><?= $aluno['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="btn-group w-100" role="group">
                        <?= anchor("Emprestimo/index/", "Cancelar", ["class" => "btn btn-outline-secondary"]) ?>
                        <button type="submit" class="btn btn-outline-success">Salvar</button>
                    </div>
                </div>
            </div>
            
            <?= form_close() ?>
        </div>
    </div>
</div>
