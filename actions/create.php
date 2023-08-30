<?php
include_once '../validations.php';
include_once '../functions.php';
include_once 'crud.php';
session_start();


$filter= new functions();
$check= new validations();
if($check->RequestMethod('POST')){
$task=$filter->sanitaization($_POST['task']);
$create= new crud();
$create->CreateTask('tasks','tasks',$task);
$_SESSION['suc']=$create->suc;
header('location:../profile.php');
die;
}
else{
   $_SESSION['errors']= $check->errors;
   header('../profile.php');
   die;
}
