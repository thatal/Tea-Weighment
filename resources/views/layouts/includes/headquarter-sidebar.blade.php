<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{route("headquarter.dashboard")}}"
                class="nav-link {{ (request()->is('headquarter/dashboard*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("headquarter.factory.index")}}"
                class="nav-link {{ (request()->is('headquarter/factory*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-industry"></i>
                <p>
                    Factories
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("headquarter.offer.index")}}"
                class="nav-link {{ (request()->is('headquarter/reports/vendor-offers')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                    Supplier Offer
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("headquarter.offer.summary-report")}}"
                class="nav-link {{ (request()->is('headquarter/reports/summary-report')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                    Summary Report
                </p>
            </a>
        </li>
    </ul>
</nav>
