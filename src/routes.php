<?php
use core\Router;

$router = new Router();

$router -> get('/', 'HomeController@index');

//Rotas de login
$router -> get('/login', 'LoginController@SignIn');
$router -> post('/login', 'LoginController@SignInAction');

//Rotas de cadastro
$router -> get('/cadastro', 'LoginController@SignUp');
$router -> post('/cadastro', 'LoginController@SignUpAction');