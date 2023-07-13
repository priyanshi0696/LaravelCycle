<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="index.html" class="logo"><img src="{{ asset('user/images/logo.png')}}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
             <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
             <a class="nav-link" href="about.html">About</a>
          </li>
          <li class="nav-item">
             <a class="nav-link" href="cycle.html">Our Cycle</a>
          </li>
          <li class="nav-item">
             <a class="nav-link" href="shop.html">Shop</a>
          </li>
          <li class="nav-item">
             <a class="nav-link" href="news.html">News</a>
          </li>
          <li class="nav-item">
             <a class="nav-link" href="contact.html">Contact Us</a>
          </li>
       </ul>
       <form class="form-inline my-2 my-lg-0">
          <div class="login_menu">
             <ul>
                <li><a href="{{route('logout')}}">Logout</a></li>

             </ul>
          </div>
          <div></div>
       </form>
    </div>
    <div id="main">
       <span style="font-size:36px;cursor:pointer; color: #fff" onclick="openNav()"><img src="{{ asset('user/images/toggle-icon.png')}}" style="height: 30px;"></span>
    </div>
 </nav>
