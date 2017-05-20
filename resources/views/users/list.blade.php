@extends('layouts.app')

@section('content')
    
    @if(session('msg'))
        <div class="col-md-12 ">
            <div class="alert alert-info">{{session('msg')}}</div>
        </div>
    @endif
    @if(isset($msg))
        <div class="col-md-12 ">
            <div class="alert alert-danger">{{$msg}}</div>
        </div>
    @else
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <h4><i class="fa  fa-users"></i> List of Users</h4>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fisrt Name</th>
                                <th>Last Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th>Last Update</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td><b>{{$key + 1}}</b></td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at->format('m/d/Y')}}</td>
                                    <td>{{$user->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <a class="btn btn-default" href="/users/edit/{{$user->id}}"/>
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="/users/delete/{{$user->id}}"/>
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade modal_message" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Message</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="message_modal_content">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
