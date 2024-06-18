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
        $filterMateria = $_GET['materia']??'';
        $filterSubMateria = $_GET['submateria']??'';
        $filterTipoResposta = $_GET['tipo-resposta']??'';

        $PerguntaModel = new Pergunta();
        [$this->perguntas, $this->alternativas] = $PerguntaModel->searchPerguntas($filterMateria, $filterSubMateria, $filterTipoResposta);
        
        $this->renderView('perguntas');
    }
}
