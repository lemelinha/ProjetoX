<main>
    <h1>Banco de perguntas</h1>
    <a class='btn' id='add-pergunta' href="/pergunta/form"><i class="fa-solid fa-plus"></i>Adicionar Pergunta</a>
    <section>
        <h2>Filtro:</h2>
        <form id="filter" style="flex-direction: row; border-bottom: 1px solid #ddd; padding-bottom: 20px; flex-wrap: wrap">
        <label>Matéria: </label>
            <select name="materia">
                <option value="" selected>Todas</option>
                <?php
                    foreach ($this->materias as $materia): ?>
                        <option value="<?= $materia->cd_materia ?>"><?= $materia->nm_materia ?></option>
                <?php endforeach;?>
            </select>
            <label>SubMatéria: </label>
            <select name="submateria">
                
            </select>
            <label id="tipo-resposta-dissertativa">Dissertativa</label>
            <input type="checkbox" name="tipoResposta" id="tipo-resposta-dissertativa" value="dissertativa">
            <label id="tipo-resposta-alternativa">Alternativa</label>
            <input type="checkbox" name="tipoResposta" id="tipo-resposta-alternativa" value="alternativa">
        </form>
        <section style="margin-top: 20px" id="perguntas">
            
        </section>
    </section>

    <script>
        $('a#add-pergunta + section').css('margin-top', parseInt($('a#add-pergunta').css('height').replace('px', ''))+20)
        $(document).ready(function () {
            $.ajax({
                url: '/get/perguntas',
                type: 'get',
                dataType: 'html',
                data: $('form').serialize(),
            })
            .done(function (data) {
                $('section#perguntas').html(data)
            })
            $.ajax({
                url: `/get/submaterias/materia/0`,
                dataType: 'html'
            })
            .done(function (data) {
                $('form select[name="submateria"]').html(data)
            })
        })
        $('form select[name="materia"]').on('change', function() {
            $.ajax({
                url: `/get/submaterias/materia/${$(this).val()!=''?$(this).val():'0'}`,
                dataType: 'html'
            })
            .done(function (data) {
                $('form select[name="submateria"]').html(data)
            })
        })
        $('input[name="tipoResposta"][type="checkbox"]').on('change', function () {
            if (!$(this).prop('checked')) {
                return
            }
            switch ($(this).attr('id')){
                case 'tipo-resposta-dissertativa':
                    $('form').find('input[name="tipoResposta"][type="checkbox"]#tipo-resposta-alternativa').prop('checked', false)
                    break
                case 'tipo-resposta-alternativa':
                    $('form').find('input[name="tipoResposta"][type="checkbox"]#tipo-resposta-dissertativa').prop('checked', false)
                    break
                default:
                    break
            }
        })
        $('form').on('change', function () {

            var formData = $(this).serializeArray()
            var formJSON = {};

            $.each(formData, function() {
                if (formJSON[this.name]) {
                    if (!formJSON[this.name].push) {
                        formJSON[this.name] = [formJSON[this.name]];
                    }
                    formJSON[this.name].push(this.value || '');
                } else {
                    formJSON[this.name] = this.value || '';
                }
            });

            if (formJSON.tipoResposta == 'on') {
                formJSON.tipoResposta = $('form input[type="checkbox"]:checked').val()
            }

            $.ajax({
                url: 'get/perguntas',
                type: 'get',
                dataType: 'html',
                data: formJSON
            })
            .done(function (data) {
                $('section#perguntas').html(data)
            })
        })
    </script>
</main>