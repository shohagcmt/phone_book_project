<?php

$router->post('/registration','RegistrationController@onRegistrationController');
$router->post('/login','LogingController@onloging');
//$router->post('/tokentest',['middleware'=>'auth','uses'=>'LogingController@tokenTest']);   //token test
$router->post('/insert',['middleware'=>'auth','uses'=>'PhoneBookController@onInsert']);
$router->post('/select',['middleware'=>'auth','uses'=>'PhoneBookController@onSelect']);
$router->post('/delete',['middleware'=>'auth','uses'=>'PhoneBookController@onDelete']);


