@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @if(Auth::user()->role == "regular")
                <div class="col-md-12">
                    <div class="alert alert-danger">Your user have no permission to access this page.</div>
                </div>
            @else
                <div class="col-md-12">
                    @if(isset($user) && old() && count($errors) == 0)
                        <div class="alert alert-success">User successfully updated.</div>
                    @endif

                    @if(count($errors) > 0)
                        <div class="alert alert-danger" aria-hidden="true">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-edit"></i> Edit User
                        </div>

                        <div class="panel-body">
                            {{  Form::open(array('url' => 'users/update' , 'method' => 'post')) }}
                            {{  Form::token()}}

                            @if(isset($user))
                                {{Form::hidden('id', $user->id,['class' => 'form-control'])}}
                            @endif

                            <div class="form-group">
                                {{Form::label('first_name', 'First Name', ['class' => 'awesome'])}}
                                {{Form::text('first_name', $user->first_name, ['class' => 'form-control'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('last_name', 'Last Name')}}
                                {{Form::text('last_name', $user->last_name, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('email', 'Email')}}
                                {{Form::text('email', $user->email, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('role', 'Role')}}
                                {{Form::select('role', ['admin' => 'Admin', 'regular' => 'Regular'], $user->role ,['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::submit('Save',['class' => 'btn btn-primary'])}}
                            </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-info"></i> Info
                        </div>

                        <div class="panel-body">
                            {{  Form::open() }}
                            <div class="form-group">
                                {{Form::label('created_at', 'Created at')}}
                                <p>{{$user->created_at->format('m/d/Y')}}</p>
                                <p>{{$user->created_at->format('H:i:s')}}</p>
                            </div>
                            <div class="form-group">
                                {{Form::label('updated_at', 'Updated at')}}
                                <p>{{$user->updated_at->format('m/d/Y')}}</p>
                                <p>{{$user->updated_at->format('H:i:s')}}</p>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
