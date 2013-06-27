<?php /* Smarty version Smarty-3.1.8, created on 2013-06-24 12:47:49
         compiled from "tpl/admin\userAdmin.htm" */ ?>
<?php /*%%SmartyHeaderCode:1958851c7cf75cafc80-07094924%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb94dc4b805c9750b42bee321f9202e0db38335d' => 
    array (
      0 => 'tpl/admin\\userAdmin.htm',
      1 => 1340720610,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1958851c7cf75cafc80-07094924',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51c7cf75cfef22_10339741',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c7cf75cfef22_10339741')) {function content_51c7cf75cfef22_10339741($_smarty_tpl) {?>    <div id="pageList" class="box">
    <form action="" method="post" class="form">
      <table>
        <tr>
          <td>管理员账号：</td>
          <td colspan="2">admin</td>
        </tr>
        <tr>
          <td>管理员密码：</td>
          <td colspan="2"><input type="text" name="password" value="" /></td>
        </tr>
        <tr>
          <td>确认密码：</td>
          <td><input type="text" name="password2" value="" /></td>
          <td><input type="submit" name="submit" value="更改密码" class="submit" /></td>
        </tr>
      </table>
    </form>
    
<div class="h10"></div>

    </div><?php }} ?>