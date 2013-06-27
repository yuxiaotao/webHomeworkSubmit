<?php /* Smarty version Smarty-3.1.8, created on 2012-07-10 14:50:10
         compiled from "tpl/admin\setBasic.htm" */ ?>
<?php /*%%SmartyHeaderCode:34354ff549873bbde2-70440163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d8b6a2bd1465c289a3e5ff6e32ed70f9b09e841' => 
    array (
      0 => 'tpl/admin\\setBasic.htm',
      1 => 1341562574,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34354ff549873bbde2-70440163',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff5498744cf30_32170535',
  'variables' => 
  array (
    'set' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff5498744cf30_32170535')) {function content_4ff5498744cf30_32170535($_smarty_tpl) {?>    <div id="pageList" class="box">
        <form method="post" action="" class="form">
          <table cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <th width="90">医院名称：</th>
                <th><input type="text" name="sitename" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['sitename'];?>
" /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['sitename'];?>
</span></th>
              </tr>
              <tr>
                <td>网站域名：</td>
                <td><input type="text" name="domain" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['domain'];?>
" /> 不带http://，例如：www.seetwo.net</td>
              </tr>
              <tr>
                <td>系统根目录：</td>
                <td><input type="text" name="root" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['root'];?>
"  /> 结尾不带“/”</td>
              </tr>
              <tr>
                <td>风格目录：</td>
                <td><input type="text" name="style" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['style'];?>
"  /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['style'];?>
</span></td>
              </tr>
              <tr>
                <td>登陆保持时间：</th>
                <td><input name="lifetime" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['lifetime'];?>
" type="text" class="smallTxt"   /> 分钟 <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['lifetime'];?>
</span></td>
              </tr>
              <tr>
                <td>校正间隔时间：</th>
                <td><input name="autoupdate" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['autoupdate'];?>
" type="text" class="smallTxt"   /> 秒，设置自动清理和更正因超时等原因产生的冗余和不准确数据的时间间隔</td>
              </tr>
              <tr>
                <td width="80">联系电话：</td>
                <td><input name="serviceTel" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['serviceTel'];?>
" type="text"   /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['serviceTel'];?>
</span></td>
              </tr>
              <tr>
                <td width="80">客服QQ：</td>
                <td><input name="serviceQQ" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['serviceQQ'];?>
" type="text"   /> 多个QQ号码请用英文逗号,隔开</td>
              </tr>
              <tr>
                <td>医院地址：</td>
                <td><input name="serviceAdd" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['serviceAdd'];?>
" type="text" class="longTxt"   /> <span class="msg"><?php echo $_smarty_tpl->tpl_vars['msg']->value['serviceAdd'];?>
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