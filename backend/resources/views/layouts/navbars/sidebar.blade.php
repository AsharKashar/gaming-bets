<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
{{--            <a href="#" class="simple-text logo-mini">{{ __('BD') }}</a>--}}
            <a href="#" class="simple-text logo-normal">  <img src="{{asset("assets/images/logo.png")}}" alt=""></a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            @if(auth()->user()->admin_type=="owner" || auth()->user()->admin_type=="lead")
            <li @if ($pageSlug == 'games') class="active " @endif>
                <a href="{{ route("pages.games") }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Games') }}</p>
                </a>
            </li>
            @endif

            @if(auth()->user()->admin_type=="owner" || auth()->user()->admin_type=="admin" || auth()->user()->admin_type=="lead")
            <li @if ($pageSlug == 'tournament') class="active " @endif>
                <a href="{{ route("pages.tournament") }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Tournament') }}</p>
                </a>
            </li>
            @endif

            @if(auth()->user()->admin_type=="owner" || auth()->user()->admin_type=="admin" || auth()->user()->admin_type=="lead")
            <li @if ($pageSlug == 'boxfights') class="active" @endif>
                <a href="{{ route("pages.boxfight") }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Box Fight') }}</p>
                </a>
            </li>
            @endif

            @if(auth()->user()->admin_type=="owner" || auth()->user()->admin_type=="admin" || auth()->user()->admin_type=="lead")
            <li @if ($pageSlug == 'brackets') class="active" @endif>
                <a href="{{ route("pages.bracket") }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Brackets') }}</p>
                </a>
            </li>
            @endif

            @if(auth()->user()->admin_type=="owner" || auth()->user()->admin_type=="admin" || auth()->user()->admin_type=="lead")
            <li @if ($pageSlug == 'post') class="active" @endif>
                <a href="{{ route("post.list") }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Post') }}</p>
                </a>
            </li>
            @endif

            @if(auth()->user()->admin_type=="owner" || auth()->user()->admin_type=="admin" || auth()->user()->admin_type=="lead")
            <li @if ($pageSlug == 'category') class="active" @endif>
                <a href="{{ route("categories.index") }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Categories') }}</p>
                </a>
            </li>
            @endif

            @if(auth()->user()->admin_type=="owner" || auth()->user()->admin_type=="admin" || auth()->user()->admin_type=="lead")
            <li @if ($pageSlug == 'issues') class="active" @endif>
                <a href="{{ route("issue.index") }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Reported Issues') }}</p>
                </a>
            </li>
            @endif
            {{--
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Laravel Examples') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>--}}

                        @if(auth()->user()->admin_type=="owner" || auth()->user()->admin_type=="admin" || auth()->user()->admin_type=="lead")
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('User Management') }}</p>
                            </a>
                        </li>
                        @endif
                        {{--</ul>
                </div>
            </li>
            <li @if ($pageSlug == 'icons') class="active " @endif>
                <a href="{{ route('pages.icons') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'maps') class="active " @endif>
                <a href="{{ route('pages.maps') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'notifications') class="active " @endif>
                <a href="{{ route('pages.notifications') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'tables') class="active " @endif>
                <a href="{{ route('pages.tables') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'typography') class="active " @endif>
                <a href="{{ route('pages.typography') }}">
                    <i class="tim-icons icon-align-center"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'rtl') class="active " @endif>
                <a href="{{ route('pages.rtl') }}">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'upgrade' ? 'active' : '' }}">
                <a href="{{ route('pages.upgrade') }}">
                    <i class="tim-icons icon-spaceship"></i>
                    <p>{{ __('Upgrade to PRO') }}</p>
                </a>
            </li>
            --}}
        </ul>
    </div>
</div>

<script>
    var role_user_id;
    var role;
    function openOverlay(id){
        $("#overlay").css("display", "block");
        $("#popupSelect").css("display", "block");
        role_user_id=id;
    }

    function closeOverlay(){
        $("#overlay").css("display", "none");
        $("#popupSelect").css("display", "none");
    }





</script>

