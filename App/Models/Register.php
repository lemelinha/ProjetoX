<?php

namespace App\Models;
use Needs\Model\Model;

class Register extends Model {
    public function register($user, $email, $password) {
        $sql = "INSERT INTO
                    tb_usuario
                VALUES
                    (NULL, :email, :usuario, :senha, DEFAULT)
        ";

        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->bindParam(':usuario', $user);
        $query->bindValue(':senha', password_hash($password, PASSWORD_BCRYPT));
        $query->execute();
        
        
        $_SESSION['logged'] = [
            'id' => $this->db->lastInsertId(),
            'user' => $user,
            'email' => $email
        ];
        
        return;
    }
}
