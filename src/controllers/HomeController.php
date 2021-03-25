<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
use \src\models\User;

class HomeController extends Controller {

    private $UserLogged;

    public function __construct() {
        $this -> UserLogged = LoginHandler::CheckLogin();

        if($this -> UserLogged === false) {
            $this -> redirect('/login');
        }
    }
    public function index() {
        $this -> render('home', ['nome' => 'Bonieky']);
    }

}