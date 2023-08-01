

<div class="header-v6 header-classic-dark ">

<div class="navbar navbar-default mega-menu" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          
            <!-- Navbar Brand -->
            <div class="navbar-brand">
                <a href="index.html">
                    <img class="shrink-logo" src="assets/img/logo.png" alt="Logo">
                </a>
            </div>
        </div>

            <!-- Header Inner Right -->
            <div class="header-inner-right">
                <ul class="menu-icons-list">
                    <li class="menu-icons shopping-cart">
                        <i class="menu-icons-style radius-x fa fa-user"></i>
                       <span class="badge">0</span>
                        <div class="shopping-cart-open">
             
                                                                  
                  </span>
                            <a href="#" class="btn-u"><i class="fa fa-user"></i> سجل الدخول</a>
             
                                
                           
                        </div>
                    </li>

                </ul>    
            </div>
            <!-- End Header Inner Right -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-responsive-collapse">

            <!-- End Shopping Cart -->

            <!-- Nav Menu -->
           <ul class="nav navbar-nav" style="padding-top: 2%;">
                <!-- Pages -->
                  <li>
<a href="{{ URL::route('home') }}">
    الرئيسية
 
</a>

    </li>

<li>
<a href="{{ URL::route('news') }}">
   الأخبار
 
</a>

    </li>

<li>
<a href="{{ URL::route('contacts') }}">
    اتصل بنا
 
</a>

    </li>

<li>
<a href="{{ URL::route('about') }}">
    عن المشروع
 
</a>

    </li>

<li>

<a href="{{ url('profile') }}">

   حسابي
 
</a>

    </li>
   <li>
    <a href="{{url('translatePage')}}">
   ترجمة
 
</a>

    </li>

                    <!-- End Pages -->

               

               
            </ul>
            <!-- End Nav Menu -->
        </div>
    </div>    
</div>            
</div>
