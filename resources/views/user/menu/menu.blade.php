<style>
    /*.navigate{*/
        /*display: flex;*/
        /*align-items: center;*/
        /*justify-content: space-between;*/
        /*width: 100%;*/
    /*}*/
    /*.navigate li{*/
        /*margin-left: 10px;*/
        /*padding: 5px;*/
    /*}*/
    /*.navigate li.active{*/
        /*border-top: 3px solid #4798ff;*/
        /*!*background: lightblue;*!*/
    /*}*/
    /*.navigate li:first-child{*/
        /*padding-left: 0;*/
        /*margin-left: 0;*/
    /*}*/
    /*.navigate li a{*/
        /*text-decoration: none;*/
        /*color: #000000;*/
    /*}*/
</style>
<div class="navbar-collapse nav nav-tabs" id="">
        <ul class="nav navigate">
            <li class="nav-item  "><a class="nav-link {{ Route::currentRouteNamed('sales') ? 'active' : ''}}"  href="">Sales</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : ''}}"  href="{{ route('home') }}">Home</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('companies') ? 'active' : ''}} "  href="{{ route('companies') }}">Companies</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('leades') ? 'active' : ''}}"  href="">Leads</a></li>
            <li class="nav-item "><a  class="nav-link {{ Route::currentRouteNamed('contact') ? 'active' : ''}}" href="">Contact</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('opportunities') ? 'active' : ''}}"  href="">Opportunities</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('quotes') ? 'active' : ''}}"  href="">Quotes</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('campaigns') ? 'active' : ''}}"  href="">Campaigns</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('forecasts') ? 'active' : ''}}"  href="">Forecasts</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('reports') ? 'active' : ''}}"  href="">Reports</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('dashboards') ? 'active' : ''}}"  href="">Dashboards</a></li>
            <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('calendar') ? 'active' : ''}}"  href="">Calendar</a></li>
        </ul>
</div>
