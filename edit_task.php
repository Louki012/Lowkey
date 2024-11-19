<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id = $id");
$task = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $status, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Edit Task</h1>
    <form method="POST">
        <input type="text" name="title" value="<?php echo $task['title']; ?>" required>
        <textarea name="description"><?php echo $task['description']; ?></textarea>
        <select name="status">
            <option value="Pending" <?php if ($task['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Completed" <?php if ($task['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
        </select>
        <button type="submit">Update Task</button>
    </form>
      </div>
</body>
</html>
