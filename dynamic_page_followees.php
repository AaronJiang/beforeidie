<?php	require_once('data_funs.inc');	require_once('html_helper.php');	html_output_authed_header("动态", 'page-followees-dynamics');?><script type='text/javascript' src='js/goal-comment.js'></script><script type='text/javascript'>//获取 URL 中的参数function getQueryStr(name) {	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); 	var r = window.location.search.substr(1).match(reg); 		if (r != null) 		return unescape(r[2]);		return null; }$(document).ready(function(){	//按需加载动态	function load_dyns(dynsType, userID, pageIndex, numPerPage, callback){		var data = {			'proc': 'get_dynamics_' + dynsType,			'userID': userID,			'pageIndex': pageIndex,			'numPerPage': numPerPage		};		$.get('html_proc.php', data, function(data){			$('#dynamics').append(data);			$('#more-dyns').show();			callback();		});		}	//初始化翻页参数	var userID = <?php echo $_SESSION['valid_user_id'] ?>,		pageIndex = 1,		numPerPage = 20;	//获取 URL 中的动态类型	var dynsType = getQueryStr('type')? getQueryStr('type'): 'others';		//加载第一页	$('#more-dyns').hide();	load_dyns(dynsType, userID, pageIndex, numPerPage, function(){		//若动态条目少于 10，则不显示 more 按钮		if($('.dynamic-item').length < 10){			$('#more-dyns').detach();		}		else{			//加载更多动态			$('#more-dyns').click(function(){				pageIndex += 1;				load_dyns(dynsType, userID, pageIndex, numPerPage);			});		}	});});</script><div id='main-panel'>	<!-- 动态类型选择 -->	<div id='dynamic-sel-wap'>		<a class='dynamic-sel dynamic-sel-others' href='?type=others'>好友动态</a		><a class='dynamic-sel dynamic-sel-me' href='?type=me'>与我相关</a>	</div>	<!-- 动态 -->	<div id='dynamics' class='clearfix'></div>		<!-- 加载更多动态 -->	<div id='more-dyns'>更多动态</div></div><div id='sidebar-panel'>		<?php		$userID = $_SESSION['valid_user_id'];				$followees_num = get_followees_num($userID);				@html_out_panel_header('我的关注', '管理 ('.$followees_num.')', '', 'follower_page_admin_followees.php?followerID='.$userID);				$followees = get_followees($userID, 16);				foreach($followees as $fow){			echo "<a title='". $fow['Username']. "' href='person.php?userID=". $fow['UserID'] ."'>"					. "<img class='multi-user-profile' src='". get_user_profile($fow['UserID']). "' />"				. "<a>";		}	?></div><?php	html_output_authed_footer();?>