<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{route("factory.dashboard")}}"
                class="nav-link {{ (request()->is('factory/dashboard*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("factory.offer.index")}}"
                class="nav-link {{ (request()->is('factory/reports/vendor-offers')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                    Vendor Offer
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("factory.offer.summary-report")}}"
                class="nav-link {{ (request()->is('factory/reports/summary-report')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                    Summary Report
                </p>
            </a>
        </li>
    </ul>
</nav>
