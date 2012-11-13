<?php /* Smarty version Smarty-3.1.12, created on 2012-11-13 08:42:58
         compiled from "..\view\home\about.tp" */ ?>
<?php /*%%SmartyHeaderCode:10361509331b607bda8-23690721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92ab8f036fcae7ffbfc24d642de6c3dd1c1d467c' => 
    array (
      0 => '..\\view\\home\\about.tp',
      1 => 1352791179,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10361509331b607bda8-23690721',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509331b6157125_83299289',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509331b6157125_83299289')) {function content_509331b6157125_83299289($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'关于','page'=>'page-about'), 0);?>


<div class='row'>
	<div id='main-panel' class='span9'>

		<h4>关于 lifegoals</h4>

		<p>你可以把自己的人生目标保存在这里，无论它看起来如何的不值一提或不切实际，请记住：You've got to find what you love。</p>

		<p>你可以把实现目标中的点点滴滴记录下来。</p>

		<p>你可以发现别人的人生目标，见证平行时空下的不同精彩，并从中得到启发。</p>

	</div>

	<div id='sidebar' class='span3'>
		<?php echo $_smarty_tpl->getSubTemplate ('me.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>