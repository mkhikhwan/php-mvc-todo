<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';

// Models
require_once __DIR__ . '/../models/User.php';


class AuthController extends Controller{
    private $userModel;

    public function __construct(){
        $dbInstance = Database::getInstance();
        $this->userModel = new User($dbInstance);
    }

    public function register(){
        $this->view('auth/register', [
            'errors' => $_SESSION['flash_errors'] ?? [],
            'old' => $_SESSION['flash_old'] ?? []
        ]);
        unset($_SESSION['flash_errors'], $_SESSION['flash_old']);
    }

    public function doRegister(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = [];

        if($username === ''){
            $errors['username'] = "Username is required.";
        }else if($this->userModel->findByUsername($username)){
            $errors['username'] = "Username already exists.";
        }

        if($password === ''){
            $errors['password'] = "Password is required.";
        }else if(!validatePassword($password)){
            $errors['password'] = "Password must be at least 8 characters long and contain at least one letter and one number.";
        }

        if(!empty($errors)){
            $_SESSION['flash_errors'] = $errors;
            $_SESSION['flash_old'] = ['username' => $username];
            $this->redirect("/register");
        }

        // Ok
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        echo "Successfully Registered <br>";
        echo "<br> Username: " . $username;
        echo "<br> Password: " . $hashedPassword;
    }

    public function login(){
        $this->view('auth/login', [
            $_SESSION['flash_errors'] ?? [],
            $_SESSION['flash_old'] ?? []
        ]);
        unset($_SESSION['flash_errors'], $_SESSION['flash_old']);
    }
}

function validatePassword($password){
    // Check if more than 8 chars
    if(!strlen($password) >= 8){
        return false;
    }

    // Check it must contain atleast 1 letter or 1 number
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password)) {
        return false;
    }

    // Password follows rule
    return true;
}
?>