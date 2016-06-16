@extends('admin.layouts.app')

{{-- Page title --}}
@section('title')
    Create New Article
    @parent
@stop

@section('content')
<div class="container">

    <h1>Create New Article</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/articles', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : ''}}">
                {!! Form::label('subject_id', trans('articles.subject_id'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('subject_id', $subjects, null, ['placeholder' => 'Select One ...', 'class' => 'form-control', 'required' => 'required']) !!}
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
            <div class="form-group {{ $errors->has('details') ? 'has-error' : ''}}">
                {!! Form::label('details', trans('articles.details'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('details', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('details', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('display') ? 'has-error' : ''}}">
                {!! Form::label('display', trans('articles.display'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <label class="radio-inline">
                        {{ Form::radio('display', 'Y', true) }} Yes
                    </label>
                    <label class="radio-inline">
                        {{ Form::radio('display', 'N') }} No
                    </label>
                    {!! $errors->first('display', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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