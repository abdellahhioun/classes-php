<?php
require 'db_conn_pdo.php';

// Fetch all users
$sql = "SELECT * FROM utilisateur";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            background-color: #f4f4f4;
        }
        table {
            width: 80%;
            max-width: 1000px;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
    <h1>User Management</h1>
    <a href="create_user.php">Create New User</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['login']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                    <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                    <td>
                        <a href="read_user.php?id=<?php echo htmlspecialchars($user['id']); ?>">View</a> |
                        <a href="update_user.php?id=<?php echo htmlspecialchars($user['id']); ?>">Edit</a> |
                        <a href="delete_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
