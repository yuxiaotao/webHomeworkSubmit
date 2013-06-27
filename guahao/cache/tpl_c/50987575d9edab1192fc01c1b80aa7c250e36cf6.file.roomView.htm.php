<?php /* Smarty version Smarty-3.1.8, created on 2013-06-23 23:29:37
         compiled from "tpl/default\roomView.htm" */ ?>
<?php /*%%SmartyHeaderCode:585751c6b6d75a6722-72119480%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50987575d9edab1192fc01c1b80aa7c250e36cf6' => 
    array (
      0 => 'tpl/default\\roomView.htm',
      1 => 1371999786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '585751c6b6d75a6722-72119480',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51c6b6d7646316_68667403',
  'variables' => 
  array (
    'room' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c6b6d7646316_68667403')) {function content_51c6b6d7646316_68667403($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="roomList">
  <h2>科室简介：<?php echo $_smarty_tpl->tpl_vars['room']->value['name'];?>
</h2>
  <p class="intro">
  <?php echo $_smarty_tpl->tpl_vars['room']->value['intro'];?>

  </p>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("block/user.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>