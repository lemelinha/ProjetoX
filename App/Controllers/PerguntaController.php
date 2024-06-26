<?php

namespace App\Controllers;
use Needs\Controller\Controller;
use App\Models\Materias;
use App\Models\Pergunta;

class PerguntaController extends Controller {
    public function returnSubmaterias($materia) {
        $MateriasModel = new Materias();
        $this->submaterias = $MateriasModel->returnSubMaterias($materia['materia']);
        
        $this->renderView('submaterias');
        die();
    }

    public function addPergunta() {
        $PerguntaModel = new Pergunta();
        $PerguntaModel->addPergunta();
        echo json_encode(['insert' => true, 'message' => 'Pergunta publicada com sucesso!']);
        die();
    }

    public function searchPergunta() {
        $this->filterMateria = $_GET['materia']??'';
        $this->filterSubMateria = $_GET['submateria']??'';
        $this->filterTipoResposta = $_GET['tipoResposta']??'';

        $PerguntaModel = new Pergunta();
        [$this->perguntas, $this->alternativas] = $PerguntaModel->searchPerguntas($this->filterMateria, $this->filterSubMateria, $this->filterTipoResposta);

        $this->renderView('perguntas');
    }
}
