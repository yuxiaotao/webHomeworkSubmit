<?php /* Smarty version Smarty-3.1.8, created on 2013-06-23 17:08:01
         compiled from "tpl/default\appointTime.htm" */ ?>
<?php /*%%SmartyHeaderCode:3103151c6baf10b76c8-80253540%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '614cd101470c3e3bce13fdd73f152f6ea203d8be' => 
    array (
      0 => 'tpl/default\\appointTime.htm',
      1 => 1341468318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3103151c6baf10b76c8-80253540',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'date' => 0,
    'schedule' => 0,
    'hours' => 0,
    'mins' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51c6baf11ceba2_36951946',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c6baf11ceba2_36951946')) {function content_51c6baf11ceba2_36951946($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'lib/smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="appointTime">
  <h2>请选择来院时间</h2>
  <div>
    <form action="" method="post">
    <table cellpadding="0" cellspacing="0">
      <tr>
      <td><b>来院具体时间：<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</b></td>
      <td><b><?php echo $_smarty_tpl->tpl_vars['schedule']->value['noon'];?>
</b></td>
      <td><select name="h"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['hours']->value),$_smarty_tpl);?>
</select> <b>点</b></td>
      <td><select name="m"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['mins']->value),$_smarty_tpl);?>
</select> <b>分</b></td>
      <td><input type="submit" name="submit" value="确定" /></td>
      </tr>
    </table>
    </form>
  </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("block/user.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>