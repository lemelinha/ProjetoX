<option value="" selected>Selecione uma submatéria</option>
<?php foreach ($this->submaterias as $submateria): ?>
    <option value="<?= $submateria->cd_submateria ?>"><?= $submateria->nm_submateria ?></option>
<?php endforeach;