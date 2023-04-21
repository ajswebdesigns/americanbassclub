<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Fishing Tournament</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
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
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('dashboard/assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('publlic/dashboard/assets/media/favicons/apple-touch-icon-180x180.png')}}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{asset('dashboard/assets/css/dashmix.min.css')}}">
    <!--Editor-->
    <!--<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">-->
    @yield('css')
    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/xwork.min.css"> -->
    <!-- END Stylesheets -->
    

    <!-- include summernote css/js -->
    <link href="{{asset( '/assets/summernote/summernote.min.css') }}" rel="stylesheet">
   

</head>

<body>
    
    <!-- Page Container -->
    <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-dark'                              Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header


        Footer

            ''                                          Static Footer if no class is added
            'page-footer-fixed'                         Fixed Footer (please have in mind that the footer has a specific height when is fixed)

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-dark'                          Dark themed Header
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-dark'         Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed  main-content-narrow">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header - Close Side Overlay -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="content-header bg-body-light justify-content-center text-danger" data-toggle="layout" data-action="side_overlay_close" href="javascript:void(0)">
                <i class="fa fa-2x fa-times-circle"></i>
            </a>
            <!-- END Side Header - Close Side Overlay -->


        </aside>
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        <!--
                Sidebar Mini Mode - Display Helper classes

                Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

                Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
                Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
                Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
            -->
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header (mini Sidebar mode) -->
            <div class="smini-visible-block">
                <div class="content-header">
                    <!-- Logo -->
                    <a class="font-w600 text-white tracking-wide" href="index.html">
                        D<span class="opacity-75">x</span>
                    </a>
                    <!-- END Logo -->
                </div>
            </div>
            <!-- END Side Header (mini Sidebar mode) -->

            <!-- Side Header (normal Sidebar mode) -->
            <div class="smini-hidden">
                <div class="content-header justify-content-lg-center">
                    <!-- Logo -->
                    <a class="font-w600 text-white tracking-wide" href="{{url('/')}}">
                        Fish<span class="opacity-75">ing</span>
                        <span class="font-w400">Tournament</span>
                    </a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div class="d-lg-none">
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                            <i class="fa fa-times-circle"></i>
                        </a>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
            </div>
            <!-- END Side Header (normal Sidebar mode) -->

            <!-- Sidebar Scrolling -->
            <div class="js-sidebar-scroll">
                <!-- Side Actions -->
                <!--<div class="content-side content-side-full bg-black-10 text-center">
                        <div class="smini-hide">
                            <button type="button" class="btn btn-sm btn-secondary">
                                <i class="fa fa-fw fa-user-circle"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary">
                                <i class="fa fa-fw fa-file-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary">
                                <i class="fa fa-fw fa-envelope"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary">
                                <i class="fa fa-fw fa-cog"></i>
                            </button>
                        </div>
                    </div>-->
                <!-- END Side Actions -->

                <!-- Side Navigation -->
                <div class="content-side">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link active" href="{{url('/home')}}">
                                <i class="nav-main-link-icon fa fa-chart-bar"></i>
                                <span class="nav-main-link-name">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-main-heading">Manage</li>
                       
                                               @if(Auth::user()->role == 'admin')

                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon fa fa-briefcase"></i>
                                <span class="nav-main-link-name">Tournaments</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/tournaments/add')}}">
                                        <i class="nav-main-link-icon fa fa-plus"></i>
                                        <span class="nav-main-link-name">New</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/tournaments/view')}}">
                                        <i class="nav-main-link-icon fa fa-pencil-alt"></i>
                                        <span class="nav-main-link-name">Manage</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">Members</span>
                            </a>
                            <ul class="nav-main-submenu">

                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/members/add')}}">
                                        <i class="nav-main-link-icon fa fa-plus"></i>
                                        <span class="nav-main-link-name">New</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/members/view')}}">
                                        <i class="nav-main-link-icon fa fa-pencil-alt"></i>
                                        <span class="nav-main-link-name">Manage</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                

                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">Members Benifits</span>
                            </a>
                            <ul class="nav-main-submenu">

                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{route('members.benifits.new')}}">
                                        <i class="nav-main-link-icon fa fa-plus"></i>
                                        <span class="nav-main-link-name">New</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{route('members.benifits')}}">
                                        <i class="nav-main-link-icon fa fa-pencil-alt"></i>
                                        <span class="nav-main-link-name">Manage</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
               

                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon fas fa-file-alt"></i>
                                <span class="nav-main-link-name">Page Management</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{route('page_management', 'about')}}">
                                        <i class="nav-main-link-icon fa fa-pencil-alt"></i>
                                        <span class="nav-main-link-name">About</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{route('page_management', 'rules')}}">
                                        <i class="nav-main-link-icon fa fa-pencil-alt"></i>
                                        <span class="nav-main-link-name">Qualifier Rules</span>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{url('/transactions')}}">
                                <i class="nav-main-link-icon fa fa-pencil-alt"></i>
                                <span class="nav-main-link-name">Transactions</span>
                            </a>
                        </li>   
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{url('/cheques')}}">
                                <i class="nav-main-link-icon fa fa-pencil-alt"></i>
                                <span class="nav-main-link-name">Checks</span>
                            </a>
                        </li>                
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('backend.admin.all.inbox')}}">
                                <i class="nav-main-link-icon fa fa-inbox"></i>
                                <span class="nav-main-link-name">Inbox</span>
          <span class="badge badge-warning navbar-badge"> {{ DB::table('contactuses')->where('read_status', 0)->count() }}  </span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon fa fa-cog"></i>
                                <span class="nav-main-link-name">Settings</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/settings/header/carousels')}}">
                                        <i class="nav-main-link-icon fa fa-image"></i>
                                        <span class="nav-main-link-name">Header Carousel</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/settings/sponser/carousels')}}">
                                        <i class="nav-main-link-icon fa fa-images"></i>
                                        <span class="nav-main-link-name">Sponsers Carousel</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    

                        @if(Auth::user()->role != 'admin')
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{route('MyTournaments')}}">
                                        <i class="nav-main-link-icon fa fa-trophy"></i>
                                        <span class="nav-main-link-name">My Tournaments</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/tournaments/participation')}}">
                                        <i class="nav-main-link-icon fa fa-trophy"></i>
                                        <span class="nav-main-link-name">Tournaments</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/tournaments/results/view')}}">
                                        <i class="nav-main-link-icon fa fa-medal"></i>
                                        <span class="nav-main-link-name">Results</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{route('member.benifits.dashboard')}}">
                                        <i class="nav-main-link-icon fa fa-user"></i>
                                        <span class="nav-main-link-name">Member Benefits</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{route('user.membership')}}">
                                        <i class="nav-main-link-icon fa fa-user"></i>
                                        <span class="nav-main-link-name">Membership</span>
                                    </a>
                                </li>
                                {{--<li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/subscripton/plans')}}">
                                        <i class="nav-main-link-icon fa fa-user-check"></i>
                                        <span class="nav-main-link-name">Subscription</span>
                                    </a>
                                </li>--}}
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{url('/member/document/view')}}">
                                        <i class="nav-main-link-icon fa fa-file-signature"></i>
                                        <span class="nav-main-link-name">Documents</span>
                                    </a>
                                </li>
                                
                                @endif
                        <!--<li class="nav-main-item">
                                <a class="nav-main-link" href="">
                                    <i class="nav-main-link-icon fa fa-house-user"></i>
                                    <span class="nav-main-link-name">Profile</span>
                                    <span class="nav-main-link-badge badge badge-pill badge-primary">4</span>
                                </a>
                            </li>-->
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- END Sidebar Scrolling -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div>
                    <button type="button" class="btn btn-dual" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div>


                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-fw fa-user-circle"></i>
                            <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                            <div class="bg-primary rounded-top font-w600 text-white text-center p-3">
                                <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{asset('dashboard/assets/media/avatars/avatar10.jpg')}}" alt="">
                                <div class="pt-2">
                                    <a class="text-white font-w600" href="javascript:;">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>
                                </div>
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item" href="{{url('/member/profile/edit')}}/{{Auth::user()->id}}">
                                    <i class="far fa-fw fa-user mr-1"></i> Profile
                                </a>

                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('/logout')}}">
                                    <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Sign Out
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header bg-sidebar-dark">
                <div class="content-header">
                   
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary-darker">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-white">
            <div class="content py-0">
                <div class="row font-size-sm">
                    <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                        Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://ajswebdesigns.com" target="_blank">Ajs Web Designs</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                        <a class="font-w600" href="{{url('/')}}" target="_blank">FishingTournament 1.0</a> &copy; <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!--
            Dashmix JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out assets/_js/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            assets/js/core/jquery.min.js
            assets/js/core/bootstrap.bundle.min.js
            assets/js/core/simplebar.min.js
            assets/js/core/jquery-scrollLock.min.js
            assets/js/core/jquery.appear.min.js
            assets/js/core/js.cookie.min.js
        -->
    <script src="{{asset('dashboard/assets/js/dashmix.core.min.js')}}"></script>

    <!--
            Dashmix JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_js/main/app.js
        -->
    <script src="{{asset('dashboard/assets/js/dashmix.app.min.js')}}"></script>

    <!-- Page JS Plugins -->
    <script src="{{asset('dashboard/assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
            
            
            $('input:radio[name="team_limit_type"]').change(
            function(){
                if ($(this).is(':checked') && $(this).val() == '1') {
                     $('#team_limit').prop('disabled', true);
                     $('#team_limit').val(9999);
                     $('#team_limit').hide();

                }else{
                     $('#team_limit').prop('disabled', false);
                     $('#team_limit').val(800);
                     $('#team_limit').show();

                }
            });

            
            if ($('input:radio[name="team_limit_type"]').is(':checked') && $('input:radio[name="team_limit_type"]').val() == 1){
                $('#team_limit').val(9999);
                $('#team_limit').prop('disabled', true);
                $('#team_limit').hide();
                
    
            }else{
                $('#team_limit').prop('disabled', false);
                $('#team_limit').val(800);
                $('#team_limit').show();

            }
            
            if($("#teamlimitunlimited").is(':checked')){
                $('#team_limit').val(9999);
                $('#team_limit').prop('disabled', true);
                $('#team_limit').hide();

            }else{
                $('#team_limit').show();

            }
            
            
    });
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
    <!-- Page JS Helpers (jQuery Sparkline plugin) -->
    <script>
        jQuery(function() {
            Dashmix.helpers('sparkline');
        });
    </script>
    <!--<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>-->
     <script src="{{asset( '/assets/summernote/summernote.min.js') }}"></script>
     <script>
         $(document).ready(function() {
              $('.summernote').summernote({
                    placeholder: 'Please write your content from here',
                    tabsize: 2,
                    height: 500
                  });
            });
            
     </script>
</body>

</html>