@extends('admin.layouts.app')

{{-- Page title --}}
@section('title')
    Tags List
    @parent
@stop

@section('content')
<div class="container">

    <h1>Tags <a href="{{ url('/admin/tags/create') }}" class="btn btn-primary btn-xs" title="Add New Tag"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> {{ trans('tags.name') }} </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($tags as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="{{ url('/admin/tags/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Tag"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/tags', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Tag" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Tag',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $tags->render() !!} </div>
    </div>

</div>
@endsection
