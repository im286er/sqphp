<?php
//路由
$klein = new \Klein\Klein();

$klein->respond('GET','/',function(){
	//$Home = new HomeController();
	//$Home->home(); 
	session('my','123');
	echo session('my');
	session('my',null);
	echo session('my');
});

$klein->dispatch();

?>
