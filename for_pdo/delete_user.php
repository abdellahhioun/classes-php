<?php
require 'db_conn_pdo.php';
require 'user-pdo.php';

$id = $_GET['id'] ?? null;
if ($id) {
    if (Userpdo::delete($pdo, $id)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "No ID provided.";
}
?>
