<?php /* Smarty version Smarty-3.1.12, created on 2012-10-25 04:52:21
         compiled from "..\view\account\login.tp" */ ?>
<?php /*%%SmartyHeaderCode:1693250889832e68ee2-52539400%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '713a4be0120e32ea33b823dd1e936cd87343dd26' => 
    array (
      0 => '..\\view\\account\\login.tp',
      1 => 1351131241,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1693250889832e68ee2-52539400',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5088983303db78_03939243',
  'variables' => 
  array (
    'email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5088983303db78_03939243')) {function content_5088983303db78_03939243($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('uheader.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'登陆','page'=>'page-login'), 0);?>


" placeholder='邮箱' class='required' minlength="6" autocomplete='off' name='email' />
<?php }} ?>