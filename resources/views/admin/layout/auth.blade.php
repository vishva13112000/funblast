<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fun Blast </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <link rel="stylesheet" href="{{ asset('assets/sweetalert/dist/sweetalert.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description"
    content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs."/>
    <meta name="keywords"
    content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive"/>
    <meta name="author" content="codedthemes"/>
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
    <!-- waves.css')}} -->
    <link rel="stylesheet" href="{{asset('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- scrollbar.css')}} -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}">
    <!-- am chart export.css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css')}}" type="text/css"
    media="all"/>
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        background-color: #fff !important;
        color: #000000 !important;
        /*padding: 8px 30px 8px 20px;*/
    }
</style>
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <img class="img-fluid" src="{{asset('assets/images/logof.png')}}" width=170px height=70px style="
                            margin-left: -18px;
                            height: 53px;
                            width: 215px;
                            " alt="Theme-Logo"/>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li class="header-search">
                              
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-red"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius"
                                            src="{{asset('assets/images/avatar-2.jpg')}}"
                                            alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">{{Auth::user()->name}}</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    
                                </ul>
                            </li>
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img src="{{asset('assets/images/avatar-4.jpg')}}" class="img-radius"
                                    alt="User-Profile-Image">
                                    <!--      <span>{{Auth::user()->name}}</span> -->
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                <!-- <li class="waves-effect waves-light">
                                    <a href="#!">
                                        <i class="ti-settings"></i> Settings
                                    </a>
                                </li> -->
<!--                                 <li class="waves-effect waves-light">
                                    <a href="user-pr#">
                                        <i class="ti-user"></i> Profile
                                    </a>
                                </li> -->
                               <!--  <li class="waves-effect waves-light">
                                    <a href="email-#">
                                        <i class="ti-email"></i> My Messages
                                    </a>
                                </li> -->
<!--                                 <li class="waves-effect waves-light">
                                    <a href="auth-lock-s#">
                                        <i class="ti-lock"></i> Lock Screen
                                    </a>
                                </li> -->
                              <!--   <li class="waves-effect waves-light">
                                    <a href="auth-normal-si#">
                                        <i class="ti-layout-sidebar-left"></i> Logout
                                    </a>
                                </li> -->
                                <li class="waves-effect waves-light">
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> <i class="ti-layout-sidebar-left"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                                    <!-- return redirect(route('login'));
                                                    -->                                             </form>


                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>

                        <div class="pcoded-main-container">
                            <div class="pcoded-wrapper">
                                <nav class="pcoded-navbar">
                                    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                                    <div class="pcoded-inner-navbar main-menu">
                                        <div class="">
                                            <div class="main-menu-header">
                                                <img class="img-80 img-radius" src="{{asset('assets/images/avatar-4.jpg')}}"
                                                alt="User-Profile-Image">
                                                <div class="user-details">
                                                    <span id="more-details">{{Auth::user()->name}}</span>
                                                </div>
                                            </div>

                           <!--  <div class="main-menu-content">
                                <ul>
                                    <li class="more-details">
                                        <a href="user-pr#"><i class="ti-user"></i>View Profile</a>
                                        <a href="#!"><i class="ti-settings"></i>Settings</a>
                                        <a href="auth-normal-si#"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                        <div class="p-15 p-b-0">
                            <form class="form-material">
                                {{--                                <div class="form-group form-primary">--}}
                                    {{--                                    <input type="text" name="footer-email" class="form-control" required="">--}}
                                    {{--                                    <span class="form-bar"></span>--}}
                                    {{--                                    <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Friend</label>--}}
                                {{--                                </div>--}}
                            </form>
                        </div>

                        <!-- <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Shops</div> -->
                        <ul class="pcoded-item pcoded-left-item">

                            {{--                            <li class="pcoded-hasmenu">--}}
                                {{--                                <a href="javascript:void(0)" class="waves-effect waves-dark">--}}
                                    {{--                                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>--}}
                                    {{--                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Shops</span>--}}
                                    {{--                                    <span class="pcoded-mcaret"></span>--}}
                                {{--                                </a>--}}
                                {{--                                <ul class="pcoded-submenu">--}}
                                    {{--                                    <li class=" ">--}}
                                        {{--                                        <a href="{{route('admin.shops.index')}}" class="waves-effect waves-dark">--}}
                                            {{--                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                            {{--                                            <span class="pcoded-mtext"--}}
                                            {{--                                                  data-i18n="nav.basic-components.alert">Manage Shops</span>--}}
                                            {{--                                            <span class="pcoded-mcaret"></span>--}}
                                        {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class=" ">--}}
                                        {{--                                        <a href="{{route('admin.shops.subscriptions')}}" class="waves-effect waves-dark">--}}
                                            {{--                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                            {{--                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Manage Subscription</span>--}}
                                            {{--                                            <span class="pcoded-mcaret"></span>--}}
                                        {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class=" ">--}}
                                        {{--                                        <a href="sample#" class="waves-effect waves-dark">--}}
                                            {{--                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                            {{--                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Manage Delivery Man</span>--}}
                                            {{--                                            <span class="pcoded-mcaret"></span>--}}
                                        {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class=" ">--}}
                                        {{--                                        <a href="sample#" class="waves-effect waves-dark">--}}
                                            {{--                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                            {{--                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Manage Banner</span>--}}
                                            {{--                                            <span class="pcoded-mcaret"></span>--}}
                                        {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                {{--                                </ul>--}}
                            {{--                            </li>--}}



                            <li>
                                <a href="{{route('admin.customer.index')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext"
                                    data-i18n="nav.form-components.main">Customer History</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.branch.index')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext"
                                    data-i18n="nav.form-components.main">Branch History</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>


                            <li>
                                <a href="{{route('admin.ride.index')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext"
                                    data-i18n="nav.form-components.main">Ride Master</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>



                            <li>
                                <a href="#" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext"
                                    data-i18n="nav.form-components.main">Coupon Master</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>



                            <li>
                                <a href="{{route('admin.discount.index')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext"
                                    data-i18n="nav.form-components.main">Discount Master</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                            
                            
                            
                            {{--                            <li>--}}
                                {{--                                <a href="{{route('admin.brand.index')}}" class="waves-effect waves-dark">--}}
                                    {{--                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>--}}
                                    {{--                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Manage Brand</span>--}}
                                    {{--                                    <span class="pcoded-mcaret"></span>--}}
                                {{--                                </a>--}}
                            {{--                            </li>--}}
                            {{--                            <li>--}}
                                {{--                                <a href="{{route('admin.subscription.index')}}" class="waves-effect waves-dark">--}}
                                    {{--                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>--}}
                                    {{--                                    <span class="pcoded-mtext"--}}
                                    {{--                                          data-i18n="nav.form-components.main">Manage Subscription</span>--}}
                                    {{--                                    <span class="pcoded-mcaret"></span>--}}
                                {{--                                </a>--}}
                            {{--                            </li>--}}
                            {{--                            <li class="pcoded-hasmenu">--}}
                                {{--                                <a href="javascript:void(0)" class="waves-effect waves-dark">--}}
                                    {{--                                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>--}}
                                    {{--                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Pages</span>--}}
                                    {{--                                    <span class="pcoded-mcaret"></span>--}}
                                {{--                                </a>--}}
                                {{--                                <ul class="pcoded-submenu">--}}
                                    {{--                                    <li class=" ">--}}
                                        {{--                                        <a href="auth-normal-si#" class="waves-effect waves-dark">--}}
                                            {{--                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                            {{--                                            <span class="pcoded-mtext"--}}
                                            {{--                                                  data-i18n="nav.basic-components.alert">Login</span>--}}
                                            {{--                                            <span class="pcoded-mcaret"></span>--}}
                                        {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class=" ">--}}
                                        {{--                                        <a href="auth-si#" class="waves-effect waves-dark">--}}
                                            {{--                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                            {{--                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Register</span>--}}
                                            {{--                                            <span class="pcoded-mcaret"></span>--}}
                                        {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class=" ">--}}
                                        {{--                                        <a href="sample#" class="waves-effect waves-dark">--}}
                                            {{--                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                            {{--                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Sample Page</span>--}}
                                            {{--                                            <span class="pcoded-mcaret"></span>--}}
                                        {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                {{--                                </ul>--}}
                            {{--                            </li>--}}

                        </ul>


                    </div>
                </nav>
                <div class="pcoded-content">
                    <!-- Page-header start -->
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>

<![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>



    <script type="text/javascript" src="{{asset('assets/js/jquery-ui/jquery-ui.min.js')}} "></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/js/popper.js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap/js/bootstrap.min.js')}} "></script>
    <script type="text/javascript" src="{{asset('assets/pages/widget/excanvas.js')}} "></script>
    <!-- waves js -->

    <script src="{{ asset('assets/validate/validate.js')}}"></script>
    <script src="{{ asset('assets/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{asset('assets/pages/waves/js/waves.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript"
    src="{{asset('assets/js/jquery-slimscroll/jquery.slimscroll.js')}} "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('assets/js/modernizr/modernizr.js')}} "></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="{{asset('assets/js/SmoothScroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}} "></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{asset('assets/js/chart.js/Chart.js')}}"></script>
    <!-- amchart js -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    {{--<script src="{{asset('assets/pages/widget/amchart/gauge.js')}}"></script>--}}
    {{--<script src="{{asset('assets/pages/widget/amchart/serial.js')}}"></script>--}}
    {{--<script src="{{asset('assets/pages/widget/amchart/light.js')}}"></script>--}}
    {{--<script src="{{asset('assets/pages/widget/amchart/pie.min.js')}}"></script>--}}
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <!-- menu js -->
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>
    <script src="{{asset('assets/js/vertical-layout.min.js')}} "></script>
    <!-- custom js -->
    {{--<script type="text/javascript" src="{{asset('assets/pages/dashboard/custom-dashboard.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('assets/js/script.js')}}"></script>

    @stack('custom-scripts')
</body>

</html>
