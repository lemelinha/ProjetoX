<?php

namespace App\Models;
use Needs\Model\Model;

class Materias extends Model {
    public function addMateria($materia) {
        $sql = "INSERT INTO
                    tb_materia
                VALUES
                    (NULL, :materia, DEFAULT)
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
                    (NULL, :submateria, :materia, DEFAULT)
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

    public function returnSubMaterias($materiaPai='') {
        $sql = "SELECT
                    cd_submateria,
                    nm_submateria,
                    nm_materia,
                    st_materia,
                    st_submateria
                FROM
                    tb_submateria
                INNER JOIN
                    tb_materia
                    ON
                        id_materia = cd_materia
        ";

        if ($materiaPai != '') {
            $sql .= "WHERE
                        cd_materia = :materiaPai";
        }
        $query = $this->db->prepare($sql);
        if ($materiaPai != '') {
            $query->bindParam(':materiaPai', $materiaPai);
        }
        $query->execute();

        return $query->fetchAll();
    }

    public function deleteMateria($id) {
        $sql = "UPDATE
                    tb_materia
                SET
                    st_materia = 'D'
                WHERE
                    cd_materia = :id
        ";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        $sql = "UPDATE
                    tb_submateria
                SET
                    st_submateria = 'D'
                WHERE
                    id_materia = :id
        ";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public function deleteSubMateria($id) {
        $sql = "UPDATE
                    tb_submateria
                SET
                    st_submateria = 'D'
                WHERE
                    cd_submateria = :id
        ";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
    }
}
