<?php
use Klein\Klein;

$klein = new \Klein\Klein();
/*
$klein->respond(function($request){
        echo $request->name;
});
*/
$klein->respond('GET','/hello-world',function(){
        echo 'Hello World';
});

/*
$klein->respond(function(){
	echo 'others';
});
*/

$klein->dispatch();

?>
