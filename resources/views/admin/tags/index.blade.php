@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Tags List')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tags <a href="{{ url('/admin/tags/create') }}" class="btn btn-primary btn-xs"
                                            title="Add New Tag"><span
                            class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tags List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        @include('admin.layouts.alert')
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th> {{ trans('tags.name') }} </th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- */$x=0;/* --}}
                            @foreach($tags as $item)
                                {{-- */$x++;/* --}}
                                <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                                    <td>{{ $x }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ url('/admin/tags/' . $item->id . '/edit') }}"
                                           class="btn btn-primary btn-xs"
                                           title="Edit Tag"><span class="glyphicon glyphicon-pencil"
                                                                  aria-hidden="true"/></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/tags', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Tag" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete Tag',
                                                'onclick'=>'return confirm("Are you sure you want to delete ' . $item->name . '?")'
                                        ))!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection

@push('css')
{{-- DataTables CSS --}}
<link href="{{ asset('sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}"
      rel="stylesheet">
{{-- DataTables Responsive CSS --}}
<link href="{{ asset('sb-admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}"
      rel="stylesheet">
@endpush

@push('scripts')
{{-- DataTables JavaScript --}}
<script src="{{ asset('sb-admin/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
</script>
@endpush