<?php
require 'db_conn_pdo.php';
require 'user-pdo.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $user = Userpdo::read($pdo, $id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Details</h1>
        <?php if ($user): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                </tr>
                <tr>
                    <th>Login</th>
                    <td><?php echo htmlspecialchars($user['login']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                </tr>
            </table>
            <a href="index.php">Back to Index</a>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
