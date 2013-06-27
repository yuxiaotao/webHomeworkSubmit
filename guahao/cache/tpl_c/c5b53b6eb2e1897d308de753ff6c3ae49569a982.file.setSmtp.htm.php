<?php /* Smarty version Smarty-3.1.8, created on 2013-06-23 17:00:51
         compiled from "tpl/admin\setSmtp.htm" */ ?>
<?php /*%%SmartyHeaderCode:242851c6b9430348d2-60744026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5b53b6eb2e1897d308de753ff6c3ae49569a982' => 
    array (
      0 => 'tpl/admin\\setSmtp.htm',
      1 => 1337931906,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242851c6b9430348d2-60744026',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'set' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51c6b9430e8ab1_69224680',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c6b9430e8ab1_69224680')) {function content_51c6b9430e8ab1_69224680($_smarty_tpl) {?>    <div id="pageList" class="box">
        <form method="post" action="" class="form">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <th width="100">Smtp邮箱账号：</th>
                <th><input name="smtpCount" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['smtpCount'];?>
" type="text"   /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['smtpCount'];?>
</span></th>
              </tr>
              <tr>
                <td>Smtp邮箱密码：</td>
                <td><input name="smtpPas" value="" type="password" /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['smtpPas'];?>
</span></td>
              </tr>
              <tr>
                <td>Smtp发送端口：</td>
                <td><input name="smtpPort" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['smtpPort'];?>
"  /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['smtpPort'];?>
</span></td>
              </tr>
              <tr>
                <td colspan="2"><input type="submit" name="submit" value="确认更改"  class="submit"/> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['result'];?>
</span> </td>
              </tr>
            </tbody>
          </table>
        </form>
          <div class="h10"></div>
        <form method="post" action="" class="form" onsubmit="sendCheckMail();">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <th width="100">测试收件箱：</th>
                <th><input name="smtpCount" value="" type="text"   /> <input type="submit" value="发送测试邮件" name="submit" class="submit" /></th>
              </tr>
            </tbody>
          </table>
        </form>
        <div class="h10"></div>
        <div class="note">
          <p><b>提示：</b>本系统采用SMTP代理邮件服务器发送系统邮件，请确定你的邮箱账号已开启smtp服务。</p>
        </div>
    </div><?php }} ?>