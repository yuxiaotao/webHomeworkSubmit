<?php
require('config.php');
require('lib/functions.php');
require('lib/db.class.php');
require('lib/safe.class.php');
require('lib/tpl.class.php');
require('lib/mg.class.php');
require('lib/admin.class.php');

$_GET['m'] = isset($_GET['m']) ? $_GET['m'] : '';
$_GET['o'] = isset($_GET['o']) ? $_GET['o'] : '';

if($_GET['m'] != ''){
  if(strlen($_GET['m']) > 8)//防止加载远程文件
    exit('非法参数');
  if(!ctype_alnum($_GET['m']))
    exit('非法参数');
}

if($_GET['o'] != ''){
  if(strlen($_GET['o']) > 15)//请注意，模块文件需要被直接使用的方法名不能超过15位
    exit('非法参数');
  if(!ctype_alnum($_GET['o']))
    exit('非法参数');
}

if($_GET['m'] == '' && $_GET['o'] == ''){
    $_GET['m'] = 'user';
    $_GET['o'] = 'login';
}
$mFile = 'mod/admin/'.$_GET['m'].'.php';
if(!file_exists($mFile)){
  msg('nomodel');
}

require($mFile);
global $m;
$m = new $_GET['m'];

if($_GET['o'] != ''){
  $m->exc($_GET['m'].ucfirst(strtolower($_GET['o'])));
}
else{
  exit('非法参数');//强制执行方法
}

$m->display();
?>