<main>
    <form>
        <h3>Cadastrar Matéria</h3>
        <input type="text" name="materia" placeholder="Nome da matéria">
        <input type="submit" value="Cadastrar">
        <p id="retorno"></p>
    </form>
    <section>
        <?php
            foreach($this->materias as $materia): 
                if ($materia->st_materia == 'D') continue;
            ?>
                <div class="materia">
                    <h4><?= $materia->nm_materia ?></h4>
                    <button class='btn btn-excluir' id="<?= $materia->cd_materia ?>"><i class="fa-solid fa-trash"></i></button>
                </div>
        <?php endforeach; ?>
    </section>
    <script>
        $('form').on('submit', function (e) {
            e.preventDefault()

            var retorno = $(this).find('#retorno')

            $.ajax({
                url: '/admin/materias/add',
                type: 'post',
                dataType: 'json',
                data: $(this).serialize()
            })
            .done(function (data) {
                if (!(data?.erro)) {
                    retorno.text('Matéria adicionada com sucesso')
                    return
                }
            })
            .fail(function () {
                retorno.text('OPS! Erro interno do servidor')
            })
        })
        $('button.btn-excluir').on('click', function () {
            $.ajax({
                url: `/admin/crud/delete/type/materia/id/${$(this).attr('id')}`,
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