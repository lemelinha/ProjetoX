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
                $this->insertAlternativas($idPergunta);
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
        $sql = "INSERT INTO
                    tb_alternativa
                VALUES
                    (NULL, )
        ";
    }
}
