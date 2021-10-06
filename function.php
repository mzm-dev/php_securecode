<?php
include('configuration.php');
class Validate
{
    function __contruct()
    {
    }

    public function empty_data($data)
    {
        if (empty($data)) {
            exit('empty data');
        } else {
            return $data;
        }
    }

    public function isemail($data)
    {
        if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return $data;
        } else {
            exit('invalid email');
        }
    }

    public function passwordMatch($password, $repassword)
    {
        if ($password !== $repassword) {
            exit('password missmatch');
        }
    }

    public function passwordCheck($data)
    {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $data);
        $lowercase = preg_match('@[a-z]@', $data);
        $number    = preg_match('@[0-9]@', $data);
        $specialChars = preg_match('@[^\w]@', $data);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($data) < 8) {
            exit('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
        } else {
            // exit('Strong password.');
            return $data;
        }
    }

    function isnumeric($data)
    {
        if (filter_var($data, FILTER_VALIDATE_INT)) {
            return $data;
        } else {
            exit('invalid input, integar only');
        }
    }
}


class Session
{
    function __contruct()
    {
    }

    function isLogin()
    {
        if (empty($_SESSION['is_loggged'])) {            
            header('Location: ./');
            die;
        }
        return true;
        // header('Location: ./');
    }

    function isAdmin()
    {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 2) {
            session_destroy();
            header('Location: ./');
            die;
        }
    }
}


class Secure
{
    function __contruct()
    {
    }

    function xecho($data)
    {
        return htmlentities($data);
    }
}
