<?php
include 'db.php';

$id = $_GET['id'];

if ($conn->query("DELETE FROM tasks WHERE id = $id")) {
    header("Location: index.php");
} else {
    echo "Error: " . $conn->error;
}
?>
