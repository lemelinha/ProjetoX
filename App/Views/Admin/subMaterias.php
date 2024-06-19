<main>
    <form>
        <h3>Cadastrar SubMatéria</h3>
        <input type="text" name="submateria" placeholder="Nome da submatéria">
        <select name="materiaPai" placeholder="Matéria Pai">
            <?php
                foreach($this->materias as $materia): 
                    if ($materia->st_materia == 'D') continue;
                ?>
                    <option value="<?= $materia->cd_materia ?>"><?= $materia->nm_materia ?></option>
            <?php endforeach;?>
        </select>
        <input type="submit" value="Cadastrar">
        <p id="retorno"></p>
    </form>
    <section>
        <?php
            foreach($this->submaterias as $submateria): 
                if ($submateria->st_submateria == 'D') continue;
            ?>  
                <div class="materia">
                    <div>
                        <h4><?= $submateria->nm_submateria ?></h4>
                        <p><?= $submateria->nm_materia ?></p>
                    </div>
                    <button class='btn btn-excluir' id="<?= $submateria->cd_submateria ?>"><i class="fa-solid fa-trash"></i></button>
                </div>
        <?php endforeach; ?>
    </section>
    <script>
        $('form').on('submit', function (e) {
            e.preventDefault()

            var retorno = $(this).find('#retorno')

            $.ajax({
                url: '/admin/submaterias/add',
                type: 'post',
                dataType: 'json',
                data: $(this).serialize()
            })
            .done(function (data) {
                if (!(data?.erro)) {
                    retorno.text('SubMatéria adicionada com sucesso')
                    return
                }
            })
            .fail(function () {
                retorno.text('OPS! Erro interno do servidor')
            })
        })
        $('button.btn-excluir').on('click', function () {
            $.ajax({
                url: `/admin/crud/delete/type/submateria/id/${$(this).attr('id')}`,
                type: 'get',
                dataType: 'json',
                data: null
            })
            .done(function (data) {
                if (data.erro) {
                    $('#retorno').text('Algo deu errado')
                } else {
                    $('#retorno').text('Matéria deletada com sucesso')
                }
            })
        })
    </script>
</main>