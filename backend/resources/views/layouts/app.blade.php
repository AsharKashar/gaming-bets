<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', ' Dashboard') }}</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black') }}/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('black') }}/css/nucleo-icons.css" rel="stylesheet"/>
    <!-- CSS -->
    <link href="{{ asset('black') }}/css/black-dashboard.css?v=1.0.0" rel="stylesheet"/>
    <link href="{{ asset('black') }}/css/theme.css" rel="stylesheet"/>
    <link href="{{ asset('black') }}/css/black-bracket.css" rel="stylesheet"/>
    <link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>
    <style>
        .bootstrap-datetimepicker-widget {
            opacity:    1 !important;
            visibility: visible !important;
        }

        .bootstrap-datetimepicker-widget * {
            color: #333;
        }

        .bootstrap-datetimepicker-widget .btn {
            background: transparent !important;
        }

        .bootstrap-datetimepicker-widget .btn:hover {
            background: transparent !important;
        }

        .errors {
            position:  fixed;
            max-width: 40vw;
            top:       5.4rem;
            right:     0;
            z-index:   5000;
        }

         select {
             background: #27293d !important;
         }

    </style>
</head>
<body class="{{ $class ?? '' }}">
@auth()
    <div class="wrapper">
        @include('layouts.navbars.sidebar')
        <div class="main-panel">
            @include('layouts.navbars.navbar')

            <div class="content">
                @yield('content')
            </div>

            @include('layouts.footer')
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@else
    @include('layouts.navbars.navbar')
    <div class="wrapper wrapper-full-page">
        <div class="full-page {{ $contentClass ?? '' }}">
            <div class="content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endauth


@if(isset($errors) && count($errors->all()))
    <div class="errors alert alert-dismissible fade show alert-danger" role="alert">
        @foreach($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(Session::has('msg'))

    <div class="errors alert alert-dismissible fade show alert-dark" role="alert">
        {!! Session::get('msg') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="fixed-plugin">
    <div class="dropdown show-dropdown">

        <ul class="dropdown-menu">
            <li class="header-title"> Sidebar Background</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors text-center">
                        <span class="badge filter badge-primary active" data-color="primary"></span>
                        <span class="badge filter badge-info" data-color="blue"></span>
                        <span class="badge filter badge-success" data-color="green"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="button-container">
                <a href="https://www.creative-tim.com/product/black-dashboard-laravel" target="_blank" class="btn btn-primary btn-block btn-round">Download Now</a>
                <a href="https://demos.creative-tim.com/black-dashboard/docs/1.0/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block btn-round">
                    Documentation
                </a>
                <a href="https://www.creative-tim.com/product/black-dashboard-pro-laravel" target="_blank" class="btn btn-danger btn-block btn-round">
                    Upgrade to PRO
                </a>
            </li>
            <li class="header-title">Thank you for 95 shares!</li>
            <li class="button-container text-center">
                <button id="twitter" class="btn btn-round btn-info"><i class="fab fa-twitter"></i> &middot; 45</button>
                <button id="facebook" class="btn btn-round btn-info"><i class="fab fa-facebook-f"></i> &middot; 50</button>
                <br>
                <br>
                <a class="github-button" href="https://github.com/creativetimofficial/black-dashboard-laravel" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
            </li>
        </ul>
    </div>
</div>
<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('black') }}/js/core/popper.min.js"></script>
<script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('black') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<!-- Place this tag in your head or just before your close body tag. -->
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
<!-- Chart JS -->
{{-- <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script> --}}
<!--  Notifications Plugin    -->
<script src="{{ asset('black') }}/js/plugins/bootstrap-notify.js"></script>

<script src="{{ asset('black') }}/js/black-dashboard.min.js?v=1.0.0"></script>
<script src="{{ asset('black') }}/js/theme.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/script.js') }}"></script>--}}
<script type="text/javascript">

$(document).ready(function(){

    $('[tool-tip-toggle="tooltip-demo"]').tooltip({

        placement : 'top'

    });

});

</script>

<script>
    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');
            $navbar = $('.navbar');
            $main_panel = $('.main-panel');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');
            sidebar_mini_active = true;
            white_color = false;

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            $('.fixed-plugin a').click(function (event) {
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .background-color span').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data', new_color);
                }

                if ($main_panel.length != 0) {
                    $main_panel.attr('data', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data', new_color);
                }
            });

            $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function () {
                var $btn = $(this);

                if (sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    sidebar_mini_active = false;
                    blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                } else {
                    $('body').addClass('sidebar-mini');
                    sidebar_mini_active = true;
                    blackDashboard.showSidebarMessage('Sidebar mini activated...');
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);
            });

            $('.switch-change-color input').on("switchChange.bootstrapSwitch", function () {
                var $btn = $(this);

                if (white_color == true) {
                    $('body').addClass('change-background');
                    setTimeout(function () {
                        $('body').removeClass('change-background');
                        $('body').removeClass('white-content');
                    }, 900);
                    white_color = false;
                } else {
                    $('body').addClass('change-background');
                    setTimeout(function () {
                        $('body').removeClass('change-background');
                        $('body').addClass('white-content');
                    }, 900);

                    white_color = true;
                }
            });

            $(".datepick").datetimepicker();
        });
    });

          $("input:checkbox").on('click', function() {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    if ($box.is(":checked")) {
      // the name of the box is retrieved using the .attr() method
      // as it is assumed and expected to be immutable
      var group = "input:checkbox[name='" + $box.attr("name") + "']";
      // the checked state of the group/box on the other hand will change
      // and the current value is retrieved using .prop() method
      $(group).prop("checked", false);
      $box.prop("checked", true);
    } else {
      $box.prop("checked", false);
    }
  });

</script>
<script>
    $('#select_box').change(function () {
var select=$(this).find(':selected').val();
 $(".hide").hide();
 $('#' + select).show();

	    }).change();
    </script>
@stack('js')
</body>
</html>
