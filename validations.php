<?php
include_once 'connection.php';
class validations
{
    public $errors = [];


    public function ValidateName($name)
    {
        if (empty($name)) {
            $this->errors[] = 'name is requierd';
            return false;
        } else if (strlen($name) <= 2) {
            $this->errors[] = 'name must be greater than 2 chars';
            return false;
        } else if (strlen($name) > 20) {
            $this->errors[] = 'name must be smaller than 20 chars';
            return false;
        } else {
            return true;
        }
    }

    public function ValidateEmail($email)
    {
        if (empty($email)) {
            $this->errors[] = 'email is requierd';
            return false;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Invalid email';
            return false;
        } else {
            return true;
        }
    }
    public function ValidatePassword($password)
    {
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).{8,16}$/';
        if (preg_match($pattern, $password)) {
            return true;
        } else if (strlen($password) < 8) {
            $this->errors[] = 'Password should be at least 8 chars';
            return false;
        } else if (strlen($password) > 16) {
            $this->errors[] = 'Password must be less than 16 chars';
            return false;
        } else if (!preg_match('/[A-Z]/', $password)) {
            $this->errors[] = 'Password should contain at least one capital char';
            return false;
        } else if (!preg_match('/[a-z]/', $password)) {
            $this->errors[] = 'Password should contain at least one small char';
            return false;
        } else if (!preg_match('/[^\w\s]/', $password)) {
            $this->errors[] = 'Password should contain at least one special char';
            return false;
        }
    }

    public function ConfirmPssword($con, $password_user, $id)
    {
        $sql = $con->query("SELECT password from users where id = $id;");
        $db_password = $sql->fetchColumn(PDO::FETCH_DEFAULT);
        if (password_verify($password_user, $db_password)) {
            return true;
        } else {
            return false;
        }
    }
    public function EmailExist($con, $new_email)
    {
        $sql = $con->query("SELECT email from users;");
        $emails = $sql->fetchall(PDO::FETCH_ASSOC);
        foreach ($emails as $email) {
            if ($email == $new_email) {
                $this->errors[] = 'Email already exists';
                return false;
            }
        }
        return true;
    }
    public function TaskLength($input)
    {
        if (strlen($input) > 250) {
            $this->errors[] = 'task can not be more than 250 chars';
            return false;
        } else if (empty($input)) {
            $this->errors[] = 'the new task can not be empty';
            return false;
        } else {
            return true;
        }
    }
    public function EmailNotExist($con, $new_email)
    {
        $sql = $con->query("SELECT email from users;");
        $emails = $sql->fetchall(PDO::FETCH_ASSOC);
        foreach ($emails as $email) {
            if ($email == $new_email) {
                return true;
            }
        }
        $this->errors[] = 'email does not exist';
        return false;
    }
    public function RequestMethod($method)
    {
        if ($method==$_SERVER['REQUEST_METHOD'])
        {
            return true;
        }
        else{
            $this->errors[]='Invalid Method';
             return false;
        }

    }
    
}
$validate = new validations();
