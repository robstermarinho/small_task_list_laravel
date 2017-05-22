@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @if(session('msg'))
                <div class="col-md-12 ">
                    <div class="alert alert-info">{{session('msg')}}</div>
                </div>
            @endif

            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-8">
                                <h4><i class="fa  fa-list-alt"></i> List of Tasks</h4>
                            </div>
                            <div class="col-md-4">

                                <div class="row">

                                    <div class="col-md-5">

                                    </div>
                                    <div class="col-md-3">
                                        <div style="margin-top:3px;"  class="pull-right btn-group btn-block">
                                            <button type="button" class="btn_export btn btn-default pull-right  dropdown-toggle" data-toggle="dropdown">
                                                Export <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="task/task_table_cvs" class="export_format" href="#"><i class="fa fa-file-excel-o"></i> CVS</a>
                                                </li>

                                                <li>
                                                    <a href="task/task_table_xml" class="export_format" href="#"><i class="fa fa-file-code-o"></i> XML</a>
                                                </li>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <a style="margin-top:3px;" href="{{url('task/add')}}" class="pull-right btn btn-default">
                                                New Task <i class="fa fa-plus-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Author</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>State</th>
                                    <th>Created in</th>
                                    <th>Last Update</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $key => $task)
                                    @if ($task->state == "new")
                                        <tr class="info table_line_status" data-task-id="{{$task->id}}">
                                        @elseif ($task->state == "in-progress")
                                            <tr class="warning table_line_status" data-task-id="{{$task->id}}">
                                            @else
                                                <tr class="success table_line_status" data-task-id="{{$task->id}}">
                                                @endif
                                                <td><b>{{$key + 1}}</b></td>
                                                <td>{{ $task->user['email']}}</td>
                                                <td>{{$task->name}}</td>
                                                <td>{{$task->description}}</td>
                                                <td>
                                                    <div class="btn-group btn-block">

                                                        @if ($task->state == "new")
                                                            <button type="button" data-task-id="{{$task->id}}" class="btn_status btn btn-block btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                New Task <span class="caret"></span>
                                                            </button>
                                                        @elseif ($task->state == "in-progress")
                                                            <button type="button" data-task-id="{{$task->id}}" class="btn_status btn btn-block btn-warning dropdown-toggle" data-toggle="dropdown">
                                                                In Progress <span class="caret"></span>
                                                            </button>
                                                        @else
                                                            <button type="button" data-task-id="{{$task->id}}" class="btn_status btn btn-block btn-success dropdown-toggle" data-toggle="dropdown">
                                                                Finished <span class="caret"></span>
                                                            </button>
                                                        @endif
                                                        <ul class="dropdown-menu" role="menu">

                                                            <li><a class="change_status" data-task-id="{{$task->id}}" data-actual-state="{{$task->state}}" data-state-change="in-progress" href="#">In Progress</a></li>
                                                            <li><a class="change_status" data-task-id="{{$task->id}}" data-actual-state="{{$task->state}}" data-state-change="success" href="#">Finished</a></li>
                                                        </ul>
                                                    </div>

                                                </td>
                                                <td>{{$task->created_at->format('m/d/Y')}}</td>
                                                <td class="updated_at_field" data-task-id="{{$task->id}}">
                                                    {{$task->updated_at->diffForHumans()}}</td>
                                                    <td>
                                                        <a class="btn btn-default" href="/task/edit/{{$task->id}}"/>
                                                            <span class="fa fa-edit"></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a name="remove_levels" class="btn btn-danger" data-task-number="{{$key + 1}}" data-task-name="{{$task->name}}" data-url="/task/delete/{{$task->id}}"/>
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

                                    <div id="confirm" class="modal fade modal_delete" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p class="text-info modal_delete_msg">Are you sure you want to delete this task?</p>
                                                    <div class="task_info">

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                                                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
