<div class="navbar-collapse nav nav-tabs justify-content-center" id="">
    <ul class="nav navigate main_menu">
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : ''}}"  href="{{ route('home') }}">Home</a></li>
        <li class="nav-item  "><a class="nav-link {{ Route::currentRouteNamed('files') ? 'active' : ''}}"  href="">Files</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('opportunities') ? 'active' : ''}}"  href="">Opportunities</a></li>
        <li class="nav-item "><a class="nav-link {{ (Route::currentRouteNamed('company-organizations') || Route::currentRouteNamed('edit-company-organization')) ? 'active' : ''}} "  href="{{ route('company-organizations') }}">Companies & Organisation</a></li>
        <li class="nav-item "><a  class="nav-link {{ (Route::currentRouteNamed('contacts') || Route::currentRouteNamed('edit_contact')) ? 'active' : ''}}" href="{{ route('contacts') }}">Contacts</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('leads') ? 'active' : ''}}"  href="">Leads</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('companies') ? 'active' : ''}}"  href="{{ route('companies') }}">Companies</a></li>
        <li class="nav-item "><a class="nav-link {{ Route::currentRouteNamed('dashboards') ? 'active' : ''}}"  href="">Dashboards</a></li>
       </ul>
</div>
