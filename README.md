# sqphp
一个基于composer的php轻MVC框架
路由：
采用了git上的klein，详情请见：https://github.com/klein/klein.php

MVC：
数据库目前支持mysql的pdo连接
视图采用了smarty

驱动扩展：
改动了session的存储方式，在安装有redis的机器上可用redis作为存储session
