<?php /* Smarty version Smarty-3.1.8, created on 2013-06-23 16:53:54
         compiled from "tpl/default\appointList.htm" */ ?>
<?php /*%%SmartyHeaderCode:3175051c6b7a2225b93-36059154%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fadd2a835bf7177b3d3aa9fc3b649af4dcd971c9' => 
    array (
      0 => 'tpl/default\\appointList.htm',
      1 => 1341468670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3175051c6b7a2225b93-36059154',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'appoint' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51c6b7a236da70_84394005',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c6b7a236da70_84394005')) {function content_51c6b7a236da70_84394005($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="roomList">
  <h2>我的预约记录</h2>
  <div class="schedule">
    <table cellpadding="0" cellspacing="0">
      <tr>
      <th width="80">预约日期</th>
      <th width="40">星期</th>
      <th width="40">时间段</th>
      <th width="40">时间</th>
      <th width="140">预约科室</th>
      <th width="60">预约医生</th>
      <th width="40">状态</th>
      <th width="">操作</th>
      </tr>
      <?php if (empty($_smarty_tpl->tpl_vars['list']->value)){?>
      <tr>
        <td colspan="5">暂无记录</td>
      </tr>
      <?php }else{ ?>
      <?php  $_smarty_tpl->tpl_vars['appoint'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['appoint']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['appoint']->key => $_smarty_tpl->tpl_vars['appoint']->value){
$_smarty_tpl->tpl_vars['appoint']->_loop = true;
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['appoint']->value['day'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['appoint']->value['week'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['appoint']->value['noon'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['appoint']->value['time'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['appoint']->value['room']['name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['appoint']->value['doctor']['name'];?>
</td>
          <td><?php if ($_smarty_tpl->tpl_vars['appoint']->value['state']==1){?>已挂号<?php }elseif($_smarty_tpl->tpl_vars['appoint']->value['state']==2){?>已就诊<?php }elseif($_smarty_tpl->tpl_vars['appoint']->value['state']==3){?>已取消<?php }elseif($_smarty_tpl->tpl_vars['appoint']->value['state']==4){?>爽约<?php }?></td>
          <td><?php if ($_smarty_tpl->tpl_vars['appoint']->value['state']==1){?><a href="?m=appoint&o=cancel&p=aid,<?php echo $_smarty_tpl->tpl_vars['appoint']->value['aid'];?>
">取消预约</a><?php }else{ ?> - <?php }?></td>
        </tr>
      <?php } ?>
      <?php }?>
    </table>
  </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("block/user.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>