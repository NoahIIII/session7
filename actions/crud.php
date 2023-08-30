<?php
include_once 'validations.php';
include_once 'functions.php';

class crud
{
    public $con;
    public $suc = [];
    public $errors = [];
    function __construct()
    {
        $this->con = new PDO("mysql:host=localhost;dbname=session7;", "root", "");
    }
    public function CreateTask($table,$col,$values)
    {
        $validate = new validations();
        if ($validate->TaskLength($values) && $validate->RequestMethod('POST')) {
            $sql = $this->con->prepare("INSERT INTO $table ($col) values ('$values')");
            $sql->execute();
            $this->suc[] = 'task created';
            $_SESSION['suc'] = $this->suc;
            header('location:../profile.php');
        } else {
            $_SESSION['errors'] = $validate->errors;

            header('location:../profile.php');
        }
    }
    // كسلت اخلي الباقيين داينمك بس هي نفس الفكرة يعني فا متنقصنيش عليها بقى
    public function ReadTask($col,$table)
    {
        $sql = $this->con->query("SELECT $col FROM $table ;");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        

    }
    public function EditTask($table,$col, $values,$task_id)
    {
        $validate = new validations();
        if ($validate->TaskLength($values)) {
            $sql = $this->con->prepare("UPDATE $table SET $col = '$values' where id = $task_id;");
            $sql->execute();
            $this->suc[] = 'task edited';
            $_SESSION['suc'] = $this->suc;
            header('location:../profile.php');
            die;
        } else {
            $_SESSION["error"] = $validate->errors;
            header('location:../profile.php');
            die;
        }
    }
    function DeleteTask($task_id)
    {
        $sql = $this->con->prepare("DELETE FROM TASKS where id = '$task_id' ");
        $sql->execute();
        $this->suc[] = 'task deleted';
        $_SESSION['suc'] = $this->suc;
        header('location:../profile.php');
    }
}
