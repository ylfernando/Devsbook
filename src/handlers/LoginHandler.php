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
};?>