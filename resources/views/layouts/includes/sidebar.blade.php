<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("dashboard")}}" class="brand-link navbar-success">
        <img src="{{asset("images/tea_logo.jpg")}}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("images/man-dark-avatar.jpg")}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-center">{{auth()->user()->name}}<br />(<strong>{{ucwords(auth()->user()->role)}}</strong>)</a>
            </div>
        </div>
        @if(auth()->user()->role === "admin")
        @include('layouts.includes.admin-sidebar')
        @elseif(auth()->user()->role === "headquarter")
        @include('layouts.includes.headquarter-sidebar')
        @endif
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
