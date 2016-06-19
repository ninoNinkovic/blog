@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Create New Tag')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create New Tag</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tag Form
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => '/admin/tags', 'class' => 'form-horizontal']) !!}

                    @include('admin.tags.form')

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