<?php
	require('header.php');
	require_once('data_funs.inc');
	
	if(!is_auth()){
		page_jump('account_page_login.php');
	}
?>

<script type="text/javascript">
	$('body').prop('id', 'page-about-terms');
</script>

<div id='main-content'>

	<p class="main-title">Goal能够帮你什么</p>

	<p>
		<span>你可以把自己想做的事儿收集到这里，无论它看起来如何的不值一提或不切实际，都OK。</span
		><span>你可以为目标做出规划，并把实现目标中的点点滴滴记录下来。</span>
	</p>

	<p>
		<span>你可以关注他人，发现一些好玩的、有意义的、疯狂的目标，见证平行时空下的不同精彩。</span
		><span>你可以从中得到启发，也可以帮助一些在实现目标中遇到困难的人。</span>
	</p>
	
	<p class="main-title">Goal诞生记</p>

	<p>
		<span>lzp（我）是一个经常设立目标的人，但这些目标或因看似无法实现，</span
		><span>或因个人惰性，或被现实所拉扯，以致于逐渐不了了之，从“常立志”变得“无志”。</span>
	</p>

	<p>	
		有一次，lzp读到了 <a target='_blank' href='http://meditic.com'>Meditic</a
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
		<span>忽然意识到，我们太习惯于夸大一个目标的实现难度，总觉得目前的现实条件不允许，因此不去做。</span
		>但是当你静下心来的时候，会发现其实可以做的事情很多。</span
		>把目标切割成小块儿，一步一个脚印地走下去，虽然前路也许依旧渺茫，但一定越走越远。</span>
	</p>

	<p>
		<span>那么，能否去做一个网站，帮助我设立目标，规划目标，并记录实现目标中的点滴历程呢？</span
		><span>进一步，能否把这个站点放到网上，让其他人也能把他们的目标记录其中？</span
		><span>说干就干，lzp从暑假开始学习基于PHP的Web建站技术，每天坚持抽出一点时间编写网站代码，一直到今天，Goal的轮廓才慢慢清晰。</span>
	</p>

</div>

<?php	
	require('about_me.php');
	require('footer.php');
?>