<?php
	require('header.php');
	require_once('data_funs.inc');
	
	if(!is_auth()){
		page_jump('account_page_login.php');
	}
?>
<script type="text/javascript">
	$('body').prop('id', 'page-about');
</script>

<div id='main-content'>

	<p class='main-title'>使用条款<p>

	<ul>
		<li>
			本站不允许您发布任何带有政治、色情、暴力、诽谤、侮辱、威胁、猥亵、攻击或其他违反法律或公共秩序的文字或图片，也不允许您发布侵害他人名誉、隐私、商业机密、商标权、著作权、专利权或其他知识产权的文字或图片。管理员有权利删除不合适的内容。
		</li>

		<li>
			本站对由注册会员发布的任何内容不享有版权，内容的版权属于原始发布者，如果您需要拷贝、转载或引用部分内容，请提前获取发布者本人的许可。对于发布不当内容而带来的法律责任，也由发布者本人承担，如有必要，本站将配合司法机关进行相应的调查。
		</li>
	
		<li>
			对于黑客入侵等情形所造成的资料丢失或外流，本站不必负法律责任。
		</li>

		<li>
			本站希望能长期为您提供服务，但保留暂停或终止服务的权利。
		</li>
	</ul>
	
	<p class='main-title'>隐私保护</p>

	<ul>
		<li>
			在使Goal的过程中，您只需提供作为唯一标识的Email帐号，本站不会出售、交易您的Email。
		</li>
		
		<li>
			您的登录密码经过可靠的MD5单向加密后存入数据库，因此即使网站管理员也无法知道您的真正密码。
		</li>
			
		<li>
			本站不会将您记录在Goal的目标信息以任何方式转让给第三方。
		</li>
	</ul>
</div>

<div id='sidebar'>
	<p class="main-title">关于我</p>
	
	<img id='my-avatar' src='imgs/me.jpg' />
	
	<div id='my-intro'>
		<p>lzp，90后吊丝一枚，2012年毕业于关山口职业技术学院。对本专业完全无爱，考研遂转投计算机阵营，方向机器视觉，业余爱好Web开发。</p>
		<p><b>E-mail :</b> hustlzp@qq.com</p>
	</div>
	
	<p class='main-title'>付费支持</p>
	
	<p>Goal的运营费用是从个人生活费中挤出，资金相当有限，欢迎付费支持！</p>
	<span id='donate-btn' href=''>Donate</span>
</div>

<?php
	require('footer.php');
?>