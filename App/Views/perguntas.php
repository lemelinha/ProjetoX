<?php
    foreach ($this->perguntas as $pergunta): 
        if ($pergunta->ds_dissertativo_gabarito!=null && $this->filterTipoResposta == 'alternativa') continue;
        if ($pergunta->ds_dissertativo_gabarito==null && $this->filterTipoResposta == 'dissertativa') continue;
    ?>
        <div class="pergunta">
            <h2><?= $pergunta->nm_titulo ?></h2>
            <span>Tipo: <?= $pergunta->ds_dissertativo_gabarito!=null?'Dissertativa':'Alternativa' ?></span>
            <span>Matéria: <strong><?= $pergunta->st_materia!='D'?$pergunta->nm_materia:'unknown' ?></strong></span>
            <span style="margin-bottom: 0">SubMatéria: <?= $pergunta->st_submateria!='D'?$pergunta->nm_submateria:'unknown' ?></span>
            <p><?= $pergunta->pergunta_enunciado ?></p>
            <?php
                if ($pergunta->ds_dissertativo_gabarito != null) { ?>
                    <span>Resposta:</span>
                    <p> <?= $pergunta->ds_dissertativo_gabarito ?></p>
                <?php } else if ($pergunta->id_alternativa_gabarito != null) { 
                            $idPergunta = $pergunta->cd_pergunta;
                            $alternativas = array_filter(
                                $this->alternativas,
                                function ($alternativa) use ($idPergunta) {
                                    if ($alternativa->id_pergunta = $idPergunta) {
                                        return true;
                                    }
                                    return false;
                                }
                            );
                            ?>
                            <section class="alternativas-container">
                                <section class="alternativas">
                                    <?php foreach ($alternativas as $alternativa): 
                                        if ($pergunta->id_alternativa_gabarito == $alternativa->cd_alternativa) {
                                            $alternativaGabarito = $alternativa->nm_letra;
                                        }
                                    ?>
                                        <div class="alternativa">
                                            <p><?= $alternativa->nm_letra ?>)</p>
                                            <p><?= $alternativa->alternativa_enunciado ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </section>
                                <p>Resposta: &nbsp;&nbsp;&nbsp;<?= $alternativaGabarito ?>)</p>
                            </section>
                            <?php }
            ?>
            <p>Criado por: <?= $pergunta->nm_usuario ?> / <?= $pergunta->nm_email ?></p>
            <p style="margin-top: -20px">Criado em: <?= date('d/m/Y', strtotime($pergunta->dt_criacao)) ?></p>
            <?php
                if ($_SESSION['logged']['type'] == 'admin') { ?>
                    <button class="btn btn-excluir" style="color: #161616; cursor:pointer;" id="<?= $pergunta->cd_pergunta ?>">Excluir</button>
                <?php }
            ?>
        </div>
<?php endforeach; ?>
<script>
    $('button.btn-excluir').on('click', function () {
        $.ajax({
            url: `/admin/crud/delete/type/pergunta/id/${$(this).attr('id')}`,
            type: 'get',
            dataType: 'json',
            data: null
        })
        .done(function (data) {
            if (data.erro) {
                alert('Algo deu errado')
            } else {
                alert('Pergunta Deletada com sucesso')
            }
        })
    })
</script>