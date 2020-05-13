@if(auth()->user()->role == \App\Models\Admin::$role)
    @include('layouts.includes.admin-navbar')
@elseif(auth()->user()->role == \App\Models\Headquarter::$role)
    @include('layouts.includes.headquarter-navbar')
@elseif(auth()->user()->role == \App\Models\Factory::$role)
    @include('layouts.includes.factory-navbar')
@endif
