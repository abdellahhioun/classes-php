<?php

class User {
    private $id;
    public $login;
    public $password; // Assuming you'll handle password hashing
    public $email;
    public $firstname;
    public $lastname;

    // Constructor to initialize attributes
    public function __construct($login, $password, $email, $firstname, $lastname, $id = null) {
        $this->id = $id;
        $this->login = $login;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hashing the password
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    // Create a new user (C in CRUD)
    public function create($conn) {
        $sql = "INSERT INTO utilisateur (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $this->login, $this->password, $this->email, $this->firstname, $this->lastname);
        if ($stmt->execute()) {
            $this->id = $conn->insert_id; // Get the generated ID
            return true;
        }
        return false;
    }

    // Read user details by ID (R in CRUD)
    public static function read($conn, $id) {
        $sql = "SELECT * FROM utilisateur WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update user details (U in CRUD)
    public function update($conn) {
        $sql = "UPDATE utilisateur SET login = ?, password = ?, email = ?, firstname = ?, lastname = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $this->login, $this->password, $this->email, $this->firstname, $this->lastname, $this->id);
        return $stmt->execute();
    }

    // Delete a user by ID (D in CRUD)
    public static function delete($conn, $id) {
        $sql = "DELETE FROM utilisateur WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getId() {
        return $this->id;
    }
}
