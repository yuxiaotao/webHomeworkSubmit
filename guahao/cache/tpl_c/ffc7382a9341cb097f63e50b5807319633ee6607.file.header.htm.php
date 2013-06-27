<?php /* Smarty version Smarty-3.1.8, created on 2013-06-23 16:45:51
         compiled from "tpl/default\header.htm" */ ?>
<?php /*%%SmartyHeaderCode:1822351c6b5bf0c4049-08320362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffc7382a9341cb097f63e50b5807319633ee6607' => 
    array (
      0 => 'tpl/default\\header.htm',
      1 => 1340711564,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1822351c6b5bf0c4049-08320362',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'htmlTitle' => 0,
    'cfg' => 0,
    'imgDir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51c6b5bf0e2be9_30470639',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c6b5bf0e2be9_30470639')) {function content_51c6b5bf0e2be9_30470639($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['htmlTitle']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['cfg']->value['sitename'];?>
网上挂号平台</title>
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['imgDir']->value;?>
style.css" />
<script type="text/javascript" src="lib/images/jquery.js?v=172"></script>
<script type="text/javascript" src="lib/images/common.js"></script>
</head>

<body>
  <div id="header">
    <div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['imgDir']->value;?>
top.jpg"  /></div>
  </div>
  <div id="main"><?php }} ?>