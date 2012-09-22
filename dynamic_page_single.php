<?php
	require_once('data_funs.inc');
	require_once('html_helper.php');

	$userID = $_REQUEST['userID'];
	$username = get_username_by_id($userID);

	@html_output_authed_header($username. " 的动态", 'page-single-dynamics');
	
	$isMe = ($_SESSION['valid_user_id'] == $userID);
?>

<script type='text/javascript' src='js/goal-comment.js'></script>

<script type='text/javascript'>

$(document).ready(function(){

	//按需加载动态
	function load_dyns(userID, pageIndex, numPerPage, isMe){
		var data = {
			'proc': 'get_dyns_single',
			'userID': userID,
			'pageIndex': pageIndex,
			'numPerPage': numPerPage,
			'isMe': isMe
		};

		$.get('html_proc.php', data, function(data){
			$('#dyns').append(data);
			$('#more-dyns').show();	
		});	
	}

	//初始化翻页参数
	var userID = <?php echo $userID ?>,
		pageIndex = 1,
		numPerPage = 20,
		isMe = <?php echo $isMe? 1: 0; ?>;
	
	//加载第一页
	$('#more-dyns').hide();
	load_dyns(userID, pageIndex, numPerPage, isMe);
	
	//加载更多动态
	$('#more-dyns').click(function(){
		pageIndex += 1;
		load_dyns(userID, pageIndex, numPerPage, isMe);
	});
});

</script>
	
<p class='subtitle'><?php echo $username ?> 的全部动态</p>

<div id='dyns'></div>

<div id='more-dyns'>More</div>
	
<?php
	html_output_authed_footer();
?>