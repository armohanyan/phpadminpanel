<?php

// include '/app/database/Model.php';
include '/var/www/html/phpadminpanel/database/Model.php';  

class UserController extends Model
{

    public function signUp()
    {
        if (isset($_POST['submitSignUp'])) {
            $errors = [];
            if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $age = $_POST['age'];

                $query = "INSERT INTO `users` (`username`, `email`, `password`, `age`) 
                        VALUES ('$username', '$email', '$password', $age)";

                if (mysqli_query($this->getConnect(), $query)) {
                    header('Location:../view/login.php');
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($this->getConnect());
                }
            } else {
                array_push($errors, "Empty field(s)");
                $_SESSION['errors'] = $errors;
                header('Location:../view/login.php');
            }
        }
    }

    public function signIn()
    {
        if (isset($_POST['submitSignIn'])) {
            $username = mysqli_real_escape_string($this->getConnect(), $_POST['username']);
            $password = mysqli_real_escape_string($this->getConnect(), $_POST['password']);
            $errors = [];

            if (empty($username) || empty($password)) {
                array_push($errors, "Empty field(s)");
                $_SESSION['errors'] = $errors;
                header('Location:../view/login.php');
            }

            if (count($errors) == 0) {
                $query = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
                $results = mysqli_query($this->getConnect(), $query);

                if (mysqli_num_rows($results) == 1) {
                    $_SESSION['user'] = mysqli_fetch_assoc($results);
                    if ($_SESSION['user']['id'] == 1) {
                        header('Location:../view/admin/index.php');
                    } else {
                        header('Location:../view/user.php');
                    }
                } else {
                    array_push($errors, "Invalid username or password");
                    $_SESSION['errors'] = $errors;
                    header('Location:../view/login.php');
                }
            }
        }
    }
}

$uerController = new UserController;

$uerController->signIn();
$uerController->signUp();
