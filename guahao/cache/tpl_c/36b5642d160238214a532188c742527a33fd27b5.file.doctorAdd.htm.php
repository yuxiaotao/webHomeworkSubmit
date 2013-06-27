<?php /* Smarty version Smarty-3.1.8, created on 2012-07-05 16:01:05
         compiled from "tpl/admin\doctorAdd.htm" */ ?>
<?php /*%%SmartyHeaderCode:300494ff549c1474b98-57393589%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36b5642d160238214a532188c742527a33fd27b5' => 
    array (
      0 => 'tpl/admin\\doctorAdd.htm',
      1 => 1340679932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '300494ff549c1474b98-57393589',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'doctor' => 0,
    'msg' => 0,
    'rooms' => 0,
    'cfg' => 0,
    'schedules' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff549c14f8c41_08472173',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff549c14f8c41_08472173')) {function content_4ff549c14f8c41_08472173($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'lib/smarty/plugins\\function.html_options.php';
?><div id="doctorAdd" class="box">
  <form class="form" method="post" action="">
    <table cellpadding="0" cellspacing="0">
      <tr>
        <td>医生姓名：</td>
        <td><input name="name" type="text" class="longTxt" value="<?php echo $_smarty_tpl->tpl_vars['doctor']->value['name'];?>
" /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['name'];?>
</span></td>
      </tr>
      <tr>
        <td>所属科室：</td>
        <td><select name="rid"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['rooms']->value,'selected'=>$_smarty_tpl->tpl_vars['doctor']->value['rid']),$_smarty_tpl);?>
</select><span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['rid'];?>
</span></td>
      </tr>
      <tr>
        <td>级别：</td>
        <td><select name="type"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['cfg']->value['doctorTypes'],'selected'=>$_smarty_tpl->tpl_vars['doctor']->value['type']),$_smarty_tpl);?>
</select><span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['type'];?>
</span></td>
      </tr>
      <tr>
        <td>放号量：</td>
        <td class="schedules"><?php echo $_smarty_tpl->tpl_vars['schedules']->value;?>
</td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="确认提交" class="submit" /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['result'];?>
</span></td>
      </tr>
    </table>
  </form>
</div><?php }} ?>