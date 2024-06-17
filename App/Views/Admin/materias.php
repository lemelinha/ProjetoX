<main>
    <form>
        <h3>Cadastrar Matéria</h3>
        <input type="text" name="materia" placeholder="Nome da matéria">
        <input type="submit" value="Cadastrar">
        <p id="retorno"></p>
    </form>
    <section>
        <?php
            foreach($this->materias as $materia): ?>
                <div class="materia">
                    <h4><?= $materia->nm_materia ?></h4>
                    <div class="btns">
                        <button class='btn btn-alterar'><i class="fa-solid fa-pen"></i></button>
                        <button class='btn btn-excluir'><i class="fa-solid fa-trash"></i></button>
                    </div>
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
    </script>
</main>