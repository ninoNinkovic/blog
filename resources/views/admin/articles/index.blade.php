@extends('admin.layouts.app')

{{-- Page title --}}
@section('title')
    Article List
    @parent
@stop

@section('content')
<div class="container">

    <h1>Articles <a href="{{ url('/admin/articles/create') }}" class="btn btn-primary btn-xs" title="Add New Article"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> {{ trans('articles.subject_id') }} </th><th> {{ trans('articles.title') }} </th><th> {{ trans('articles.sub_title') }} </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($articles as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->subject_id }}</td><td>{{ $item->title }}</td><td>{{ $item->sub_title }}</td>
                    <td>
                        <a href="{{ url('/admin/articles/' . $item->id) }}" class="btn btn-success btn-xs" title="View Article"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/articles/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/articles', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Article" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Article',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $articles->render() !!} </div>
    </div>

</div>
@endsection
