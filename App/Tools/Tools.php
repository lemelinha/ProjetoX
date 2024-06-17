<?php

namespace App\Tools;
use App\Connection;

abstract class Tools {
    /**
     *  Verifica se um usuário já existe
     * 
     *  Acessa o banco de dados para 
     *  verificar se um nome de usuário ou email já 
     *  está em uso
     * 
     *  @param string $usuario 
     *  @param string $email 
     * 
     *  @return bool
     */
    static public function usernameOrEmailExists($username, $email){
        $sql = "SELECT 
                *
            FROM
                tb_usuario
            WHERE 
                (nm_usuario = :usuario OR nm_email = :email)
        ";
        $query = Connection::connect()->prepare($sql);
        $query->bindParam(':usuario', $username);
        $query->bindParam(':email', $email);
        $query->execute();

        if ($query->rowCount() != 0){
            return true;
        }

        if ($_ENV['ADMIN_USER'] == $username) {
            return true;
        }

        return false;
    }
}
