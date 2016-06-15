@extends('admin.layouts.app')

{{-- Page title --}}
@section('title')
    Subject List
    @parent
@stop

@section('content')
<div class="container">

    <h1>Subjects <a href="{{ url('/admin/subjects/create') }}" class="btn btn-primary btn-xs" title="Add New Subject"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> {{ trans('subjects.name') }} </th><th> {{ trans('subjects.description') }} </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($subjects as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->name }}</td><td>{{ $item->description }}</td>
                    <td>
                        <a href="{{ url('/admin/subjects/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Subject"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/subjects', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Subject" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Subject',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $subjects->render() !!} </div>
    </div>

</div>
@endsection
