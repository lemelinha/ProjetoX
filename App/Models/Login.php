<?php

namespace Models\Login;
use Needs\Model\Model;

class Login extends Model {
    public function authLogin($userOrEmail, $password) {
        $sql = "SELECT
                    *
                FROM
                    tb_usuario
                WHERE
                    (nm_usuario = :userEmail OR nm_email = :userEmail)
        ";
        $query = $this->db->prepare($sql);
        $query->bindParam(':userEmail', $userOrEmail);
        $query->execute();

        if ($query->rowCount() == 0) {
            return false;
        }

        $query->fetchAll();
        if (($query->nm_usuario == $userOrEmail || $query->nm_email == $userOrEmail) && password_verify($password, $query->cd_senha)){
            return true;
        }

        return false;
    }
}
