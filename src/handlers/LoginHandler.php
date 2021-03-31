<?php

namespace src\handlers;
use \src\models\User;

class LoginHandler {

    public static function CheckLogin() {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $data = User::select() -> where('token', $token) -> one();

            if(count($data) > 0) {
                $UserLogged = new User();
                $UserLogged -> id = $data['id'];
                $UserLogged -> name = $data['name'];
                $UserLogged -> email = $data['email'];
            }
            
        else {
            return false;
        }
        }
        
        else {
            return false;
        }
    }

    public static function VerifyLogin($email, $password) {
        $user = User::select() -> where("email", $email) -> one();

        if($user) {

            if(password_verify($password, $user['password'])) {
                $token = md5(time().rand(0, 9999).time());

                User::update() -> set('token', $token) -> where("email", $email) -> execute();
                return $token;
            }
        }
        return false;
    }

    public static function EmailExists($email) {
        $user = User::select() -> where("email", $email) -> one();
        return $user ? true : false;

    }

    public static function AddUser($name, $email, $password, $birthdate) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time().rand(0, 9999).time());

        //Inserindo os dados do usuário
        User::insert([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'birthdate' => $birthdate,
            'token' => $token
        ]) -> execute();
    }
};?>