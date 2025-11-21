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
        $email = $_POST['email'];
        $confirmPassword = $_POST['confirmPassword'];

        $errors = [];

        if($username === ''){
            $errors['username'] = "Username is required.";
        }else if($this->userModel->findByUsername($username)){
            $errors['username'] = "Username already exists.";
        }

        if($email === ''){
            $errors['email'] = "Email is required.";
        }else if($this->userModel->findByEmail($email)){
            $errors['email'] = "Email already exists.";
        }

        if($password === ''){
            $errors['password'] = "Password is required.";
        }else if(!validatePassword($password)){
            $errors['password'] = "Password must be at least 8 characters long and contain at least one letter and one number.";
        }

        if($confirmPassword === ''){
            $errors['confirmPassword'] = "Confirm Password is required.";
        }else if($password !== $confirmPassword){
            $errors['confirmPassword'] = "Confirm Password does not match.";
        }

        if(!empty($errors)){
            $_SESSION['flash_errors'] = $errors;
            $_SESSION['flash_old'] = [
                'username' => $username,
                'email' => $email
            ];
            $this->redirect("/register");
        }

        // Ok
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $ok = $this->userModel->create($username, $email, $hashedPassword);
        if($ok){
            // Successfully Register
            echo "Successfully Registered <br>";
            echo "<br> Username: " . $username;
            echo "<br> Email: " . $email;
            echo "<br> Password: " . $hashedPassword;

            // TODO: Auto login and redirect to /tasks
        }else{
            // Fail to register
            $_SESSION['flash_errors'] = ['general' => 'Registration failed. Please try again.'];
            $this->redirect('/register');
        }
    }

    public function login(){
        $this->view('auth/login', [
            "errors" => $_SESSION['flash_errors'] ?? [],
            "old" => $_SESSION['flash_old'] ?? []
        ]);
        unset($_SESSION['flash_errors'], $_SESSION['flash_old']);
    }

    public function doLogin(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = [];

        // Verify if username exists
        if($username === '' || $password === ''){
            $errors = ['general' => "Username/Password is required."];
        }else{
            // Check username
            $user = $this->userModel->findByUsername($username);

            if(!$user || !password_verify($password, $user['password'])){
                $errors = ['general' => "Username/Password is invalid."];
            }else{
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $this->redirect("/tasks");
            }
        }

        if(!empty($errors)){
            $_SESSION['flash_errors'] = $errors;
            $_SESSION['flash_old'] = [
                'username' => $username
            ];
            $this->redirect("/login");
        }

    }

    public function logout(){
        session_unset();
        session_destroy();

        session_start();
        $this->redirect("/");
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