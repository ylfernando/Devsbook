<?php
namespace src\controllers;

use \core\Controller;

class LoginController extends Controller {

    public function SignIn() {
       $this -> render('login');
    }

    public function SignInAction() {
        echo 'Login recebido!';
    }
    public function SignUp() {
        echo 'Cadastrar';
    }

}