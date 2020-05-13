{{-- bootstrp switch --}}
<script src="{{asset("assets/bootstrap-switch/js/bootstrap-switch.min.js")}}"></script>
<link rel="stylesheet" href="{{asset("assets/bootstrap-switch/css/bootstrap-switch.min.css")}}">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <input type="checkbox" id="checkbox_on_off" name="my-checkbox" {{\App\Services\CommonService::factory_information()->is_available ? "checked" : ""}} data-bootstrap-switch data-off-color="danger" data-on-color="success">
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                    class="fas fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<script>
    $(document).ready(function(){
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
        $("#checkbox_on_off").change(function(){
            var xhrAjax = $.get("/");
        });
        $('#checkbox_on_off').on('switchChange.bootstrapSwitch', function (e, data) {
            $("#checkbox_on_off").bootstrapSwitch('disabled', true);
            var url = '{{route("factory.switch-available")}}';
            var xhrAjax = $.get(url);
            xhrAjax.done(function(response){
                if(response.status){
                    toastr.success(response.message);
                }else{
                    toastr.error(response.message);
                }
            })
            .fail(function(){
                toastr.error("Whoops! something went wrong.");
            })
            .always(function(){
                $("#checkbox_on_off").bootstrapSwitch('disabled', false);
            })
        });
    });
</script>
