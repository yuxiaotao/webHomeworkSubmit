<?php /* Smarty version Smarty-3.1.8, created on 2012-07-06 16:48:57
         compiled from "tpl/default\userReg.htm" */ ?>
<?php /*%%SmartyHeaderCode:16794ff6a679196f46-58571936%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '501fa5d8606921ab385d785a7e2dcfc7e89f0080' => 
    array (
      0 => 'tpl/default\\userReg.htm',
      1 => 1340713620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16794ff6a679196f46-58571936',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg' => 0,
    'imgDir' => 0,
    'user' => 0,
    'msg' => 0,
    'userTypes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff6a67926d8f7_41085173',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff6a67926d8f7_41085173')) {function content_4ff6a67926d8f7_41085173($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'lib/smarty/plugins\\function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="www.mlinseo.com"> 
<title>新用户注册-<?php echo $_smarty_tpl->tpl_vars['cfg']->value['sitename'];?>
</title>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['imgDir']->value;?>
style.css" rel="stylesheet" />
<script type="text/javascript" src="lib/images/date.js"></script>
<link type="text/css" rel="stylesheet" href="lib/images/date.css" />
</head>

<body>
<div id="home">
  <div class="intro">
    <div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['imgDir']->value;?>
logo.jpg"  /></div>
    <div id="userReg">
    <h2>用户注册</h2>
       <form method="post" action="?m=user&o=reg" id="regForm">
          <table cellpadding="0" cellspacing="0">
            <tbody>
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
"  /> 请务必填写正确的手机号以便获取预约卡号短信 <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['mobile'];?>
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
                <td colspan="2"><input type="submit" name="submit" value="确认注册"  class="submit"/> 注册成功后系统将自动向您的手机发送预约卡号，卡号永久有效。 <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['result'];?>
</span></td>
              </tr>
            </tbody>
          </table>
      </form>
</div>
  </div>
  <div class="login">
    <h2>用户登录</h2>
    <form action="?m=user&o=login" method="post">
    <table cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <td>卡号：</td>
        <td><input type="text" name="uid" class="text"  /></td>
      </tr>
      <tr>
        <td>姓名：</td>
        <td><input type="text" name="truename" class="text"/></td>
      </tr>
        <tr>
          <td>验证码：</td>
          <td valign="middle"><input type="text" class="checknum" name="checknum" value="" /> <a href="javascript:getCheckNum();" title="看不清？点击更换"><img id="checkImg" src="?m=ajax&o=checknum" /></a></td>
        </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="登录在线预约系统" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><a href="?m=user&o=reg">没有卡号？在线注册</a></td>
      </tr>
    </tbody>
    </table>
    </form>
  </div>
</div>
</body>
</html>
<?php }} ?>