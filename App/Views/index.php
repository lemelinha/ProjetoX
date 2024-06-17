<main>
    <h1>Banco de perguntas</h1>
    <a class='btn' id='add-pergunta' href="/pergunta/form"><i class="fa-solid fa-plus"></i>Adicionar Pergunta</a>
    <section>
        <form id="filter" style="flex-direction: row">
        <label>Matéria: </label>
            <select name="materia">
                <option value="" selected>Todas</option>
                <option value="1">materia 1</option>
                <option value="2">materia 2</option>
            </select>
            <label>SubMatéria: </label>
            <select name="materia">
                <option value="" selected>Todas</option>
                <optgroup label='materia 1'>
                    <option value="1">submateria 1</option>
                    <option value="2">submateria 2</option>
                </optgroup>
                <optgroup label='materia 2'>
                    <option value="1">submateria 1</option>
                    <option value="2">submateria 2</option>
                </optgroup>
            </select>
            <label></label>
        </form>
        <section>
            
        </section>
    </section>

    <script>
        $('a#add-pergunta + section').css('margin-top', parseInt($('a#add-pergunta').css('height').replace('px', ''))+20)
    </script>
</main>