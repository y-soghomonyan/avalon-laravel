<div class="navbar-collapse nav nav-tabs justify-content-center" id="">
    <ul class="nav navigate main_menu">
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : ''}}"  href="{{ route('home') }}">Home</a></li>
        <li class="nav-item  "><a class="nav-link {{ Route::currentRouteNamed('Files') ? 'active' : ''}}"  href="">Files</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('opportunities') ? 'active' : ''}}"  href="">Opportunities</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('companies') || Route::currentRouteNamed('edit_company')) ? 'active' : ''}} "  href="{{ route('companies') }}">Companies & Organisation</a></li>
        <li class="nav-item "><a  class="nav-link {{ (Route::currentRouteNamed('contacts') || Route::currentRouteNamed('edit_contact')) ? 'active' : ''}}" href="{{ route('contacts') }}">Contacts</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('leads') ? 'active' : ''}}"  href="">Leads</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('dashboards') ? 'active' : ''}}"  href="">Dashboards</a></li>
       </ul>
</div>
