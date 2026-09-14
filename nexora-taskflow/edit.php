<?php
require "db.php";

$id = $_GET["id"];

$result = $conn->query("SELECT * FROM project_tasks WHERE id = $id");
$task = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $assigned_to = $_POST["assigned_to"];
    $priority = $_POST["priority"];
    $due_date = $_POST["due_date"];
    $status = $_POST["status"];

    $sql = "UPDATE project_tasks
            SET title=?, assigned_to=?, priority=?, due_date=?, status=?
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssi",
        $title,
        $assigned_to,
        $priority,
        $due_date,
        $status,
        $id
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
    <title>Edit Task - Nexora</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <header>
        <h1>NEXORA TaskFlow</h1>
        <p>Update project task</p>
    </header>

    <div class="form-box">

        <h2>Edit Task</h2>

        <form method="POST">

            <label>Task Title</label>
            <input
                type="text"
                name="title"
                value="<?php echo htmlspecialchars($task["title"]); ?>"
                required
            >

            <label>Assigned To</label>
            <input
                type="text"
                name="assigned_to"
                value="<?php echo htmlspecialchars($task["assigned_to"]); ?>"
                required
            >

            <label>Priority</label>
            <select name="priority">
                <option value="Low" <?php if ($task["priority"] == "Low") echo "selected"; ?>>Low</option>
                <option value="Medium" <?php if ($task["priority"] == "Medium") echo "selected"; ?>>Medium</option>
                <option value="High" <?php if ($task["priority"] == "High") echo "selected"; ?>>High</option>
            </select>

            <label>Due Date</label>
            <input
                type="date"
                name="due_date"
                value="<?php echo $task["due_date"]; ?>"
                required
            >

            <label>Status</label>
            <select name="status">
                <option value="Not Started" <?php if ($task["status"] == "Not Started") echo "selected"; ?>>Not Started</option>
                <option value="In Progress" <?php if ($task["status"] == "In Progress") echo "selected"; ?>>In Progress</option>
                <option value="Completed" <?php if ($task["status"] == "Completed") echo "selected"; ?>>Completed</option>
            </select>

            <button type="submit">Save Changes</button>

            <a href="index.php">Cancel</a>

        </form>

    </div>

</div>

</body>
</html>