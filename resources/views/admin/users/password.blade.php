@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Change Password')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Change Password</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Password Change Form
                </div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'PATCH',
                        'url' => 'admin/reset_password',
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include('admin.layouts.alert')

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                        {!! Form::label('password', trans('password.password'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::password('password', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                        {!! Form::label('new_password', trans('password.new_password'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::password('new_password', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : ''}}">
                        {!! Form::label('new_password_confirmation', trans('password.new_password_confirmation'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::password('new_password_confirmation', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection