<script data-turbolinks-eval="false" data-turbolinks="false">
    $(document).ready( function() {
        @if(Session::has('notice'))
            toastr["warning"]('{!! Session::get('notice') !!}');
        @endif

        @if(Session::has('success'))
            toastr["success"]('{!! Session::get('success') !!}');
        @endif
        @if(Session::has('status'))
            toastr["info"]('{!! Session::get('status') !!}');
        @endif

        @if(Session::has('error'))
            toastr["error"]('{!! Session::get('error') !!}');
        @endif
    });
</script>
