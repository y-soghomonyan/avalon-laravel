@include('user.layout.header')
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex flex-column pb-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Avalon
                </a>
                <div class="dropdown">
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