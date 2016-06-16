@extends('admin.layouts.app')

{{-- Page title --}}
@section('title')
    Edit {{ $article->title }}
    @parent
@stop

@section('content')
<div class="container">

    <h1>Edit Article {{ $article->title }}</h1>

    {!! Form::model($article, [
        'method' => 'PATCH',
        'url' => ['/admin/articles', $article->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : ''}}">
                {!! Form::label('subject_id', trans('articles.subject_id'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('subject_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title', trans('articles.title'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sub_title') ? 'has-error' : ''}}">
                {!! Form::label('sub_title', trans('articles.sub_title'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('sub_title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('sub_title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('summary') ? 'has-error' : ''}}">
                {!! Form::label('summary', trans('articles.summary'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('summary', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('summary', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('detailse') ? 'has-error' : ''}}">
                {!! Form::label('detailse', trans('articles.detailse'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('detailse', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('detailse', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection