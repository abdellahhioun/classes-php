<?php
require 'db_conn_pdo.php';
require 'user-pdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $login = $_POST['login'];
    $password = $_POST['password']; // Added this
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $user = new Userpdo($login, $password, $email, $firstname, $lastname, $id);
    if ($user->update($pdo)) {
        echo "User updated successfully.";
    } else {
        echo "Failed to update user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <form method="post" action="">
        <label for="id">User ID:</label>
        <input type="number" id="id" name="id" required><br><br>
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required><br><br>
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required><br><br>
        <input type="submit" value="Update User">
    </form>
</body>
</html>
