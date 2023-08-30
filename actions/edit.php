<?php
 session_start();
 include_once '../functions.php';
 include_once '../validations.php';
 include_once 'crud.php';
 
 $validate= new validations();
 if($validate->RequestMethod('POST'))
 {
    $task_id=$_POST['task_id'];
    $filter= new functions();
    $new_task=$filter->sanitaization($_POST['new_task']);
    $edit= new crud();
    $edit->EditTask('tasks','tasks',$new_task,$task_id);
    
    
 }
 else
 {
    $_SESSION['errors']=$validate->errors;
    header('location:edit_view.php');

 }
