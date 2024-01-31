<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 * 
 * Copyright (c) 2020 Ronald M. Marasigan
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @copyright Copyright 2020 (https://ronmarasigan.github.io)
 * @since Version 1
 * @link https://lavalust.pinoywap.org
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

$router->get('/', 'Welcome::index');
$router->get('/register', 'Welcome::register');
$router->get('/login', 'Welcome::login');
$router->get('/dashboards', 'Welcome::dashboard');
$router->post('/validate_reg', 'Welcome::register_val');
$router->post('/dashboard', 'Welcome::login_val');
$router->post('/email', 'Welcome::email');
$router->get('/verify', 'Welcome::account');
$router->post('/check', 'Welcome::check');


//admin
$router->get('/create_quiz', 'Welcome::create_quiz_get');
$router->post('/create_quizzes', 'Welcome::create_quiz_post');
$router->get('/yours/(:num)', 'Welcome::displayRow/$id');
$router->get('/yourquizzes', 'Welcome::displayDifTitle');
//$router->get('/eachquiz', 'Welcome::displayAllEach');
$router->get('/eachquiz', 'Welcome::readAll');
//$router->get('/edit/(:num)', 'Welcome::edit/$1');
$router->get('/yourquizzes/delete/(:num)', 'Welcome::deleteyour');    //delete
$router->get('/eachquiz/delete/(:num)', 'Welcome::deleteeach');    //eachquiz
//$router->get('/eachquiz', 'Welcome::eachquiz');

//$router->get('/home/update/(:num)', 'User_controller::update');    //update
//$router->match('/home/edit/(:num)', 'User_controller::edit', 'GET|POST');       //sasalo
$router->get('/eachquiz/edit/(:num)', 'Welcome::edit');
$router->post('/eachquiz/submitedit/(:num)', 'Welcome::submitedit');
$router->get('/user_side', 'Welcome::User_side');
$router->get('/user_result', 'Welcome::User_result');
$router->post('/user_result', 'Welcome::user_result');
