<?php /* Smarty version Smarty-3.1.12, created on 2012-11-12 02:23:42
         compiled from "..\view\home\about.tp" */ ?>
<?php /*%%SmartyHeaderCode:10361509331b607bda8-23690721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92ab8f036fcae7ffbfc24d642de6c3dd1c1d467c' => 
    array (
      0 => '..\\view\\home\\about.tp',
      1 => 1352683379,
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

		<p class="main-title">Goal能够帮你什么</p>

		<p>
			<span>你可以把自己想做的事儿收集到这里，无论它看起来如何的不值一提或不切实际，都无所谓。你可以为目标做出规划，并把实现目标中的点点滴滴记录下来。</span>
		</p>

		<p>
			<span>你可以关注他人，发现一些好玩的、有意义的、疯狂的目标，见证平行时空下的不同精彩，并从中得到启发。你也可以鼓励那些追梦的人，并在他们遇到困难的时候帮助他们。</span>
		</p>
		
		<p class="main-title">Goal诞生记</p>

		<p>
			<span>lzp（也就是我啦）是一个经常设立目标的人，但这些目标或由于看似无法实现，或因个人惰性，或被现实所挤压，以致于逐渐不了了之，渐渐地从“常立志”变得“无志”。</span>
		</p>

		<p>	
			有一次，lzp看到了 <a target='_blank' href='http://meditic.com'>Meditic</a
			> 的一篇博文《<a target='_blank' href='http://meditic.com/simplifying-and-splitting-a-dream/'>三十分之一的梦想</a>》，颇有感触：
		</p>
		
		<blockquote>

			<p>
				当我们把环游世界这个大梦想经过层层分解之后，就发现原来一开始只要几千元，就完全可以开始实现梦想了，根本不需要等待十几年之久。
			</p>
			
			<p>
				同样的道理，如果你有创业的梦想，那么马上就可以拉上两三个兄弟，从小生意开始做起，根本不需要等十几年以后，等到拖家带口、疲于奔命的时候才叹息那已被熄灭的雄心壮志；
			</p>
			
			<p>
				如果你爱上了哪个同事，马上就可以剪个干净的发型、穿上整洁的衣服，勇敢地把她约出来看电影，根本不需要等十几年以后，等到身体发福，彻夜炒股的时候才发现她已成人妻；
			</p>
			
			<p>
				如果你想学拉丁舞，马上就可以报名参加当地的舞蹈俱乐部，这个周末就可以开始练习第一次舞蹈，根本不需要等十几年以后，等到走路都气喘的时候才发现一辈子都不可能跳舞了；
			</p>
			
			<p>
				如果你想让父母快乐，马上就可以打电话回家，经常跟爸妈聊聊天，根本不需要等你十几年以后，等到老人都已经不在了才想到拿着一堆纸钱去孝敬土墓；
			</p>

		</blockquote>
			
		<p>
			<span>忽然意识到，我们是不是太习惯于夸大一个目标的实现难度，总觉得目前的现实条件不允许，因此不去做。但是当你静下心来的时候，会发现其实可以做的事情很多。把目标切割成小块儿，一步一个脚印地走下去，虽然前路也许依旧渺茫，但一定越走越远。</span>
		</p>

		<p>
			<span>那么，能否去做一个网站，帮助我设立目标，规划目标，并记录实现目标中的点滴历程呢？进一步思考，能否把这个站点放到Internet上，让其他人也能把他们的目标记录其中？说干就干，lzp从暑假开始学习基于PHP的Web建站技术，每天坚持抽出一点时间编写网站代码，一直到今天，Goal的轮廓才慢慢清晰。</span>
		</p>

	</div>

	<div id='sidebar' class='span3'>
		<?php echo $_smarty_tpl->getSubTemplate ('me.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>