@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            @cannot('see-task', $task)
                <div class="col-md-12">
                    <div class="alert alert-danger">You can not see this Task because it belongs to another user.</div>
                </div>
            @endcannot

            @can('see-task', $task)
                <div class="col-md-12">
                    @if(isset($task) && old() && count($errors) == 0)
                        <div class="alert alert-success">Task successfully updated.</div>
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
                            <i class="fa fa-edit"></i> Edit
                        </div>

                        <div class="panel-body">
                            {{  Form::open(array('url' => 'task/update' , 'method' => 'post')) }}
                            {{  Form::token()}}

                            @if(isset($task))
                                {{Form::hidden('id',$task->id,['class' => 'form-control'])}}
                            @endif

                            <div class="form-group">
                                {{Form::label('name', 'Name', ['class' => 'awesome'])}}
                                {{Form::text('name', $task->name,['class' => 'form-control'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('description', 'Description')}}
                                {{Form::textarea('description', $task->description,['class' => 'form-control'])}}
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
                                {{Form::label('author', 'Author')}}
                                <p>{{$task->user->email}}</p>
                            </div>
                            <div class="form-group">
                                {{Form::label('created_at', 'Created at')}}
                                <p>{{$task->created_at->format('m/d/Y')}}</p>
                                <p>{{$task->created_at->format('H:i:s')}}</p>

                            </div>
                            <div class="form-group">
                                {{Form::label('updated_at', 'Updated at')}}
                                <p>{{$task->updated_at->format('m/d/Y')}}</p>
                                <p>{{$task->updated_at->format('H:i:s')}}</p>
                            </div>
                            <div class="form-group">
                                {{Form::label('state', 'State')}}
                                <p style="font-size:18px;">
                                    @if ($task->state == "new")
                                        <span class="label label-primary">New Task </span>
                                    @elseif ($task->state == "in-progress")
                                        <span class="label label-warning">In Progress </span>
                                    @else
                                        <span class="label label-success">Finished </span>
                                    @endif
                                </p>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
