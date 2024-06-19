<main>
    <?php
        if (!isset($_SESSION['logged']) || !isset($_SESSION['logged']['id'])){
            ?>
                <p>Você precisa logar para acessar essa página</p>
            <?php
            die();
        }
    ?>
    <form>
        <h2>Adicionar Pergunta</h2>
        <input type="text" name="titulo" placeholder="Título" maxlenght='80' style="width: 100%" required>
        <textarea name="enunciado" placeholder="Enunciado" rows='5' required></textarea>
        <select name="materia" required>
            <option value="0" selected>Selecione uma matéria</option>
            <?php
                foreach ($this->materias as $materia): 
                    if ($materia->st_materia == 'D') continue;
                ?>
                    <option value="<?= $materia->cd_materia ?>"><?= $materia->nm_materia ?></option>
            <?php endforeach;?>
        </select>
        <select name="submateria" required>
            <option value="" selected>Selecione uma submatéria</option>
        </select>
        <div>
            <label for="dissertativa">Dissertativa</label>
            <input type="radio" name="tipo-resposta" value="dissertativa" id="dissertativa" checked="checked">
        </div>
        <div>
            <label for="alternativa">Alternativa</label>
            <input type="radio" name="tipo-resposta" value="alternativa" id="alternativa">
        </div>
        <div id='resposta-alternativa'>
            <textarea name="a" placeholder="Alternativa A" required></textarea>
            <textarea name="b" placeholder="Alternativa B" required></textarea>
            <textarea name="c" placeholder="Alternativa C" required></textarea>
            <textarea name="d" placeholder="Alternativa D" required></textarea>
            <textarea name="e" placeholder="Alternativa E" required></textarea>
            <div class="gabarito-alternativa">
                <p>Gabarito:</p>
                <label for="gabarito-a">A)</label>
                <input type="radio" name="gabarito-alternativa" id="gabarito-a" value="a" selected>
                <label for="gabarito-b">B)</label>
                <input type="radio" name="gabarito-alternativa" id="gabarito-b" value="b">
                <label for="gabarito-c">C)</label>
                <input type="radio" name="gabarito-alternativa" id="gabarito-c" value="c">
                <label for="gabarito-d">D)</label>
                <input type="radio" name="gabarito-alternativa" id="gabarito-d" value="d">
                <label for="gabarito-e">E)</label>
                <input type="radio" name="gabarito-alternativa" id="gabarito-e" value="e">
            </div>
        </div>
        <div id="resposta-dissertativa">
            <textarea name="resposta-dissertativa" placeholder="Gabarito Dissertativa" required></textarea>
        </div>
        <p id="retorno"></p>
        <input type="submit" value="Publicar">
    </form>
    <script>
        $('form select[name="materia"]').on('change', function() {
            $.ajax({
                url: `/get/submaterias/materia/${$(this).val()}`,
                dataType: 'html'
            })
            .done(function (data) {
                $('form select[name="submateria"]').html(data)
            })
        })
        $(document).ready(function () {
            $('#resposta-alternativa').hide().children().prop('disabled', true).removeAttr('required')
        })
        $('input[type=radio][name=tipo-resposta]').on('change', function () {
            if ($(this).val() == "dissertativa") {
                $('#resposta-alternativa').hide().children().prop('disabled', true).removeAttr('required')
                $('#resposta-dissertativa').show().children().prop('disabled', false).attr('required')
            } else if ($(this).val() == "alternativa") {
                $('#resposta-alternativa').show().children().prop('disabled', false).attr('required')
                $('#resposta-dissertativa').hide().children().prop('disabled', true).removeAttr('required')
            }
        })
        $('form').on('submit', function (e) {
            e.preventDefault()

            var retorno = $(this).find('#retorno')
            var materia = $(this).find('select[name="materia"]')
            var submateria = $(this).find('select[name="submateria"]')

            if (materia.val() == "" || submateria.val() == "") {
                retorno.text('Selecione as matérias!')
                return
            }

            $.ajax({
                url: '/pergunta/add',
                type: 'get',
                dataType: 'json',
                data: $(this).serialize()
            })
            .done(function (data) {
                if (data?.insert) {
                    retorno.text(data.message)
                }
            })
            .fail(function (a, b, c) {
                retorno.text('OPS! Algo deu errado!')
                console.log(a)
                console.log(b)
                console.log(c)
            })
        })
    </script>
</main>