<?php /* Smarty version Smarty-3.1.8, created on 2012-07-05 15:59:44
         compiled from "tpl/admin\footer.htm" */ ?>
<?php /*%%SmartyHeaderCode:28954ff54970365d22-17736397%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26088bab6c2b39df354f5c64d43fff2c5429bb10' => 
    array (
      0 => 'tpl/admin\\footer.htm',
      1 => 1338795482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28954ff54970365d22-17736397',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'excTime' => 0,
    'sqls' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4ff54970370c25_54382436',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff54970370c25_54382436')) {function content_4ff54970370c25_54382436($_smarty_tpl) {?>  </div>
  <div class="cl"></div>
</div>
</div>

<div id="footer">
  <div class="box">
  <p class="copyright">
</p>
  <?php echo $_smarty_tpl->tpl_vars['excTime']->value;?>


  <?php echo $_smarty_tpl->tpl_vars['sqls']->value;?>

  </div>
</div>
</body>
</html>
<?php }} ?>