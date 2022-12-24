@include('user.layout.header')
<style>
    .select_span_style {
        width: 100%!important;
        height: 100%!important;
    }
    .select_span_style span {
        height: 37px!important;
    }
</style>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex flex-column pb-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Avalon
                </a>
                <div class="dropdown">
                    <div  class=" dropdown-toggle dropdown-menu-left" data-toggle="dropdown" style="cursor: pointer">
                        <img src="{{ Auth::user()->avatarUrl }}" style="height: 25px; width: 25px; ">
                       </div>
                    <div class="dropdown-menu dropdown-menu-start dropdown-menu-left drop_logout">
                        <p class="text-center">{{ Auth::user()->name }}</p>
                        <a class="dropdown-item" href="#">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                @csrf
                                <input class="btn btn-link" type="submit" value="Logout">
                            </form></a>
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

<style>
    /*.nav-profile{*/
        /*position: relative;*/
    /*}*/
    /*.logout-container{*/
        /*width: 100%;*/
        /*position: absolute;*/
        /*display: none;*/
    /*}*/
    /*.logout-container.active{*/
        /*display: flex;*/
        /*justify-content: flex-end;*/
    /*}*/
</style>
<script>
    $(document).ready(function() {
        $('.select2').parent().find('.select2-container').addClass('select_span_style')

    });
    // $('.nav-profile').on('click', function(){
    //     $('.logout-container').toggleClass('active');
    // })
</script>