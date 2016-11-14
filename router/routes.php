<?php
use Klein\Klein;
require 'app/controllers/HomeController.php';

$klein = new \Klein\Klein();
/*
$klein->respond(function($request){
        echo $request->name;
});
*/
$klein->respond('GET','/hello-world',function(){
    echo 'Hello World';
});

$klein->respond('GET','',function(){
	$Home = new HomeController();
	$Home->home(); 
});
/*
$klein->respond(function(){
	echo 'others';
});
*/

$klein->dispatch();

?>
