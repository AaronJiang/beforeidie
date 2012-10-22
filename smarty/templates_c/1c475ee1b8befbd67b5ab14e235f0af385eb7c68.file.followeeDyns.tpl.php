<?php /* Smarty version Smarty-3.1.12, created on 2012-10-22 13:41:48
         compiled from "..\view\dyn\followeeDyns.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24575085304da026a7-30353635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c475ee1b8befbd67b5ab14e235f0af385eb7c68' => 
    array (
      0 => '..\\view\\dyn\\followeeDyns.tpl',
      1 => 1350906106,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24575085304da026a7-30353635',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5085304daff586_29913572',
  'variables' => 
  array (
    'userID' => 0,
    'followeesNum' => 0,
    'followees' => 0,
    'fow' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5085304daff586_29913572')) {function content_5085304daff586_29913572($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'动态','page'=>'page-followee-dynamics'), 0);?>
<script type='text/javascript' src='../js/goal-comment.js'></script><script type='text/javascript'>//获取 URL 中的参数function getQueryStr(name) {	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); 	var r = window.location.search.substr(1).match(reg); 		if (r != null) 		return unescape(r[2]);		return null; }$(document).ready(function() {	//按需加载动态	function load_dyns(dynsType, userID, pageIndex, numPerPage, callback){		var data = {			'act': 'get_dynamics_' + dynsType,			'userID': userID,			'pageIndex': pageIndex,			'numPerPage': numPerPage		};		$.get('../html_proc.php', data, function(data){			$('#dynamics').append(data);			$('#more-dyns').show();			callback();		});		}	//初始化翻页参数	var userID = <?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
,		pageIndex = 1,		numPerPage = 20;	//获取 URL 中的动态类型	var dynsType = getQueryStr('type')? getQueryStr('type'): 'others';		//加载第一页	$('#more-dyns').hide();	load_dyns(dynsType, userID, pageIndex, numPerPage, function(){		//若动态条目少于 10，则不显示 more 按钮		if($('.dynamic-item').length < 10){			$('#more-dyns').detach();		}		else{			//加载更多动态			$('#more-dyns').click(function(){				pageIndex += 1;				load_dyns(dynsType, userID, pageIndex, numPerPage);			});		}	});});</script><div id='main-panel'>	<div id='dynamic-sel-wap'>		<a class='dynamic-sel dynamic-sel-others' href='DynC.php?act=followeeDyns&type=others'>好友动态</a>		<a class='dynamic-sel dynamic-sel-me' href='DynC.php?act=followeeDyns&type=me'>与我相关</a>	</div>	<div id='dynamics' class='clearfix'></div>		<div id='more-dyns'>更多动态</div></div><div id='sidebar-panel'>		<?php echo $_smarty_tpl->getSubTemplate ('../panel_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'我的关注','cmd'=>"管理 (".((string)$_smarty_tpl->tpl_vars['followeesNum']->value).")",'link'=>"DynC.php?act=adminFollowees&followerID=".((string)$_smarty_tpl->tpl_vars['userID']->value)), 0);?>
			<?php  $_smarty_tpl->tpl_vars['fow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['followees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fow']->key => $_smarty_tpl->tpl_vars['fow']->value){
$_smarty_tpl->tpl_vars['fow']->_loop = true;
?>	<a title="<?php echo $_smarty_tpl->tpl_vars['fow']->value['Username'];?>
" href="person.php?userID=<?php echo $_smarty_tpl->tpl_vars['fow']->value['UserID'];?>
">		<img class='multi-user-profile' src="<?php echo $_smarty_tpl->tpl_vars['fow']->value['Avatar'];?>
" />	</a>	<?php } ?></div><?php echo $_smarty_tpl->getSubTemplate ('../footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>