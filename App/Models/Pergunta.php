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
                    m.cd_materia,
                    sm.cd_submateria,
                    sm.nm_submateria,
                    p.ds_dissertativo_gabarito,
                    p.id_alternativa_gabarito,
                    m.st_materia,
                    sm.st_submateria,
                    u.nm_usuario,
                    u.nm_email,
                    p.dt_criacao
                FROM
                    tb_pergunta AS p
                INNER JOIN
                    tb_materia AS m
                    ON
                        p.id_materia = m.cd_materia
                INNER JOIN
                    tb_submateria AS sm
                    ON
                        p.id_submateria = sm.cd_submateria
                INNER JOIN
                    tb_usuario AS u
                    ON
                        u.cd_usuario = p.id_usuario_criador
        ";

        if ($materia != '' || $submateria != '') {
            $sql .= "WHERE ";
            if ($materia != '') {
                $sql .= "m.cd_materia = :materia ";
            }
            if ($submateria != '') {
                if ($materia != '') {
                    $sql .= " AND ";
                }
                $sql .= " sm.cd_submateria = :submateria ";
            }
        }

        $sql .= " ORDER BY p.dt_criacao DESC";

        $query_pergunta = $this->db->prepare($sql);
        if ($materia != '') {
            $query_pergunta->bindParam(':materia', $materia);
        }
        if ($submateria != '') {
            $query_pergunta->bindParam(':submateria', $submateria);
        }
        $query_pergunta->execute();
        $perguntas = $query_pergunta->fetchAll();
        
        $alternativas = null;
        if ($tipoResposta == 'alternativa' || $tipoResposta == '') {
            $sql = "SELECT
                        cd_alternativa,
                        nm_letra,
                        a.ds_enunciado AS alternativa_enunciado,
                        id_pergunta
                    FROM
                        tb_alternativa AS a
                    INNER JOIN
                        tb_pergunta AS p
                        ON
                            cd_pergunta = id_pergunta
            ";

            $query_alternativas = $this->db->prepare($sql);
            $query_alternativas->execute();
            $alternativas = $query_alternativas->fetchAll();
        }

        return [$perguntas, $alternativas];
    }

    public function deletePergunta($id) {
        try {
            $this->db->beginTransaction();
            
            $pergunta = $this->executeStatement("SELECT * FROM tb_pergunta WHERE cd_pergunta = ?", [$id])[0];
            if ($pergunta->id_alternativa_gabarito != null) {
                $sql = "UPDATE
                            tb_pergunta
                        SET
                            id_alternativa_gabarito = NULL
                        WHERE
                            cd_pergunta = :id
                ";
                $query = $this->db->prepare($sql);
                $query->bindParam(':id', $id);
                $query->execute();

                $sql = "DELETE FROM
                            tb_alternativa
                        WHERE
                            id_pergunta = :id
                ";
                $query = $this->db->prepare($sql);
                $query->bindParam(':id', $id);
                $query->execute();
            }
            $sql = "DELETE FROM
                        tb_pergunta
                    WHERE
                        cd_pergunta = :id
            ";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();

            $this->db->commit();
        } catch (PDOException $e) {
            $this->rollBack();
        }
    }
}
