<?php
//路由
$klein = new \Klein\Klein();

$klein->respond('GET','/',function(){
	$Home = new HomeController();
	$Home->home(); 
	
});

$klein->dispatch();

?>
