 <div class="sidebar col-md-3">
            <div class="notification-buttons"></div>  
            <div class="menu">
                <ul class="list-unstyled">
                    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                    <li class="feedCounts"><a href="/feed"><i class="fa fa-list"></i> Feeds <span class="iconCount" style='width: 15px;
                    height: 15px;
                    border-radius: 50%;background-color: #6ed1a3;opacity: 0;display:inline-block;text-align: center;line-height: 15px;font-size: 10px;color:#fff'></span></a></li>
                    @auth
                    <li><a href="/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                    @else
                    <li><a href="/login"><i class="fa fa-sign-in"></i> Login</a></li>
                    @endauth
                    
                </ul>
            </div>
  </div>