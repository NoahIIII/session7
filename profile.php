<!DOCTYPE html>
<?php session_start(); ?>
<?php 
include_once 'connection.php';
include_once 'actions/crud.php';
?>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="css/bootstrap.min.css" rel='stylesheet'>

    <link rel="stylesheet" href="style/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">       
</head>
<body>
<div class="container profile-container">
    <div class="header-section">
        
        <h1>Have a good day! , ^^ </h1>
    </div>
    
    <form action="actions/create.php" method="POST" class="task-form">
        <input type="text" name="task" placeholder="New task">
        <input type="submit" value="Create New Task">
    </form>
</div>
<?php if (!empty($_SESSION['errors'])): ?>
    <?php foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-danger text-center"><?= $error; ?></div>
    <?php endforeach; ?>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>


<div class="table-container">
        <?php       
        $read= new crud();
        $tasks=$read->ReadTask('*','tasks');
        ?>
       
<?php if (!empty($_SESSION['suc'])): ?>
    <?php foreach ($_SESSION['suc'] as $suc): ?>
        <div class="alert alert-success text-center"><?= $suc; ?></div> 
    <?php endforeach; ?>
    <?php unset($_SESSION['suc']); ?>
<?php endif; ?>

    <table class="table">

        <thead>
        <?php if(!empty($tasks)) :?>
            <tr>
                <th>#</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
            
            <?php foreach ($tasks as $task) :?>
                <tr>
            <td> <?=$task['id'] ?></td>
            <td> <?=$task['tasks'] ?></td>
            <td> 
            <div class="row">
        <div class="col">
            <form action="actions/delete.php" method="post">
                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </div>
        <div class="col">
            <form action="actions/edit_view.php" method="post">
                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                
                <button type="submit" class="btn btn-sm btn-primary">Edit</button>
            </form>
        </div>
    </div>
                 </td>
            
            </tr>
            <?php endforeach;?>
            <?php endif;?>
        </thead>
        <tbody>
           <tr></tr>
        </tbody>
</body>
</html>

