@extends ('layouts.app')
@section ('title')
Headquarter Supplier List
@endsection
@section ('p_title')
Supplier List
@endsection
@section ('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Supplier List</h3>

                    <div class="card-tools">
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @include("common.supplier.index", ["suppliers" => $suppliers])
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>

@endsection
@section ("js")
@endsection
