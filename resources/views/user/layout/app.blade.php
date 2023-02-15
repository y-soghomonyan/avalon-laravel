@include('user.layout.header')
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex flex-column pb-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Avalon
                </a>
                <div class="dropdown" style="z-index: 9999999">
                    <div  class=" dropdown-toggle dropdown-menu-left" data-toggle="dropdown" style="cursor: pointer">
                        <img src="{{ Auth::user()->avatarUrl }}" style="height: 25px; width: 25px; object-fit:cover;" class="rounded-circle" id="header__user_avatar">
                        <span class="text-center">{{ Auth::user()->first_name }}</span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-start dropdown-menu-left drop_logout">
                       
                        <a class="dropdown-item" href="{{ route('profile') }}">  <input class="btn " type="button" value="Profile"></a>
                        <a class="dropdown-item" href="#">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                @csrf
                                <input class="btn " type="submit" value="Logout">
                            </form>
                        </a>
                            <div  class="dropdown-submenu dropdown-item"  style="cursor: pointer">
                                <a class="nav-link {{ Route::currentRouteNamed('settings') ? 'active' : ''}}" href="">Settings</a>
                                <div class="dropdown-menu  drop_settings">
                                    <a class="dropdown-item {{ (Route::currentRouteNamed('address_providers')) ? 'active_item' : ''}}"  href="{{ route('address_providers') }}"><span>Address Providers</span></a>
                                    <a class="dropdown-item {{ (Route::currentRouteNamed('addresses') || Route::currentRouteNamed('edit_address')) ? 'active_item' : ''}}"  href="{{ route('addresses') }}"><span>Business Addresses</span> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="container mt-3">
                @include('user.menu.menu')
            </div>
        </nav>
        <main class="py-4">
            <div class="container-fluid">
                <div class="container mt-5">
                    @include('messages')
                </div>
                @yield('contents')
            </div>
        </main>
   
@include('user.layout.footer')

<script>
    $(document).ready(function() {
        $('.select2').parent().find('.select2-container').addClass('select_span_style')
    });

</script>