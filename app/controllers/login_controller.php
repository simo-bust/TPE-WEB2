<?php
require_once './app/models/user.model.php';
require_once './app/views/view.php';

class UserController {
    private $model;
    private $view;

        public function __construct(){
            $this->model = new UserModel();
            $this->view = new View();
        }

        public function showLogin(){
            return $this->view->showLogin();
        }

        public function login(){

            if (!isset($_POST['name']) || empty($_POST['name'])){
                return $this->view->showLogin('Escriba su nombre');
            }

            if(!isset($_POST['password']) || empty($_POST['password'])){
                return $this->view->showLogin('Escriba su contraseña');
            }

            $name = $_POST['name'];
            $password = $_POST['password'];

            $userFromDB = $this->model->getUser($name);

            
            if($userFromDB && password_verify($password, $userFromDB->contraseña)){
                
                session_start();
                $_SESSION['ID_USER'] = $userFromDB->id;
                $_SESSION['NAME_USER'] = $userFromDB->nombre;
                
                header('Location:' . 'home');
            } else{
                return $this->view->showLogin('Credenciales incorrectas');
            }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('location:' . 'home');
    }
}