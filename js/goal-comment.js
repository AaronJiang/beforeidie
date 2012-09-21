$(document).ready(function(){
	
	//弹出回复框
	$('.cmd-new-comment').click(function(){
		var posterID = $(this).data('poster-id'),
			logID = $(this).data('log-id'),
			isRoot = $(this).data('is-root'),
			parentCommentID = isRoot? 0: $(this).data('parent-comment-id'),
			avatarUrl = $(this).data('avatar-url');
		
		//构建 HTML 块
		var html = "<div class='new-comment-wap clearfix'>"
					+ "<img class='avatar' src='" + avatarUrl + "'>"
					+ "<div class='new-comment-form'>"
						+ "<div class='comment-input' contenteditable='true'></div>"
						+ "<span class='comment-submit'>回复</span>"
						+ "<span class='comment-cancel'>取消</span>"
					+ "</div>"
				+ "</div>"
			
		//插入DOM
		$(html).appendTo($(this).parents('.dynamic-item'))	
			.find('.comment-input')
				.focus() //聚焦
				.blur(function(){	//失焦则从DOM中删除
					if($.trim($(this).text()) == ""){
						$(this).parent().parent().detach();
					}
				})
			.next()
				.click(function(){	//提交回复
					var comment = $(this).prev().text();
					$.ajax({
						url: 'comment_proc.php',
						type: 'post',
						data: {
							'proc': 'new',
							'comment': comment,
							'posterID': posterID,
							'logID': logID,
							'parentCommentID': parentCommentID,
							'isRoot': isRoot
						}
					});
					
					$(this).parent().parent().detach();
					
					location.reload();
				})
			.next()	//取消回复
				.click(function(){
					$(this).parent().parent().detach();	
				});;
	});
});