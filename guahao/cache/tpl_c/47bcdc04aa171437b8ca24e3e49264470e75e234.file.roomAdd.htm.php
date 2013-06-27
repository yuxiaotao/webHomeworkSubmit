<?php /* Smarty version Smarty-3.1.8, created on 2012-07-05 16:01:02
         compiled from "tpl/admin\roomAdd.htm" */ ?>
<?php /*%%SmartyHeaderCode:2004ff549be3ee581-48816188%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47bcdc04aa171437b8ca24e3e49264470e75e234' => 
    array (
      0 => 'tpl/admin\\roomAdd.htm',
      1 => 1340596520,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2004ff549be3ee581-48816188',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'room' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff549be43fbe7_39983811',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff549be43fbe7_39983811')) {function content_4ff549be43fbe7_39983811($_smarty_tpl) {?>
<div id="wordAdd" class="box">
  <form class="form" method="post" action="">
    <table cellpadding="0" cellspacing="0">
      <tr>
        <td>科室名称：</td>
        <td><input name="name" type="text" class="midTxt" value="<?php echo $_smarty_tpl->tpl_vars['room']->value['name'];?>
" /></td>
      </tr>
      <tr>
        <td>科室介绍：</td>
        <td><textarea name="intro" class="smallTextArea"><?php echo $_smarty_tpl->tpl_vars['room']->value['intro'];?>
</textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="确认提交" class="submit" /></td>
      </tr>
    </table>
  </form>
</div><?php }} ?>