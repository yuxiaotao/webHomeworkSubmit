<?php /* Smarty version Smarty-3.1.8, created on 2012-07-06 15:55:14
         compiled from "tpl/admin\userAdd.htm" */ ?>
<?php /*%%SmartyHeaderCode:205164ff699e21586a6-25099821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77ab00511c8d024e0dcbb3a4307a819fa800697e' => 
    array (
      0 => 'tpl/admin\\userAdd.htm',
      1 => 1341461924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205164ff699e21586a6-25099821',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'msg' => 0,
    'userTypes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff699e22d7180_57970830',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff699e22d7180_57970830')) {function content_4ff699e22d7180_57970830($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'lib/smarty/plugins\\function.html_options.php';
?>
<script type="text/javascript" src="lib/images/date.js"></script>
<link type="text/css" rel="stylesheet" href="lib/images/date.css" />
	<div id="pageList" class="box">
        <form method="post" action="" class="form">
          <table cellpadding="0" cellspacing="0">
 <tbody>
              <tr>
                <td>就诊卡号：</td>
                <td><input type="text" name="uid" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['uid'];?>
" <?php if ($_smarty_tpl->tpl_vars['user']->value['uid']){?>disabled="disabled"<?php }?> /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['uid'];?>
</span></td>
              </tr>
              <tr>
                <td>真实姓名：</td>
                <td><input type="text" name="truename" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['truename'];?>
"  /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['truename'];?>
</span></td>
              </tr>
              <tr>
                <td>身份证号：</td>
                <td><input type="text" name="id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"  /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['id'];?>
</span></td>
              </tr>
              <tr>
                <td>出生年月：</td>
                <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['birthday'];?>
"  id="birthday" name="birthday" onclick="SelectDate(this,finishtimeformat)"  /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['birthday'];?>
</span></td>
              </tr>
              <tr>
                <td>性别：</td>
                <td><input type="radio" value="1"  name="gender"<?php if (!empty($_smarty_tpl->tpl_vars['user']->value['gender'])){?> checked="checked"<?php }?> /> 男 <input type="radio" value="0"  name="gender"<?php if (empty($_smarty_tpl->tpl_vars['user']->value['gender'])){?> checked="checked"<?php }?>  /> 女 <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['gender'];?>
</span></td>
              </tr>
              <tr>
                <td>座机号码：</td>
                <td><input name="tel" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['tel'];?>
"  /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['tel'];?>
</span></td>
              </tr>
              <tr>
                <td>手机号码：</td>
                <td><input name="mobile" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['mobile'];?>
"  /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['mobile'];?>
</span></td>
              </tr>
              <tr>
                <td>用户类型：</td>
                <td><select name="type"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['userTypes']->value,'selected'=>$_smarty_tpl->tpl_vars['user']->value['type']),$_smarty_tpl);?>
</select> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['type'];?>
</span></td>
              </tr>
              <tr>
                <td>联系地址：</td>
                <td><input name="address" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['address'];?>
" class="add" /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['address'];?>
</span></td>
              </tr>
              <tr>
                <td colspan="2"><input type="submit" name="submit" value="确认更改"  class="submit"/> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['result'];?>
</span></td>
              </tr>
            </tbody>
          </table>
        </form>
    </div><?php }} ?>