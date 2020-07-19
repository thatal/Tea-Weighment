@extends ('layouts.app')
@section ('title')
Headquarter Fine Leaf Count Table
@endsection
@section ('p_title')
Fine Leaf Count Table
@endsection
@section ('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daily Fine Leaf Price Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            {{-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> --}}


                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 pr-5 pl-5">
                            {!! Form::open(["route" =>"headquarter.fine-leaf.create"]) !!}
                            @include("headquarter.factory.form")
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6">
                            <div id="load-data">
                                <h3>Loading ...</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section ("js")
<script>
    $(document).ready(function () {
        loadAjaxData();
    });
    loadAjaxData = function () {
        var url = '{{ route("headquarter.fine-leaf.ajax-data") }}';
        var xhr = $.get(url);
        xhr.done(function (response) {
                $("#load-data").html(response);
                toastr["success"]("Data refreshed.");
            })
            .fail(function () {
                toastr["error"]("Whoops! Something went wrong.");
            });
    }
    editRecord = function (obj) {
        var $this = $(obj);
        console.log($this.data("record"))
        var $modal = $("#editModal");
        $modal.modal();
    }
    deleteRecord = function (obj) {
        if (!confirm("Are you sure ?")) {
            return false;
        }
        var $this = $(obj);
        console.log($this.data("record"))
    }

</script>
@endsection
