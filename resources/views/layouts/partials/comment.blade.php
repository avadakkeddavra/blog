<div class="comment" data-id="{{ $comment->id }}"> 
	<div class="comment_header">			
		<img src="https://avatars0.githubusercontent.com/u/26938912?v=4" alt="" class="img-responsive">
		<div class="user_info">
		    <span class="name">{{ $comment->user->name }}</span>
		    <span class="date">{{ $comment->created_at }}</span>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="comment_body">
	    <p>{{ $comment->text }}</p>
	</div>
	<div class="comment_footer">
	    <span class="comment-it"><i class="fa fa-pencil"></i> comment it</span>
	    <span class="delete-it" data-id="{{ $comment->id }}" data-type="comments"><i class="fa fa-pencil"></i> delete it</span>
	</div>					                         
    <div class="sub_comments"></div></div>