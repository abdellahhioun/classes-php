<?php
class Userpdo {
    private $id;
    public $login;
    public $password; // Added this
    public $email;
    public $firstname;
    public $lastname;

    // Constructor to initialize attributes
    public function __construct($login, $password, $email, $firstname, $lastname, $id = null) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    // Create a new user
    public function create($pdo) {
        $sql = "INSERT INTO utilisateur (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        // Password should be hashed before storing
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        return $stmt->execute([$this->login, $hashedPassword, $this->email, $this->firstname, $this->lastname]);
    }

    // Read user details by ID
    public static function read($pdo, $id) {
        $sql = "SELECT * FROM utilisateur WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user details
    public function update($pdo) {
        $sql = "UPDATE utilisateur SET login = ?, password = ?, email = ?, firstname = ?, lastname = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        // Password should be hashed before updating
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        return $stmt->execute([$this->login, $hashedPassword, $this->email, $this->firstname, $this->lastname, $this->id]);
    }

    // Delete a user by ID
    public static function delete($pdo, $id) {
        $sql = "DELETE FROM utilisateur WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Get ID
    public function getId() {
        return $this->id;
    }
}
?>
