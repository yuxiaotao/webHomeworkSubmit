<?php /* Smarty version Smarty-3.1.8, created on 2012-07-05 15:59:44
         compiled from "tpl/admin\header.htm" */ ?>
<?php /*%%SmartyHeaderCode:107934ff549701b8494-98882366%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8288f14d97a46a43b863883ca7980942f6f94b11' => 
    array (
      0 => 'tpl/admin\\header.htm',
      1 => 1341458140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107934ff549701b8494-98882366',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mainTitle' => 0,
    'cfg' => 0,
    'imgDir' => 0,
    'session' => 0,
    'mainNav' => 0,
    'currentMenu' => 0,
    'menuTitle' => 0,
    'operateMenu' => 0,
    'v' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff549702a7488_33551149',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff549702a7488_33551149')) {function content_4ff549702a7488_33551149($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['mainTitle']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['mainTitle']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['cfg']->value['sitename'];?>
</title>
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['imgDir']->value;?>
style.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['imgDir']->value;?>
user.css" />
<script type="text/javascript" src="lib/images/jquery.js?v=172"></script>
<script type="text/javascript" src="lib/images/common.js"></script>
</head>

<body>
<div id="header">
  <div class="topBar">
    <div class="box">
    <p class="welcome"><b><?php echo $_smarty_tpl->tpl_vars['cfg']->value['sitename'];?>
后台管理中心</b>  你好，<?php echo $_smarty_tpl->tpl_vars['session']->value['username'];?>
！ </p>
    <p class="userBar"><a href="javascript:window.print();">打印本页</a>  <a href="index.php?m=user&o=quit">退出系统</a>  <a href="./" target="_blank">网站首页</a></p>
    </div>
  </div>
  <div class="midBar w980">

    <div id="userNav">
      <ul>
      <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['loop'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['mainNav']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['name'] = 'loop';
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['loop']['total']);
?>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['mainNav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']][2];?>
"<?php if (!empty($_smarty_tpl->tpl_vars['mainNav']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['loop']['index']][3])){?> target="_blank"<?php }?><?php if ($_smarty_tpl->tpl_vars['mainNav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']][0]==$_smarty_tpl->tpl_vars['currentMenu']->value){?> class="current"<?php }?>><?php echo $_smarty_tpl->tpl_vars['mainNav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['loop']['index']][1];?>
</a></li>
      <?php endfor; endif; ?>
      </ul>
    </div>
  </div>
</div>

<div class="gray100">
<div id="admin">
  <div class="sideBar">
   <h2><em> </em><?php echo $_smarty_tpl->tpl_vars['menuTitle']->value;?>
</h2>
	<ul>
    <?php if ($_smarty_tpl->tpl_vars['operateMenu']->value){?>
      <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['operateMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
        <?php if ($_smarty_tpl->tpl_vars['v']->value=='line'){?>
      <li class="line"></li>
        <?php }else{ ?>
      <li<?php if ($_smarty_tpl->tpl_vars['mainTitle']->value==$_smarty_tpl->tpl_vars['k']->value){?> class="current"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a></li>
        <?php }?>
      <?php } ?>
    <?php }?>
	</ul>
  </div>
  <div class="mainBar">
    <h2><?php echo $_smarty_tpl->tpl_vars['mainTitle']->value;?>
</h2><?php }} ?>