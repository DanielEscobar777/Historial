@extends('layouts.header')

@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>

        <div class="panel-body text-center">
                       <h2 class="panel-title text-center"><b> BIENVENIDO AL SISTEMA </b></h2>

              @auth
                        <h4 style="display: block; font-size: 15px; margin-top: 5px;">
                            {{ auth()->user()->name }}
</h4>
                        @endauth
        </div>

    </div>
</div>

@endsection
