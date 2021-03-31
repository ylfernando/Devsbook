<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller {

    public function SignIn() {
        $flash = '';
       if(!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
       }
       $this -> render('login', [
           'flash' => $flash
       ]);
    }

    public function SignInAction() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if($email && $password) {
            $token = LoginHandler::VerifyLogin($email, $password);

            if($token) {
                $_SESSION['token'] = $token;
                $this -> redirect('/');
            }
            
        else {
            $_SESSION['flash'] = 'Email e/ou senha incorretas!';
            $this -> redirect('/login');
            }
        }
        else {
            $_SESSION['flash'] = 'Email ou senha inexistentes!';
            $this -> redirect('/login');
         }
}
    public function SignUp() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
         $flash = $_SESSION['flash'];
         $_SESSION['flash'] = '';
        }
        $this -> render('cadastro', [
            'flash' => $flash
        ]);
    }

    public function SignUpAction() {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $birthdate = filter_input(INPUT_POST, 'birthdate');

        //Verificação de existência
        if($nome && $email && $password && $birthdate) {

            //Verificação da data de nascimento
            $birthdate = explode('/', $birthdate);
            if(count($birthdate) != 3) {
                $_SESSION['flash'] = 'Data de nascimento inválida!';
                $this -> redirect('/cadastro');
            }

            //2º Verificação
            $birthdate = $birthdate['2'].'-'.$birthdate['1'].'-'.$birthdate['0'];
            if(strtotime($birthdate) === false) {
                $_SESSION['flash'] = 'Data de nascimento inválida!';
                $this -> redirect('/cadastro');
            }

            //Verificação do e-mail
            if(LoginHandler::EmailExists($email) === false) {
                $token = LoginHandler::AddUser($nome, $email, $password, $birthdate);
                $_SESSION['token'] = $token;
                $this -> redirect('/');
            }
            else {
                $_SESSION['flash'] = 'E-mail já cadastrado!';
                $this -> redirect('/cadastro');
            }
        }

        else {
            $this -> redirect('/cadastro');
        }
    }

}