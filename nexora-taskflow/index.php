<?php
require "db.php";

$result = $conn->query("SELECT * FROM project_tasks ORDER BY due_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nexora TaskFlow</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <header>
        <h1>NEXORA TaskFlow</h1>
        <p>AI Adoption Risk Project</p>
    </header>

    <div class="top">
        <h2>Project Tasks</h2>
        <a href="create.php" class="button">+ Assign Task</a>
    </div>

    <table>
        <tr>
            <th>Task</th>
            <th>Assigned To</th>
            <th>Priority</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($task = $result->fetch_assoc()): ?>

        <tr>
            <td><?php echo htmlspecialchars($task["title"]); ?></td>

            <td><?php echo htmlspecialchars($task["assigned_to"]); ?></td>

            <td><?php echo htmlspecialchars($task["priority"]); ?></td>

            <td><?php echo htmlspecialchars($task["due_date"]); ?></td>

            <td><?php echo htmlspecialchars($task["status"]); ?></td>

            <td>
                <a href="edit.php?id=<?php echo $task["id"]; ?>">Edit</a>
                |
                <a href="delete.php?id=<?php echo $task["id"]; ?>"
                   onclick="return confirm('Delete this task?');">
                    Delete
                </a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>