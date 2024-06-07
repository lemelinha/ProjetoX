<?php

namespace App\Tools;
use App\Connection;

abstract class Tools {
    /**
     *  Verifica se um usuário já existe
     * 
     *  Acessa o banco de dados para 
     *  verificar se um nome de usuário já 
     *  está em uso
     * 
     *  @param string $usuario 
     * 
     *  @return bool
     */
    static public function usernameExists($username){
        $sql = "
            SELECT 
                nm_usuario
            FROM
                tb_usuario
            WHERE 
                nm_usuario = :usuario
        ";
        $query = Connection::connect()->prepare($sql);
        $query->bindParam(':usuario', $username);
        $query->execute();

        if (empty($query->fetchAll())){
            return false;
        }

        return true;
    }
}
