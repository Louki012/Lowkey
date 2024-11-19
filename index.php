<?php
include 'db.php';

$result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Josh Todo_List</h1>

    
    <form action="add_task.php" method="POST">
        <input type="text" name="title" placeholder="Task Title" required>
        <textarea name="description" placeholder="Task Description"></textarea>
        <button type="submit">Add Task</button>
    </form>

    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
   <?php while($task = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $task['id']; ?></td>
                <td><?php echo $task['title']; ?></td>
                <td><?php echo $task['description']; ?></td>
                <td><?php echo $task['status']; ?></td>
                <td>
                    <a href="edit_task.php?id=<?php echo $task['id']; ?>">Edit</a>
                    <a href="delete_task.php?id=<?php echo $task['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>

