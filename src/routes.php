<?php
use core\Router;

$router = new Router();

$router -> get('/', 'HomeController@index');

$router -> get('/login', 'LoginController@SignIn');
$router -> post('/login', 'LoginController@SignInAction');

$router -> get('/cadastro', 'LoginController@SignUp');