$(document).ready(function(){
	
	//弹出回复框
	$('.cmd-new-comment').live('click', function(){

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
				+ "</div>";
			
		//插入DOM
		$(html).appendTo($(this).parents('.new-comment-parent').first())
			.find('.comment-input').first()	//输入框聚焦，失焦时则从DOM中删除
				.focus() 
				.blur(function(){	
					if($.trim($(this).text()) == ""){
						$(this).parent().parent().detach();
					}
				})
			.next()	//提交回复
				.click(function(){	
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
				});
	});
});