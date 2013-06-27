<?php /* Smarty version Smarty-3.1.8, created on 2012-07-06 16:19:14
         compiled from "tpl/admin\setAppoint.htm" */ ?>
<?php /*%%SmartyHeaderCode:183174ff69f65892613-25510078%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a03ff28f7efa3a13bd7aa3301fb3feca03ff473f' => 
    array (
      0 => 'tpl/admin\\setAppoint.htm',
      1 => 1341562752,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183174ff69f65892613-25510078',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff69f65903649_38233424',
  'variables' => 
  array (
    'set' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff69f65903649_38233424')) {function content_4ff69f65903649_38233424($_smarty_tpl) {?>    <div id="pageList" class="box">
        <form method="post" action="" class="form">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>新注册卡号起始号：</th>
                <td><input name="uidstart" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['uidstart'];?>
" type="text" class="smallTxt"   /> 只允许数字 <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['uidstart'];?>
</span></td>
              </tr>
              <tr>
                <th width="140">挂号开放天数：</th>
                <th><input name="appointDay" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['appointDay'];?>
" type="text"   /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['appointDay'];?>
</span></th>
              </tr>
              <tr>
                <td>每日最多挂号次数：</td>
                <td><input name="maxAppointTimes" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['maxAppointTimes'];?>
" type="text"   /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['maxAppointTimes'];?>
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