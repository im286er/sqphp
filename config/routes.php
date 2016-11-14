<?php
use Klein\Klein;

$klein = new \Klein\Klein;

$klein->respond('GET','/index.php/hello-world',function(){
	echo 'Hello World';
});
/*
$klein->respond(function(){
	echo 'others';
});
*/

$klein->dispatch();

?>
