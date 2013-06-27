<?php /* Smarty version Smarty-3.1.8, created on 2012-07-17 11:49:01
         compiled from "tpl/admin\confirm.htm" */ ?>
<?php /*%%SmartyHeaderCode:49445004e0ade9b8d5-78110832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd62faba5347c4908e865407417d6f6b29ef0968' => 
    array (
      0 => 'tpl/admin\\confirm.htm',
      1 => 1338302046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49445004e0ade9b8d5-78110832',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5004e0adef2c39_30216483',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5004e0adef2c39_30216483')) {function content_5004e0adef2c39_30216483($_smarty_tpl) {?><div id="msgBox" class="box">
  <p>
    <b>操作提示：</b><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" class="yes">确定</a>
    <a href="javascript:history.back();" class="cancel">取消</a>
  </p>
</div><?php }} ?>