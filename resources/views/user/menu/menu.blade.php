<div class=" navbar-collapse" id="">

        <ul class="nav navigate">
            <li class="{{ Route::currentRouteNamed('sales') ? 'active' : ''}} "><a href=""> Sales</a></li>
            <li class="{{ Route::currentRouteNamed('home') ? 'active' : ''}}"><a href="{{ route('home') }}"> Home</a></li>
            <li class="{{ Route::currentRouteNamed('accounts') ? 'active' : ''}} "><a href="{{ route('accounts') }}"> Accounts</a></li>
            <li class="{{ Route::currentRouteNamed('leades') ? 'active' : ''}}"><a href=""> Leads</a></li>
            <li class="{{ Route::currentRouteNamed('contact') ? 'active' : ''}}"><a href=""> Contact</a></li>
            <li class="{{ Route::currentRouteNamed('opportunities') ? 'active' : ''}}"><a href=""> Opportunities</a></li>
            <li class="{{ Route::currentRouteNamed('quotes') ? 'active' : ''}}"><a href=""> Quotes</a></li>
            <li class="{{ Route::currentRouteNamed('campaigns') ? 'active' : ''}}"><a href=""> Campaigns</a></li>
            <li class="{{ Route::currentRouteNamed('forecasts') ? 'active' : ''}}"><a href=""> Forecasts</a></li>
            <li class="{{ Route::currentRouteNamed('reports') ? 'active' : ''}}"><a href=""> Reports</a></li>
            <li class="{{ Route::currentRouteNamed('dashboards') ? 'active' : ''}}"><a href=""> Dashboards</a></li>
            <li class="{{ Route::currentRouteNamed('calendar') ? 'active' : ''}}"><a href=""> Calendar</a></li>
        </ul>
</div>
<style>
    .navigate{
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }
    .navigate li{
        margin-left: 10px;
        padding: 5px;
    }
    .navigate li.active{
        border-top: 3px solid #4798ff;
        background: lightblue;
    }
    .navigate li:first-child{
        padding-left: 0;
        margin-left: 0;
    }
    .navigate li a{
        text-decoration: none;
        color: #000000;
    }
</style>