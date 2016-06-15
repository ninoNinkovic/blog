@extends('admin.layouts.app')

{{-- Page title --}}
@section('title')
    Edit {{ $user->name }}
    @parent
@stop

@section('content')
<div class="container">

    <h1>Edit {{ $user->name }}</h1>

    {!! Form::model($user, [
        'method' => 'PATCH',
        'url' => ['/admin/users', $user->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', trans('users.name'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', trans('users.email'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('user_type_id') ? 'has-error' : ''}}">
                {!! Form::label('user_type_id', trans('users.user_type_id'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('user_type_id', $user_types, $user->user_type_id, ['placeholder' => 'Select One ...', 'class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('user_type_id', '<p class="help-block">:message</p>') !!}
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