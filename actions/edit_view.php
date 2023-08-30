<!DOCTYPE html>
<?php session_start();
include_once '../functions.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/edit.css"> 
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Edit Task</h1>
            
        </div>
       <?php
       $task_id =$_POST['task_id'];
       
       ?>
        <form action="edit.php" method="POST" class="mt-5">
            <div class="form-group">
                <label for="task">Update Task:</label>
                <input type="text" name="new_task" class="form-control" placeholder="Enter updated task" required>
                <input type="hidden" name="task_id" value=<?=$task_id ?>>
                
            </div>
            <button type="submit" class="btn btn-edit">Edit Task</button>
        </form>
    </div>
</body>
</html>