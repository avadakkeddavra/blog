$(document).ready(function(){

	setInterval(function(){
			$.ajax({
                url:'/post/count',
                data:{id: localStorage.getItem('last_post')},
                type: 'POST',
                async:false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                	if(response.count != 0)
                	{
                		$('.iconCount').text(response.count);
                		$('.iconCount').css({
                			opacity:'1'
                		})
                		
                		$('#newPosts').fadeIn();
                		$('#newPosts').find('span').text(response.count);
                	}else{
                		$('.iconCount').text('');
                		$('.iconCount').css({
                			opacity:'0'
                		})
                	}
                }
            });
	},10000);

	$('#uploadImg').on('change',function(){
			var data = new FormData;

            data.append('img',$(this).prop('files')[0]);

            $.ajax({
                url:'/post/upload',
                data:data,
                processData: false,
                contentType:false,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                	$('.images').fadeIn(200);
                    $('#post_image').attr('src','/img/post_images/'+response);
                }
            });
	});
	$('.button_delete').on('click',function(){
		$('#post_image').attr('src',' ');
		$('.images').fadeOut(200);
		$('#uploadImg').val('');
	})
	$('.create').on('click',function(){
		var text = $('#post_message').val();
		var img = $('#post_image').attr('src');
		var title = $('#post_title').val();

		if(text != '' && title != '')
		{
			$.ajax({
				url:'/post/create',
				data:{text:text,img:img,title:title},
				type:'POST',
				headers: {
			          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			    },
				success:function(response){
					$('.posts_container').prepend(response);
					$('.preloader.top').fadeIn(200);
					setTimeout(function(){
						$('.wall').find('.posts_container').find('.new').each(function(i,elem){
							$(this).fadeIn(200);
							$(this).css({
								transform:'scale(1)'
							});
						});
						$('.preloader').fadeOut();
					},1000)
					
					console.log(response);
					$('.images').fadeOut(200);
                    $('#post_image').attr('src','');
                    $('#post_message').val('');
                    $('#post_title').val('');
                    if($('.nothing'))
                    {
                    	$('.nothing').remove();
                    }
				}
			});
		}
	});	
	$('body').on('click','.delete-it',function(){
		var id = $(this).data('id');
		
		var type = $(this).data('type');

		if(type == 'comments')
		{
			var item = $(this).parents('.comment').eq(0);
		}else{
			var item = $(this).parents('.post');
		}
		$.ajax({
			url:'/'+type+'/delete',
			data:{id:id},
			type:'POST',
			dataType:'json',
			headers: {
			          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(response)
			{
				if(response.success == 1)
				{
					
					item.css({
						transform:'scale(0)',
					});
					item.fadeOut(200);
				}
			}
		})
	})
	$('body').on('keydown','.addComment',function(e){
		//alert(e.keyCode);
		if(e.keyCode == 13)
		{
			var event = e;
			var $this = $(this);
			var comment = $(this).val();
			var post_id = $(this).data('id');
			var parent_id = $(this).attr('data-parent');

			if(!parent_id)
			{
				parent_id = null;
				var template = $(this).parents('.comments_container').find('.comments');
			}else{
				var template = $('.comment[data-id="'+parent_id+'"]').find('.sub_comments').eq(0);
			}
			
			if(comment != '')
			{
				$.ajax({
					url:"/comments/create",
					data:{text:comment,post_id:post_id,parent_id:parent_id},
					type:'POST',
					headers: {
				          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				    },
					success: function(response){
						console.log(response);
						template.append(response);
						$this.val('');
						event.stopPropagation();
					}
				});
			}

		}

	})

		$('#loadmore').on('click',function(){
			var last = $('.post').last().data('time');
			$.ajax({
				url:'/post/loadmore',
				data:{id:last},
				type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                	$('#newPosts').fadeOut();
                	$('.posts_container').append(response);
					$('.preloader.bottom').fadeIn(200);
					setTimeout(function(){
						$('.wall').find('.posts_container').find('.new').each(function(i,elem){
							$(this).fadeIn(200);
							$(this).css({
								transform:'scale(1)'
							});
						});
						$('.preloader').fadeOut();
						
					},1000)                
				}
			});
		})
})