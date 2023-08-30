<?php
session_start();
include_once 'crud.php';
$task_id=$_POST['task_id'];
$delete= new crud();
$delete->DeleteTask($task_id);