<?php $site_title = "American Bass Club";  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $site_title; ?></title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/slick-master/slick/slick.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/slick-master/slick/slick-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}" />
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KNGJRYL71P"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-KNGJRYL71P');
    </script>

  </head>
  <body>
      
    <!-- =================== HEADER AREA START ===================== -->
    <header class="header-nav">
        <div class="header__area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header__blk">
                            <div class="header__logo">
                                <a href="{{url('/')}}" class="logo"><img src="{{ asset('img/logo.svg')}}" alt=""></a>
                            </div>
                            <div class="header__right__blk">
                                <div class="header__right__btn__blk item__none">


                                    @guest
                                        <a href="{{ route('login') }}"><i class="fa fa-user"></i>Login</a>
                                        <a href="{{ url('/join') }}"><i class="fa fa-user-plus"></i>Join</a>
                                    @endguest
                        
                                    @auth
                        
                                      @php 
                                        $memberCheck = DB::table('memberships')->where([['user_id', Auth::id()], ['member_status', 1]])->count();
                                      @endphp
                                        @if($memberCheck == true && $memberCheck > 0 )
                                            <a href="{{ route('home') }}"><i class="fa fa-user"></i>Dashboard</a>
                                        @else
                                          <a href="{{ url('/join') }}"><i class="fa fa-user-plus"></i>Join</a>
                        
                                        @endif
                        
                                          <a href="{{ url('/logout') }}"><i class="fa fa-user"></i>Logout</a>
                        
                                    @else
                                          {{--<a href="{{ url('/join') }}"><i class="fa fa-user-plus"></i>Join</a>--}}
                        
                                    @endauth
                                </div>
                                <div class="main__menu">
                                    <nav>
                                        <ul>
                                            <li>
                                                <a href="{{url('/')}}">Home</a>
                                            </li>
                                            
                                            <!--<li>-->
                                            <!--    <a href="{{url('/about')}}">About</a>-->
                                               
                                            <!--</li>-->
                                            
                                            
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Resources
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li><a class="dropdown-item" href="{{url('/about')}}">About</a></li>
                                                    <li><a class="dropdown-item" href="https://americanbassclub.com/rules">Qualifier Rules</a></li>
                                                    <li><a class="dropdown-item" href="https://americanbassclub.com/big-bass-tournament-rules">Big Bass Tournament rules</a></li>
                                                    <li><a class="dropdown-item" href="https://americanbassclub.com/payouts">Payouts</a></li>
                                                    <li><a class="dropdown-item" href="https://americanbassclub.com/connect-scale">Connect Scale</a></li>
                                                    
                                                    
                                                    
                                    
                                                    <li><a class="dropdown-item" href="https://americanbassclub.com/contact">Contact Us</a></li>
                                                </ul>

                                            </li>
                                            
                                             <li class="nav-item dropdown">
                                                <a href="{{url('/member-benefits')}}">Sponsors</a>
                                            </li>
                                            
                                            
                                            
                                            
                                            

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="scheduleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Schedule
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="scheduleDropdown">
                                                     <?php
                                                     $tournaments = DB::table('tournaments')->where('is_deleted', 0)->where('date', '>=', date('Y-m-d'))->orderBy('date', 'ASC')->limit(10)->get();
                                                     ?>
                                                     @foreach($tournaments as $t)
                                                         <li><a class="dropdown-item" href="{{url('/tournament/info')}}/{{$t->id}}">{{$t->name}}</a></li>
                                                     @endforeach
                                                     <li><a class="dropdown-item" href="https://americanbassclub.com/tournament/info/8">Online Big Smallmouth</a></li>
                                                     <li><a class="dropdown-item" href="https://americanbassclub.com/tournament/info/9">Online Big Largemouth</a></li>
                                                </ul>
                                            </li>
                                                                        
                                            
                                            
 




   
                                            <li>
                                                <a href="{{url('https://www-americanbassclub.myshopify.com/')}}">Shop</a>
                                               
                                                
                                          
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="header__right__btn__blk desk__none">
                                        
                                        @guest
                                            <a href="{{ route('login') }}"><i class="fa fa-user"></i>Login</a>
                                            
                                            <a href="{{ url('/join') }}"><i class="fa fa-user-plus"></i>Join</a>
                                            
                                        @endguest
                            
                                        @auth
                            
                                          @php 
                                            $memberCheck = DB::table('memberships')->where([['user_id', Auth::id()], ['member_status', 1]])->count();
                                          @endphp
                                            @if($memberCheck == true && $memberCheck > 0 )
                                                <a href="{{ route('home') }}"><i class="fa fa-user"></i>Dashboard</a>
                                            @else
                                              <a href="{{ url('/join') }}"><i class="fa fa-user-plus"></i>Join</a>
                            
                                            @endif
                            
                                              <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>Logout</a>
                            
                                        @else
                                              {{--<a href="{{ url('/join') }}"><i class="fa fa-user-plus"></i>Join</a>--}}
                            
                                        @endauth

                                        
                                    </div>
                                    <div class="close__menu desk__none">
                                        <i class="fa fa-times"></i>
                                    </div>
                                </div>
                                <div class="open__menu desk__none">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <div class="overlay desk__none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__shape">
                <img src="{{ asset('/img/header_shape.png')}}" alt="">
            </div>
        </div>
    </header>
    <!-- =================== HEADER AREA END ===================== -->

{{--      
      
      
    <!--Navbar-->
    <nav class="navbar fixed-top py-3 navbar-expand-lg navbar-dark bg-dark">
      <div class="container px-5">
        <a style="font-size: x-large; font-weight:bold" class="navbar-brand" href="{{url('/')}}">AmericanBassClub.com</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/about')}}#features">About</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="{{url('#')}}#features">Resources</a>
            </li>
           
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Schedule
          </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="/tournament/info/1">Northern Qualifier</a></li>
                <li><a class="dropdown-item" href="/tournament/info/3">Eastern Qualifier</a></li>
                <li><a class="dropdown-item" href="/tournament/info/4">Southern Qualifier</a></li>
                <li><a class="dropdown-item" href="/tournament/info/5">Western Qualifier</a></li>
                <li><a class="dropdown-item" href="/tournament/info/6">Central Qualifier</a></li>
              </ul>
            </li>
               <li class="nav-item">
              <a class="nav-link" href="{{url('/contact')}}#features">Contact</a>
            </li>
            @auth
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Dashboard</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{url('/login')}}">Login</a>
            </li>
            @endauth

            @auth

              @php 
                $memberCheck = DB::table('memberships')->where([['user_id', Auth::id()], ['member_status', 1]])->count();
              @endphp
                @if($memberCheck == true && $memberCheck > 0 )

                @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('/join')}}">Join</a>
                  </li>
                @endif

              <li class="nav-item">
                <a class="nav-link" href="{{url('/logout')}}">Logout</a>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{url('/join')}}">Join</a>
              </li>
              
            @endauth


          </ul>
        </div>
      </div>
    </nav>
    
    --}}
   @yield('content')
   
   


    <!-- =================== FOOTER AREA START ===================== -->
    <footer>
        <div class="footer__area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="footer__widget">
                            <div class="footer__left__blk">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="footer__content">
                                            <h4>2022 Schedule</h4>
                                            <div class="footer__list">
                                                <nav>
                                                    <ul>
                                                        <li>
                                                            <a href="https://americanbassclub.com/tournament/info/1">Northern Qualifier</a>
                                                        </li>
                                                        <li>
                                                            <a href="https://americanbassclub.com/tournament/info/3">Eastern Qualifier</a>
                                                        </li>
                                                        <li>
                                                            <a href="https://americanbassclub.com/tournament/info/4"> Southern Qualifier</a>
                                                        </li>
                                                        <li>
                                                            <a href="https://americanbassclub.com/tournament/info/5"> Western Qualifier</a>
                                                        </li>
                                                        <li>
                                                            <a href="https://americanbassclub.com/tournament/info/6">Central Qualifier</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="footer__content">
                                            <h4>Quick Links</h4>
                                            <div class="footer__list">
                                                <nav>
                                                    <ul>
                                                        <li>
                                                            <a href="https://americanbassclub.com/rules">Rules </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://americanbassclub.com/contact">Contact Us</a>
                                                        </li>
                                                        <li>
                                                            <a href="https://americanbassclub.com/about">About Us</a>
                                                        </li>
                                                        <li>
                                                            <a href="https://americanbassclub.com/refund">Refund Policy</a>
                                                        </li>
                                                        <li>
                                                            <a href="https://americanbassclub.com/privacy_policy">Privacy Policy</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer__widget">
                            <div class="footer__content">
                                <h4>Get Started</h4>
                                <p>Welcome to American Bass Club.</p>
                                <div>
                                <a href="http://Www.facebook.com/americanbassclub" target="_blank"><svg style="width:25px;fill:#ffffff;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"/></svg>    </a>
                                </div>
                                <div class="hero__btn footer__btn">
                                    <a href="https://americanbassclub.com/register">Join Today!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="footer__shape"><img src="/img/footer-shape.png" alt=""></span>
            <a href="#" class="footer__logo__shape"><img src="/img/logo__shape.png" alt=""></a>
        </div>
    </footer>
    <!-- =================== FOOTER AREA END ===================== -->


    <!-- =================== FOOTER BOTTOM AREA START ===================== -->
    <section>
        <div class="footer__bottom__area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer__widget">
                            <div class="footer__menu" style="display:none;">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="#">Rules</a>
                                        </li>
                                        <li>
                                            <a href="#">Contact</a>
                                        </li>
                                        <li>
                                            <a href="#">About Us</a>
                                        </li>
                                        <li>
                                            <a href="#">Refund Policy</a>
                                        </li>
                                        <li>
                                            <a href="#">Terms of Service</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="footer__logo">
                                <a href="#" class="logo"><img src="/img/logo.svg" alt=""></a>
                            </div>
                            <div class="copyright__text">
                                <p>Copyright © AmericanBassClub 2022</p>
                                <p class="m-0 text-center text-white ajs-footer">Design By <a style="color:#fff;" href="https://www.ajswebdesigns.com/" target="_blank">Ajs Web Designs</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =================== FOOTER BOTTOM AREA END ===================== -->
    <!--footer-->
    {{--<footer class="footer-14398 bg-dark">
    <div class="container px-5">
        <div class="row mb-5">
            <div class="col-md-5">
                <a href="#" class="footer-site-logo">American Bass Club</a>
                <p>Welcome to The American Bass Club </p>
                <a class="btn btn-primary btn-lg" href="https://americanbassclub.com/register" role="button">Join Now</a>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2 ml-auto">
                <h3>{{date('Y')}} Schedule</h3>
                <ul class="list-unstyled links">
                    <li><a href="https://americanbassclub.com/tournament/info/1">Northern Qualifier</a></li>
                    <li><a href="https://americanbassclub.com/tournament/info/3">Eastern Qualifier</a></li>
                    <li><a href="https://americanbassclub.com/tournament/info/4">Southern Qualifier</a></li>
                    <li><a href="https://americanbassclub.com/tournament/info/5">Western Qualifier</a></li>
                    <li><a href="https://americanbassclub.com/tournament/info/6">Central Qualifier</a></li>
                </ul>
            </div>
            <div class="col-md-2 ml-auto">
                <h3>Quick Links</h3>
                <ul class="list-unstyled links">
                    <li><a href="#">Events</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Awards</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Online retail</a></li>
                </ul>
            </div>
            <div class="col-md-2 ml-auto">
                <h3>Legal</h3>
                <ul class="list-unstyled links">
                    <li><a href="https://americanbassclub.com/contact">Contact</a></li>
                    <li><a href="https://americanbassclub.com/privacy_policy">Privacy Policy</a></li>
                    <li><a href="https://americanbassclub.com/rules">Rules</a></li>
                    <li><a href="https://americanbassclub.com/refund">Refund Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12 pb-4">
                <div class="line"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <small>
                    <p class="m-0 text-center text-white">Copyright © AmericanBassClub {{date('Y')}}</p>
                </small>
            </div>
        </div>
    </div>
<div style="text-align:center;" class="container mt-2">
  <div class="row">
    <div class="col-sm">
    </div>
  </div>
</div>
</footer>--}}
    <!--scripts-->
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/js/aos.js')}}"></script>


<script>

    jQuery(document).ready(function(){

        $('input:radio[name="paymentMethod"]').change(
            function(){
                if ($(this).is(':checked') && $(this).val() == 'cheque') {
                     $('#chequenote').show();
                    $('#chequePaymenNote').after('<div id="chequenote"><b>NOTE:</b> Please send your cheque to this following address <br/><br/><b> P.O Box 326 Swartz Creek <br/>48473 Michigan<br/>United States.</b><br/><br/> For any query please Email us at : <b>info@americanbassclub.com</b>, <br/>or call us at <b>Tel. 810-577-7919 </b></div>');
                }else{
                     $('#chequenote').remove();
                }
            });
    });
    </script>
    
    <script
      src="https://kit.fontawesome.com/32947f5e44.js"
      crossorigin="anonymous"
    ></script>
    <script
      type="text/javascript"
      src="{{asset('assets/slick-master/slick/slick.min.js')}}"
    ></script>
    <script>
      $(document).ready(function () {
        $(".myCarousal").slick({
          centerMode: true,
          slidesToShow: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 997,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true,
              },
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true,
              },
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true,
              },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ],
        });
      });
    </script>
    
    <script>
            



(function($) {
    "use strict";


    jQuery(document).ready(function($) {




        //------------ Offcanvas menu -------------

        $('.open__menu').on('click', function() {
            $('.main__menu, .overlay').addClass('active');
        })
        $('.close__menu, .overlay').on('click', function() {
            $('.main__menu, .overlay').removeClass('active');
        })



        //------------ brand__slide__blk -------------

        $('.brand__slide__blk').owlCarousel({
            dots: false,
            loop: true,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            autoplay: true,
            smartSpeed: 1000,
            autoplayTimeout: 3500,
            items: 3,
            margin: 5,
            slideToScroll: 1,
            center: false,
            autoplayHoverPause: true,

            responsive: {
                0: {
                    stagePadding: 0,
                },
                320: {
                    items: 1,
                    stagePadding: 0,
                },
                450: {
                    items: 2,
                    stagePadding: 0,
                },
                575: {
                    items: 2,
                    stagePadding: 0,
                },
                768: {
                    items: 3,
                    stagePadding: 0,
                },
                992: {
                    items: 3,
                    stagePadding: 0,
                },
                1100: {
                    items: 3,
                    stagePadding: 0,
                },
                1200: {
                    items: 3,
                    stagePadding: 0,
                },
            }
        })



        //---owl dots number-----

        var i = 1;

        $('.hero-slier-main.owl-carousel .owl-dot').each(function() {
            $(this).text(i);
            i++;
        });



        // You can also pass an optional settings object
        // below listed default settings
        AOS.init({
            // Global settings:
            disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
            startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
            initClassName: 'aos-init', // class applied after initialization
            animatedClassName: 'aos-animate', // class applied on animation
            useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
            disableMutationObserver: false, // disables automatic mutations' detections (advanced)
            debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
            throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


            // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
            offset: 120, // offset (in px) from the original trigger point
            delay: 0, // values from 0 to 3000, with step 50ms
            duration: 400, // values from 0 to 3000, with step 50ms
            easing: 'ease', // default easing for AOS animations
            once: true, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
            anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

        });


    }); //---document-ready-----





}(jQuery));



    </script>
    
    
    
    
<script type="text/javascript">
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $('#team_members_id').on('input', function(e) {
   
   
    //$(".btn-submit").click(function(e){
  
        e.preventDefault();
    
        var team_members_id = $("input[name=team_members_id]").val();
        if(team_members_id.length > 3 && team_members_id.length <6){
            console.log(team_members_id);
        }

        $.ajax({
           type:'POST',
           url:"{{ route('searchnamebyid') }}",
           data:{team_members_id:team_members_id},
           success:function(data){
               $('#partnernamedata').remove();
               $( "<div id='partnernamedata' class='mt-1'>"+data+"</div>" ).insertAfter( "#team_members_id" );

              console.log(data);
           }
        });
        
        
  
    });
</script>



    
    
    @yield('javascript')
    <script src="//instant.page/5.1.0" type="module" integrity="sha384-by67kQnR+pyfy8yWP4kPO12fHKRLHZPfEsiSXR8u2IKcTdxD805MGUXBzVPnkLHw"></script>
  </body>
</html>
