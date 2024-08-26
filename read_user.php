<?php
require 'db_conn_pdo.php';
require 'user-pdo.php';

$user = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = Userpdo::read($pdo, $id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Read User</title>
</head>
<body>
    <h1>Read User</h1>
    <form method="get" action="">
        <label for="id">User ID:</label>
        <input type="number" id="id" name="id" required>
        <input type="submit" value="Read User">
    </form>

    <?php if ($user): ?>
        <h2>User Details</h2>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
        <p><strong>Login:</strong> <?php echo htmlspecialchars($user['login']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
    <?php elseif (isset($_GET['id'])): ?>
        <p>No user found with this ID.</p>
    <?php endif; ?>
</body>
</html>
