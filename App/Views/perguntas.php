<?php
    foreach ($this->perguntas as $pergunta): ?>
        <div class="pergunta">
            <h3><?= $pergunta->nm_titulo ?></h3>
            <span>Tipo: <?= $pergunta->ds_dissertativo_gabarito!=null?'Dissertativa':'Alternativa' ?></span>
            <p><?= $pergunta->pergunta_enunciado ?></p>
            <?php
                var_dump($pergunta);
            ?>
            <!-- <?php
                if ($pergunta->ds_dissertativo_gabarito != null) { ?>
                    <span>Resposta:</span>
                    <p><?= $pergunta->ds_dissertativo_gabarito ?></p>
                <?php } else if ($pergunta->id_alternativa_gabarito != null) { 
                        $idPergunta = $pergunta->cd_pergunta;
                        var_dump(array_filter(
                            $this->alternativas,
                            function ($alternativa) use ($idPergunta) {
                                if ($alternativa->id_pergunta = $idPergunta) {
                                    return true;
                                }
                                return false;
                            }
                        ))
                    ?>
                    
                <?php }
            ?> -->
        </div>
<?php endforeach;