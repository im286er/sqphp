<?php
//+---------------
//ÅäÖÃÎÄ¼þ
//+---------------
return array(
	//mysql
	'host' => '127.0.0.1',
	'user' => 'root',
	'pwd'  => '',
	'database' => 'swzx',
	'table_prefix' => 'swzx_',
	//redis
	'redis_host' => '127.0.0.1',
	'redis_port' => '6379',
	'redis_expire' => 0,
	'session' => 'Redis',
	'session_prefix' => 'sq_',
	'session_lifetime' => 3600
);