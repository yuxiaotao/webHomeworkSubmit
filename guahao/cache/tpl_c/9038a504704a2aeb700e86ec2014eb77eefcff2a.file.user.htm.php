<?php /* Smarty version Smarty-3.1.8, created on 2013-06-23 16:45:51
         compiled from "tpl/default\block\user.htm" */ ?>
<?php /*%%SmartyHeaderCode:2079651c6b5bf10afd3-49995177%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9038a504704a2aeb700e86ec2014eb77eefcff2a' => 
    array (
      0 => 'tpl/default\\block\\user.htm',
      1 => 1340701996,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2079651c6b5bf10afd3-49995177',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'session' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51c6b5bf12eab9_49405162',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c6b5bf12eab9_49405162')) {function content_51c6b5bf12eab9_49405162($_smarty_tpl) {?>
<div id="userInfo">
  <h2>用户信息</h2>
  <p>就诊卡号：<?php echo $_smarty_tpl->tpl_vars['session']->value['uid'];?>
</p>
  <p>用户姓名：<?php echo $_smarty_tpl->tpl_vars['session']->value['truename'];?>
</p>
  <p>用户性别：<?php if ($_smarty_tpl->tpl_vars['session']->value['gender']==1){?>男<?php }else{ ?>女<?php }?></p>
  <p><a href="?m=room&o=list">我要挂号</a> &nbsp;  <a href="?m=appoint&o=list">挂号记录</a> &nbsp;  <a href="?m=user&o=quit">安全退出</a></p>
</div><?php }} ?>