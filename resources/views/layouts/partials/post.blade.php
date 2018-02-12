

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
    		if(\Auth::user()->id == $item->user->id)
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
							

					                <div class="post new box" data-id="{{ $post->id }}" data-time="{{ $post->created_at }}">
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
						                            {{ $post->text }}
						                        </div>
						                    </div>
						                    <div class="post_footer">
						                        <span class="comments"><i class="fa fa-comment"></i>{{ count($post->comments) }}</span>
						                        <span class="comment-it"><i class="fa fa-pencil"></i> comment it</span>
						                        @if(\Auth::user()->id == $post->user_id)
						                        	<span class="delete-it" data-id="{{ $post->id }}" data-type="post"><i class="fa fa-pencil"></i> delete it</span>
						                        @endif
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
      