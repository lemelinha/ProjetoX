<?php

namespace App\Models;
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

        $query = $query->fetchAll()[0];
        if (($query->nm_usuario == $userOrEmail || $query->nm_email == $userOrEmail) && password_verify($password, $query->cd_senha)){
            $_SESSION['logged'] = [
                'id' => $query->cd_usuario,
                'user' => $query->nm_usuario,
                'email' => $query->nm_email,
                'creation_date' => $query->dt_criacao
            ];
            return true;
        }

        return false;
    }

    public function authLoginAdmin($identifier, $password) {
        if ($_ENV['ADMIN_USER'] == $identifier && password_verify($password, $_ENV['ADMIN_PASSWORD_HASH'])) {
            $_SESSION['logged'] = [
                'user' => $_ENV['ADMIN_USER']
            ];
            return true;
        }
        return false;
    }
}
