@extends('admin.layouts.app')

{{-- Page title --}}
@section('title')
    {{ $user->name }}
    @parent
@stop

@section('content')
<div class="container">

    <h1>User {{ $user->name }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID.</th><td>{{ $user->id }}</td>
                </tr>
                <tr><th> {{ trans('users.name') }} </th><td> {{ $user->name }} </td></tr><tr><th> {{ trans('users.email') }} </th><td> {{ $user->email }} </td></tr><tr><th> {{ trans('users.user_type_id') }} </th><td> {{ $user->user_type_id }} </td></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['users', $user->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete User',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
@endsection