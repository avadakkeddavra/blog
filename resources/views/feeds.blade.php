@extends('layouts.app')

@section('content')

@php

function comments($arr, $parent_id = null){

	 if(empty($arr[$parent_id]))
    	{
    		return;
    	}
    	echo '';
    	for($i = 0; $i < count($arr[$parent_id]); $i++)
    	{
    		$item = $arr[$parent_id][$i];
    		if(!\Auth::guest() && \Auth::user()->id == $item->user->id)
    		{


    		echo '<div class="comment" data-id="'.$item->id.'"> <div class="comment_header">
				
						                                <img src="'.$item->user->img.'" alt="" class="img-responsive">
						                                <div class="user_info">
						                                    <span class="name">'.$item->user->name.'</span>
						                                    <span class="date">'.$item->created_at.'</span>
						                                </div>
						                                <div class="clearfix"></div>
						                            </div>
						                            <div class="comment_body">
						                                <p>'.$item->text.'</p>
						                            </div>

						                            <div class="comment_footer">
						                                <span class="comment-it"><i class="fa fa-pencil"></i> comment it</span>
						                                <span class="delete-it" data-id="'.$item->id.'" data-type="comments"><i class="fa fa-pencil"></i> delete it</span>
						                            </div>
						                           
						                         
    		';
    		}else{
    			echo '<div class="comment" data-id="'.$item->id.'"> <div class="comment_header">
				
						                                <img src="'.$item->user->img.'" alt="" class="img-responsive">
						                                <div class="user_info">
						                                    <span class="name">'.$item->user->name.'</span>
						                                    <span class="date">'.$item->created_at.'</span>
						                                </div>
						                                <div class="clearfix"></div>
						                            </div>
						                            <div class="comment_body">
						                                <p>'.$item->text.'</p>
						                            </div>

						                            <div class="comment_footer">
						                                 <span class="comment-it"><i class="fa fa-pencil"></i> comment it</span>
						                            </div>
						                           
						                         
    		';
    		}
    		echo ' <div class="sub_comments">';
    			comments($arr,$arr[$parent_id][$i]['id']);
    		echo '</div>';

    			echo '</div>';
    	}
	 
}

@endphp

			<button id="newPosts" style="display: none;">new <span >5</span></button>       
					<div class="preloader top">
				<div class="spin"></div>
			</div>     
            <div class="posts_container">
				@if(!isset($posts[0]))
					<h2 class="nothing"><i class="fa fa-code"></i><br/>Nothing to show</h2>
				@endif
            	@foreach($posts as $post)
					                <div class="post box" data-id="{{ $post->id }}" data-time="{{ $post->created_at }}">
						                    <div class="post_header">
						                        <img src="{{ $post->user->img }}" alt="" class="img-responsive">
						                        <div class="user_info">
						                            <span class="name">{{ $post->user->name }}</span>
						                            <span class="date">posted on {{ $post->created_at }}</span>
						                        </div>
						                        <div class="clearfix"></div>
						                    </div>
						                    
						                    <div class="post_body">
						                        <img src="{{ $post->img }}" alt="" class="img-responsive">
						                        <div class="post_text">
						                        	<h3>{{ $post->name }}</h3>
						                            {{ $post->text }}
						                        </div>
						                    </div>
						                    <div class="post_footer">
						                        <span class="comments"><i class="fa fa-comment"></i>{{ count($post->comments) }}</span>
						                        
						                        @auth
						                        	<span class="comment-it"><i class="fa fa-pencil"></i> comment it</span>
							                        @if(\Auth::user()->id == $post->user_id)
							                        <span class="delete-it" data-id="{{ $post->id }}" data-type="post"><i class="fa fa-pencil"></i> delete it</span>
							                        @endif
						                        @endauth
						                    </div>
											@php 
												$comments = $post->comments->groupBy('parent_id'); 
											@endphp

										
											<div class="comments_container">
												<div class="comments">
													{{ comments($comments) }}
												</div>
												@auth
												<div class="add_comment_container">
													<textarea class="addComment" data-id="{{ $post->id }}"></textarea> 
												</div>
												@endauth
											</div>
											
						                </div>
           		@endforeach
				
            </div>
            	<div class="preloader bottom">
				<div class="spin"></div>
			</div>
            <button id="loadmore"><i class="fa fa-paper-plane"></i>loadmore</button>
@endsection
@section('custom_scripts')
<script>
	localStorage.setItem('last_post','{{ $posts[0]->created_at }}');
	$(document).ready(function(){

		$('#newPosts').on('click',function(){
			var last = '{{ $posts[0]->created_at }}';
			$.ajax({
				url:'/feed/uploadNew',
				data:{id:last},
				type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                	$('#newPosts').fadeOut();
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
						$()
						localStorage.setItem('last_post',$('.wall').find('.posts_container').find('.new').data('time'));
					},1000)                
				}
			})
		})
	})
</script>
<script>
	
			$('#loadmore').on('click',function(){
			var last = $('.post').last().data('time');
			$.ajax({
				url:'/post/loadmore',
				data:{id:last,type:'feed'},
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
</script>
<script src="{{ asset('js/post.js') }}"></script>
@endsection