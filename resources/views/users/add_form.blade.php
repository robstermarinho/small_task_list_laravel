@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                        <i class="fa fa-plus-square"></i> New Task
                    </div>

                    <div class="panel-body">
                        {{  Form::open(array('url' => 'task/save', 'method' => 'post')) }}
                        {{  Form::token()}}

                        <div class="form-group">
                            {{Form::label('name', 'Name', ['class' => 'awesome'])}}
                            {{Form::text('name','',['class' => 'form-control'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('description', 'Description')}}
                            {{Form::textarea('description','',['class' => 'form-control'])}}
                        </div>

                        <div class="form-group">
                            {{Form::submit('Save',['class' => 'btn btn-primary'])}}
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
