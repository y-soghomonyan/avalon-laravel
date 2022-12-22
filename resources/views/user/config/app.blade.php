@include('user.config.header')
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Avalon
                </a>
             
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                    @csrf
                    <input class="btn btn-danger" type="submit" value="loguot">
                </form>
                {{ Auth::user()->name }}
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include('user.menu.menu')
            </div>
         <div class="container-fluid">
             <div class="container mt-5">
                 @include('messages')
             </div>
             @yield('contents')
         </div>

           
    
        </main>
   
@include('user.config.footer')