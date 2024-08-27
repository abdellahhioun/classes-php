<?php
require 'db_conn_pdo.php';
require 'user-pdo.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $userData = Userpdo::read($pdo, $id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $user = new Userpdo($login, $password, $email, $firstname, $lastname, $id);
    if ($user->update($pdo)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Failed to update user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            max-width: 600px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update User</h1>
        <?php if ($userData): ?>
            <form action="" method="post">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($userData['login']); ?>" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($userData['firstname']); ?>" required>
                
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($userData['lastname']); ?>" required>
                
                <input type="submit" value="Update User">
            </form>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
        <a href="index.php">Back to Index</a>
    </div>
</body>
</html>
