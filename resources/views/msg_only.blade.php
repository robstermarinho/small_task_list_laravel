@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if (isset($warning))
                    <div class="alert alert-warning">
                        {{ $warning }}
                    </div>
                @endif
                @if (isset($danger))
                    <div class="alert alert-danger">
                        {{ $danger }}
                    </div>
                @endif
                @if (isset($info))
                    <div class="alert alert-info">
                        {{ $info }}
                    </div>
                @endif


            </div>
        </div>
    </div>
@endsection
