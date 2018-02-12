 @auth
  <button id="showAddForm"><i class="fa fa-plus"></i></button>
   <div class="addPostBox">
       <div class="add_header">
           Add new post
           <button id="closeAdding"><i class="fa fa-close"></i></button>
       </div>
       <div class="add_body">
        <input type="text" class="form-control" id="post_title">
          <label for="post_message">Text of your post *</label>
           <textarea id="post_message"></textarea>
           <div class="add_footer">
              <div class="input_file">
               <button class="addImage"><i class="fa fa-image"></i></button>
               <input type="file" id="uploadImg"  accept=".jpg, .jpeg, .png"> 
               {{-- <span class="name"></span> --}}
              </div>
               
           </div>
           <div class="images">
             <div class="img_choosed">
               <img src="" alt="" class="img-responsive" id="post_image" data-image="">
               <div class="button_delete"><i class="fa fa-close"></i></div>
             </div>
           </div>
           
           <div class="clearfix"></div>
           
           <button class="create btn">Create</button>
       </div>
   </div>
   @endauth
    <header class="container-fluid">
        <div class="logo">
            <h1>LightIT</h1>
            <div class="logo_desc">
                <span class="task">BLOG</span>
                <span class="type">test</span>
            </div>
            
        </div>
        
        <div class="profile">

        @auth
            <img src="{{ \Auth::user()->img }}" alt="" class="img-responsive">
            <div class="user_info">
                <h3 class="name">{{ \Auth::user()->name }}</h3>
                <a href="" class="email">{{ \Auth::user()->email }}</a>    
            </div>

        @endauth
        </div>
    </header>