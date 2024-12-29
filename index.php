<?php 
    require "Task.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // $email = $_POST['email'];
        $TaskTitle=$_POST['task-title'];
        $TaskDescription=$_POST['task-title'];
        $TaskType=$_POST['task-type'];
        $AssignTaskTo=$_POST['assigned-user'];
        $TaskStatus=$_POST['task-status'];
       

    $Task=new clsTask($TaskTitle,$TaskDescription,$TaskType,$AssignTaskTo,$TaskStatus);
    $Task->CreateNewTask();
    // $Title,$Description,$Type,$AssignTo,$Status;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Task Management System</h1>
    </header>
    <main>
        <section id="task-list">
            <h2>Task List</h2>
            <ul>
                <li>
                    <strong>Task:</strong> Fix login issue 
                    <br><strong>Status:</strong> In Progress 
                    <br><strong>Assigned to:</strong> Mohamed
                </li>
                <li>
                    <strong>Task:</strong> Add search feature 
                    <br><strong>Status:</strong> Pending 
                    <br><strong>Assigned to:</strong> Fatima
                </li>
            </ul>
        </section>

        <section id="create-task">
            <h2>Create Task</h2>
            <form action="index.php" method="POST">
                <label for="task-title">Title:</label>
                <input type="text" id="task-title" name="task-title" required>

                <label for="task-description">Description:</label>
                <textarea name="task-description" id="task-description"></textarea>
                
                <label for="task-type">Type:</label>
                <select id="task-type" name="task-type" required>
                    <option value="basic">Basic</option>
                    <option value="bug">Bug</option>
                    <option value="feature">Feature</option>
                </select>

                <label for="assigned-user">Assign to:</label>
                <input type="text" id="assigned-user" name="assigned-user" required>

                <label for="task-status">Status:</label>
                <select id="task-status" name="task-status" required>
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>

                <button type="submit">Create Task</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Task Management System</p>
    </footer>
</body>
</html>
