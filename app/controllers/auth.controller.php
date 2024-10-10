<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';

class AuthController {
    private $userModel;
    private $authView;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->authView = new AuthView();
    }

    public function showLogin() {
        return $this->authView->showLogin();
    }

    public function showRegister() {
        return $this->authView->showRegister();
    }

    public function login() {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            return header('Location: ' . BASE_URL . 'mostrarLogin');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $userFromDB = $this->userModel->getUserByUsername($username);

        if($userFromDB && password_verify($password, $userFromDB->password)){
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['USERNAME'] = $userFromDB->username;
    
            header('Location: ' . BASE_URL);
        } else {
            return $this->authView->showLogin('Credenciales incorrectas');
        }
    }

    public function register() {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            return header('Location: ' . BASE_URL . 'mostrarRegistro');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $userCreated = $this->userModel->setUserByUsername($username, password_hash($password, PASSWORD_DEFAULT));

            session_start();
            $_SESSION['ID_USER'] = $username;
            $_SESSION['USERNAME'] = $password;
            header('Location: ' . BASE_URL);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return $this->authView->showRegister('El usuario ya existe');
            }
            return $this->authView->showRegister($e->getMessage());
        }
    }
}

