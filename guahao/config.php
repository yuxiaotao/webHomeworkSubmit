<?php
/*********************
  王清炫：模型设计、程序开发、数据结构设计、界面设计、界面制作、程序调试、兼容性调试。
  杲宏波：BUG检查、安全检测、系统调试。
  小包子：演示数据录入、功能检查。
  发布日期：2012-04
  联系QQ：173234188
  版权申明：未经本系统作者书面许可，严禁任何组织和个人以任何形式拷贝、分发本系统给第三方。
**********************/

$microtime = explode(' ',microtime());
define('TIME',$microtime[1]);
define('MICROTIME',str_replace('0.','',$microtime[0]));
date_default_timezone_set('PRC');     //北京时间
session_cache_limiter('nocache');

define('DB_hostname','localhost');    //数据库主机
define('DB_datebase','guahao');    //数据库名称
define('DB_username','root');         //数据库用户名
define('DB_password','123456');       //数据库密码
define('DB_charset','utf8');         //数据库字符集
define('DB_pre','gh_');             //数据库表前缀
?>