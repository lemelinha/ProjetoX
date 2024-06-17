<?php

namespace App\Models;
use Needs\Model\Model;

class Materias extends Model {
    public function addMateria($materia) {
        $sql = "INSERT INTO
                    tb_materia
                VALUES
                    (NULL, :materia)
        ";

        $query = $this->db->prepare($sql);
        $query->bindParam(':materia', $materia);
        $query->execute();

        return;
    }

    public function addSubMateria($submateria, $materia) {
        $sql = "INSERT INTO
                    tb_submateria
                VALUES
                    (NULL, :submateria, :materia)
        ";

        $query = $this->db->prepare($sql);
        $query->bindParam(':submateria', $submateria);
        $query->bindParam(':materia', $materia);
        $query->execute();

        return;
    }

    public function returnMaterias() {
        $sql = "SELECT
                    *
                FROM
                    tb_materia
        ";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function returnSubMaterias() {
        $sql = "SELECT
                    cd_submateria,
                    nm_submateria,
                    nm_materia
                FROM
                    tb_submateria
                INNER JOIN
                    tb_materia
                    ON
                        id_materia = cd_materia
        ";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
