<?php

class User {
    private $id;
    public $login;
    public $password; 
    public $email;
    public $firstname;
    public $lastname;

    public function __construct($login, $password, $email, $firstname, $lastname, $id = null) {
        $this->id = $id;
        $this->login = $login;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hashing the password
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function create($conn) {
        $sql = "INSERT INTO utilisateur (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$this->login, $this->password, $this->email, $this->firstname, $this->lastname]);
        
        if ($stmt) {
            $this->id = $conn->lastInsertId(); 
            return true;
        }
        return false;
    }

    public static function read($conn, $id) {
        $sql = "SELECT * FROM utilisateur WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($conn) {
        $sql = "UPDATE utilisateur SET login = ?, password = ?, email = ?, firstname = ?, lastname = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$this->login, $this->password, $this->email, $this->firstname, $this->lastname, $this->id]);
    }

    public static function delete($conn, $id) {
        $sql = "DELETE FROM utilisateur WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getId() {
        return $this->id;
    }
}
