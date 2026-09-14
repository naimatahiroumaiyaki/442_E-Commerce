<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $assigned_to = $_POST["assigned_to"];
    $priority = $_POST["priority"];
    $due_date = $_POST["due_date"];
    $status = $_POST["status"];

    $sql = "INSERT INTO project_tasks 
            (title, description, assigned_to, priority, due_date, status)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssss",
        $title,
        $description,
        $assigned_to,
        $priority,
        $due_date,
        $status
    );

    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Assign Task - Nexora</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <header>
        <h1>NEXORA TaskFlow</h1>
        <p>Assign a new project task</p>
    </header>

    <div class="form-box">

        <h2>New Task</h2>

        <form method="POST">

            <label>Task Title</label>
            <input type="text" name="title" required>

            <label>Description</label>
            <textarea name="description"></textarea>

            <label>Assigned To</label>
            <input type="text" name="assigned_to" required>

            <label>Priority</label>
            <select name="priority">
                <option value="Low">Low</option>
                <option value="Medium" selected>Medium</option>
                <option value="High">High</option>
            </select>

            <label>Due Date</label>
            <input type="date" name="due_date" required>

            <label>Status</label>
            <select name="status">
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>

            <button type="submit">Assign Task</button>

            <a href="index.php">Cancel</a>

        </form>

    </div>

</div>

</body>
</html>