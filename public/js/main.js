
$(document).ready(function(){
     var form = $('.addPostBox');
    $('#showAddForm').on('click',function(){
       
        
        if(form.is(':hidden'))
        {
            form.fadeIn(200);
            form.css({
                transform:'scale(1)'
            });
        }
    });
    
    $('#closeAdding').on('click',function(){
        if(form.is(':visible')){
            form.css({
                transform:'scale(0)'
            });
            form.fadeOut(200);
        }
    });
    $('body').find('.post').on('click','.comment-it',function(){
        var textarea = $(this).parents('.box').find('.addComment');
        var parent_comment = $(this).parents('.comment');

        if(parent_comment.html() != undefined)
        {
            textarea.attr('data-parent',parent_comment.data('id'))
        }
        if(textarea.is(':hidden'))
        {
            textarea.slideDown(200);
        }

    })
})