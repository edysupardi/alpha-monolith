@extends('layouts.master')
@section('title')
    @lang('title.permission')
@endsection
@section('css')
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')


<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">@lang('title.permission')</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tbl">
                        <thead>
                            <tr>
                                <th>@lang('title.name')</th>
                                <th>@lang('title.guard_name')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $v)
                                <tr>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->guard_name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(function(){
            $('#tbl').DataTable();
        })
    </script>
@endsection
