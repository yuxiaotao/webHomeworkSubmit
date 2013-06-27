<?php /* Smarty version Smarty-3.1.8, created on 2013-06-23 16:45:50
         compiled from "tpl/default\roomList.htm" */ ?>
<?php /*%%SmartyHeaderCode:2484651c6b5bed4bfe4-74937584%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07d541c5628e8611dc1d29424ae2bd843fb00d8b' => 
    array (
      0 => 'tpl/default\\roomList.htm',
      1 => 1340702026,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2484651c6b5bed4bfe4-74937584',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rooms' => 0,
    'room' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51c6b5bf003a32_77669245',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c6b5bf003a32_77669245')) {function content_51c6b5bf003a32_77669245($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="roomList">
  <h2>选择科室</h2>
  <div class="rooms">
    <?php if (empty($_smarty_tpl->tpl_vars['rooms']->value)){?>
    暂无科室。
    <?php }else{ ?>
    <?php  $_smarty_tpl->tpl_vars['room'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['room']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rooms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['room']->key => $_smarty_tpl->tpl_vars['room']->value){
$_smarty_tpl->tpl_vars['room']->_loop = true;
?>
    <div class="room">
      <h3><?php echo $_smarty_tpl->tpl_vars['room']->value['name'];?>
</h3>
      <p>
        <a href="?m=room&o=view&p=rid,<?php echo $_smarty_tpl->tpl_vars['room']->value['rid'];?>
">科室简介</a>
        <a href="?m=room&o=select&p=rid,<?php echo $_smarty_tpl->tpl_vars['room']->value['rid'];?>
">进入预约</a>
      </p>
    </div>
    <?php } ?>
    <?php }?>
  </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("block/user.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>