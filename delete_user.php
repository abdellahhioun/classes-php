<?php
require 'db_conn_pdo.php';
require 'user-pdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    if (Userpdo::delete($pdo, $id)) {
        echo "User deleted successfully.";
    } else {
        echo "Failed to delete user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
</head>
<body>
    <h1>Delete User</h1>
    <form method="post" action="">
        <label for="id">User ID:</label>
        <input type="number" id="id" name="id" required>
        <input type="submit" value="Delete User">
    </form>
</body>
</html>
