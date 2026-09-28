<?php

$host = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS nexora_taskflow";

if ($conn->query($sql) === TRUE) {

    $conn->select_db("nexora_taskflow");

    $table = "CREATE TABLE IF NOT EXISTS project_tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(150) NOT NULL,
        description TEXT,
        assigned_to VARCHAR(100) NOT NULL,
        priority ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
        due_date DATE NOT NULL,
        status ENUM('Not Started', 'In Progress', 'Completed') DEFAULT 'Not Started',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($table) === TRUE) {
        echo "<h2>Nexora TaskFlow setup complete!</h2>";
        echo "<p>The project task database is ready.</p>";
        echo "<a href='index.php'>Open TaskFlow</a>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

?>