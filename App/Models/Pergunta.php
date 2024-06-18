<?php

namespace App\Models;
use Needs\Model\Model;

class Pergunta extends Model {
    public function addPergunta() {
        try {
            $this->db->beginTransaction();
            
            $sql = "INSERT INTO
                        tb_pergunta
                    VALUES
                        (NULL, :titulo, :enunciado, :materia, :submateria, :userCriador, NULL, NULL, DEFAULT)
            ";

            $query = $this->db->prepare($sql);
            $query->bindValue(':titulo', $_GET['titulo']??null);
            $query->bindValue(':enunciado', $_GET['enunciado']??null);
            $query->bindValue(':materia', $_GET['materia']??null);
            $query->bindValue(':submateria', $_GET['submateria']??null);
            $query->bindValue(':userCriador', $_SESSION['logged']['id']);
            $query->execute();

            $idPergunta = $this->db->lastInsertId();
            if ($_GET['tipo-resposta'] == 'alternativa') {
                $idGabaritoAlternativa = $this->insertAlternativas($idPergunta);
                
                $sql = "UPDATE
                            tb_pergunta
                        SET
                            id_alternativa_gabarito = :idAlternativa
                        WHERE
                            cd_pergunta = :idPergunta
                ";

                $query = $this->db->prepare($sql);
                $query->bindParam(':idAlternativa', $idGabaritoAlternativa);
                $query->bindParam(':idPergunta', $idPergunta);
                $query->execute();
            } else if ($_GET['tipo-resposta'] == 'dissertativa') {
                $sql = "UPDATE
                            tb_pergunta
                        SET
                            ds_dissertativo_gabarito = :gabarito
                        WHERE
                            cd_pergunta = :pergunta
                ";
                $query = $this->db->prepare($sql);
                $query->bindValue(':gabarito', $_GET['resposta-dissertativa']??null);
                $query->bindParam(':pergunta', $idPergunta);
                $query->execute();
            }
            
            $this->db->commit();
        } catch (PDOException $e) {
            echo json_encode(['insert' => false, 'message' => 'Algo deu errado no servidor :/']);
            $this->db->rollBack();
            die();
        }
    }

    private function insertAlternativas($idPergunta) {
        $alternativas = [
            'a' => $_GET['a'],
            'b' => $_GET['b'],
            'c' => $_GET['c'],
            'd' => $_GET['d'],
            'e' => $_GET['e']
        ];
        foreach ($alternativas as $letra => $enunciado) {
            $sql = "INSERT INTO
                        tb_alternativa
                    VALUES
                        (NULL, :letra, :enunciado, :idPergunta)
            ";

            $query = $this->db->prepare($sql);
            $query->bindParam(':letra', $letra);
            $query->bindParam(':enunciado', $enunciado);
            $query->bindParam(':idPergunta', $idPergunta);
            $query->execute();

            if ($letra == $_GET['gabarito-alternativa']) {
                $idGabaritoAlternativa = $this->db->lastInsertId();
            }
        }
        return $idGabaritoAlternativa;
    }

    public function searchPerguntas($materia, $submateria, $tipoResposta) {
        $sql = "SELECT
                    p.cd_pergunta,
                    p.nm_titulo,
                    p.ds_enunciado as pergunta_enunciado,
                    m.nm_materia,
                    sm.nm_submateria,
                    p.ds_dissertativo_gabarito,
                    p.id_alternativa_gabarito
                FROM
                    tb_pergunta as p
                INNER JOIN
                    tb_materia as m
                    ON
                        p.id_materia = m.cd_materia
                INNER JOIN
                    tb_submateria as sm
                    ON
                        p.id_submateria = sm.cd_submateria
        ";

        $query_pergunta = $this->db->prepare($sql);
        $query_pergunta->execute();
        $perguntas = $query_pergunta->fetchAll();
        
        $alternativas = null;
        if ($tipoResposta == 'alternativa') {
            $sql = "SELECT
                        nm_letra,
                        ds_enunciado as alternativa_enunciado,
                        id_pergunta
                    FROM
                        tb_alternativa
                    INNER JOIN
                        tb_pergunta
                        ON
                            cd_pergunta = id_pergunta
            ";

            $query_alternativas = $this->db->prepare($sql);
            $query_alternativas->execute();
            $alternativas = $query_alternativas->fetchAll();
        }

        return [$perguntas, $alternativas];
    }
}
