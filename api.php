<?php
include('configuration.php');
include('function.php');

$validate = new Validate();
$session = new Session();

if (isset($_GET['action'])) {
    $action = $_GET['action'];


    switch ($action) {
        case 'register':

            if (isset($_POST['submit'])) {

                session_start();

                if ($_POST['token'] !== $_SESSION['token']) {
                    exit('csrf token missatch');
                }

                $validate->empty_data($_POST['name']);
                $validate->isemail($validate->empty_data($_POST['email']));
                $validate->passwordCheck($validate->empty_data($_POST['password']));
                $validate->empty_data($_POST['repassword']);
                $validate->passwordMatch(
                    $_POST['password'],
                    $_POST['repassword']
                );

                $role = '2';
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                //start CREATE
                $stmt = $connect->prepare('INSERT INTO user (user_email, user_name, user_password, user_role) VALUES (?, ?, ?, ?)');

                $stmt->execute([
                    $_POST['email'],
                    $_POST['name'],
                    $password,
                    $role
                ]);

                echo "Success";
                header('Location: index.php');
                exit();
            }
            # code...
            break;
        case 'login':

            if (isset($_POST['submit'])) {

                session_start();

                if ($_POST['token'] !== $_SESSION['token']) {
                    exit('csrf token missatch');
                }


                $validate->isemail($validate->empty_data($_POST['email']));
                $validate->empty_data($_POST['password']);

                //start READ
                $stmt = $connect->prepare('SELECT * FROM user WHERE user_email = ? LIMIT 1');

                $stmt->execute([
                    $_POST['email']
                ]);

                $querydata = $stmt->fetch(PDO::FETCH_OBJ);

                if (password_verify($_POST['password'], $querydata->user_password)) {
                    $_SESSION['is_loggged'] = true;
                    $_SESSION['user_id'] = $querydata->user_id;
                    $_SESSION['user_name'] = $querydata->user_name;
                    $_SESSION['user_email'] = $querydata->user_email;
                    $_SESSION['user_role'] = $querydata->user_role;

                    header('Location: dashboard.php');
                    exit();
                } else {
                    echo "Invalid Email or password";
                }
            }
            # code...
            break;

        case 'profile':

            if (isset($_POST['submit'])) {
                
                session_start();

                if ($_POST['token'] != $_SESSION['token']) {
                    exit('csrf token missmatch');
                }

                $session->isLogin();
                $session->isAdmin();

                $validate->empty_data($_POST['name']);
                $validate->isemail($validate->empty_data($_POST['email']));
                $validate->empty_data($_POST['role']);

                $stmt = $connect->prepare('UPDATE user SET user_name = ?, user_email = ?, user_role = ? WHERE user_id = ?');

                $stmt->execute([
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['role'],
                    $_SESSION['user_id']
                ]);

                header('Location: user_profile.php');
                exit();
                exit('Success update!');
            }

            break;

        case 'delete':

            session_start();
    
            $session->isLogin();
            $session->isAdmin();

            $validate->isnumeric($validate->empty_data($_GET['user']));

            $stmt = $connect->prepare('SELECT * FROM user WHERE user_id = ? AND user_id != ');
            $stmt->execute([
                $_GET['user'],
                $_SESSION['user_id']//JANGAN DELETE DIRI SENDIRI
            ]);

            if ($stmt->rowCount() > 0) {
                $stmt = $connect->prepare('DELETE FROM user WHERE user_id = ?');
                $stmt->execute([
                    $_GET['user']
                ]);
                echo "Success Delete User";
            } else {
                exit('Invalid user');
            }

            break;

        case 'upload':

            if (isset($_POST['submit'])) {
                session_start();
                $session->isLogin();
                $session->isAdmin();

                $allowed_mime = array('image/pjpeg', 'image/jpeg', 'image/jpg', 'image/png');
                $allowed_extensions = array('png', 'jpg', 'jpeg');
                $file_explode = explode(".", $_FILES['image']['name']);
                $confirm_extensions = strtolower(end($file_explode));

                if (in_array($_FILES['image']['type'], $allowed_mime)) {

                    if (in_array($confirm_extensions, $allowed_extensions)) {

                        $filename = sha1($_FILES['image']['name'] . $random_value) . '.' . $confirm_extensions;

                        $data =  'id_pemohonan_' . uniqid() . '.jpg';
                        echo $data;
                    } else {
                        exit('invalid file');
                    }
                } else {
                    exit('invalid file');
                }
            }

            # code...
            break;
        default:
            # code...
            break;
    }
}
