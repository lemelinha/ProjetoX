<?php
    foreach ($this->perguntas as $pergunta): 
        if ($pergunta->ds_dissertativo_gabarito!=null && $this->filterTipoResposta == 'alternativa') continue;
        if ($pergunta->ds_dissertativo_gabarito==null && $this->filterTipoResposta == 'dissertativa') continue;
    ?>
        <div class="pergunta">
            <h2><?= $pergunta->nm_titulo ?></h2>
            <span>Tipo: <?= $pergunta->ds_dissertativo_gabarito!=null?'Dissertativa':'Alternativa' ?></span>
            <span><strong><?= $pergunta->nm_materia ?></strong></span>
            <span style="margin-bottom: 0"><?= $pergunta->nm_submateria ?></span>
            <p><?= $pergunta->pergunta_enunciado ?></p>
            <?php
                if ($pergunta->ds_dissertativo_gabarito != null) { ?>
                    <span>Resposta:</span>
                    <p><?= $pergunta->ds_dissertativo_gabarito ?></p>
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
        </div>
<?php endforeach;