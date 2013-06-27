<?php /* Smarty version Smarty-3.1.8, created on 2012-07-17 11:32:47
         compiled from "tpl/admin\msg.htm" */ ?>
<?php /*%%SmartyHeaderCode:139845004dcdfb763f2-87312160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7b7aa75a97bf190aa561b3b1e571b821816c7f6' => 
    array (
      0 => 'tpl/admin\\msg.htm',
      1 => 1337571980,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139845004dcdfb763f2-87312160',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'goto' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5004dcdfbf3744_04454698',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5004dcdfbf3744_04454698')) {function content_5004dcdfbf3744_04454698($_smarty_tpl) {?>
<div id="userCenter">
  <div id="msgBox" class="box">
   <p><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</p>
   <p><a href="<?php echo $_smarty_tpl->tpl_vars['goto']->value;?>
" id="goto">如果您的浏览器没有自动跳转，请点击这里...</a></p>
  </div>
</div>
<script type="text/javascript" src="lib/images/msg.js"></script><?php }} ?>