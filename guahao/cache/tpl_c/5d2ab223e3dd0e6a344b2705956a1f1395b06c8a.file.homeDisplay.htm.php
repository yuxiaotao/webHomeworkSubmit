<?php /* Smarty version Smarty-3.1.8, created on 2013-06-24 13:25:04
         compiled from "tpl/default\homeDisplay.htm" */ ?>
<?php /*%%SmartyHeaderCode:85954ff6a677c47516-70476061%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d2ab223e3dd0e6a344b2705956a1f1395b06c8a' => 
    array (
      0 => 'tpl/default\\homeDisplay.htm',
      1 => 1372051499,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85954ff6a677c47516-70476061',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff6a677ca1584_68347893',
  'variables' => 
  array (
    'cfg' => 0,
    'imgDir' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff6a677ca1584_68347893')) {function content_4ff6a677ca1584_68347893($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="www.mlinseo.com"> 
<title><?php echo $_smarty_tpl->tpl_vars['cfg']->value['sitename'];?>
</title>
<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['imgDir']->value;?>
style.css" rel="stylesheet" />
<script type="text/javascript" src="lib/images/jquery.js?v=172"></script>
<script type="text/javascript" src="lib/images/common.js"></script>
</head>

<body>
<div id="home">
  <div class="intro">
    <div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['imgDir']->value;?>
logo.jpg"  /></div>
    <div class="txt">
      <h2>医院介绍</h2>
      <div>
        <p>西安电子科技大学医院，地处古城西安南郊，组建于1984年。主要服务对象为学生、职工和家属。 </p>
           <p>经过二十年的不懈努力，医院规模不断扩大，1999年对医院进行了改建，床位增至100张。现在编职工92人,卫生技术人员77人，其中高级职称13人，中级职称30人。我院在完成学生医疗保健工作的同时，还承担着定点医院及二级地段区域内人员的基础医疗、防疫、保健及社区医疗服务。 
        </p>
      </div>
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
</html><?php }} ?>