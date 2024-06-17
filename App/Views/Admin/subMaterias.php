<main>
    <form>
        <h3>Cadastrar SubMatéria</h3>
        <input type="text" name="submateria" placeholder="Nome da submatéria">
        <select name="materiaPai" placeholder="Matéria Pai">
            <?php
                foreach($this->materias as $materia): ?>
                    <option value="<?= $materia->cd_materia ?>"><?= $materia->nm_materia ?></option>
            <?php endforeach;?>
        </select>
        <input type="submit" value="Cadastrar">
        <p id="retorno"></p>
    </form>
    <section>
        <?php
            foreach($this->submaterias as $materia): ?>
                <div class="materia">
                    <div>
                        <h4><?= $materia->nm_submateria ?></h4>
                        <p><?= $materia->nm_materia ?></p>
                    </div>
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
    </script>
</main>