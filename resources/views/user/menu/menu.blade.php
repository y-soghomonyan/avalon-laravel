<div class="navbar-collapse nav nav-tabs justify-content-center" id="">
    <ul class="nav navigate main_menu">
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : ''}}"  href="{{ route('home') }}">Home</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('accounts') || Route::currentRouteNamed('edit_account')) ? 'active' : ''}} "  href="{{ route('accounts') }}">Accounts</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('contacts') || Route::currentRouteNamed('edit_contact')) ? 'active' : ''}}" href="{{ route('contacts') }}">Contacts</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('companies') || Route::currentRouteNamed('edit_company')) ? 'active' : ''}}"  href="{{ route('companies') }}">Companies</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('addresses') || Route::currentRouteNamed('edit_address')) ? 'active' : ''}}"  href="{{ route('addresses') }}"> Business Addresses</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('address_providers')) ? 'active' : ''}}"  href="{{ route('address_providers') }}">Address Providers</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('time-reporting') ? 'active' : ''}}"  href="">Time Reporting</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('invoicing') ? 'active' : ''}}"  href="">Invoicing</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('settings') ? 'active' : ''}}"  href="">Settings</a></li>
    </ul>
</div>
