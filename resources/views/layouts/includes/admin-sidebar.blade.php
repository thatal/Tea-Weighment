
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{route("admin.dashboard")}}" class="nav-link {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("admin.vehicle.index")}}" class="nav-link {{ (request()->is('admin/vehicle*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tractor"></i>
                <p>
                    Vehicle Types
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("admin.headquarter.index")}}" class="nav-link {{ (request()->is('admin/headquarter*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-industry"></i>
                <p>
                    Headquarters
                </p>
            </a>
        </li>
        {{-- <li class="nav-item has-treeview {{request()->is("admin/reports/vendor-offers*") ? "menu-open" : ""}}">
            <a href="#" class="nav-link {{request()->is("admin/reports/vendor-offers*") ? "active" : ""}}">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Suppliers</p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="{{route("admin.reports.vendor-offer.index")}}" class="nav-link {{request()->is("admin/reports/vendor-offers") ? "active" : ""}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Vendo Offers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Factories</p>
                    </a>
                </li>
            </ul>
        </li> --}}
    </ul>
</nav>
