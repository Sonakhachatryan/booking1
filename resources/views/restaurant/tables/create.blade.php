@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Create New Table</h1>
    <hr/>
    @include('layouts.messages')
    {!! Form::open(['url' => '/admin/restaurant/tables', 'class' => 'form-horizontal', 'files' => true]) !!}

    <div class="form-group {{ $errors->has('people_count') ? 'has-error' : ''}}">
        {!! Form::label('people_count', 'People Count', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('people_count', null, ['class' => 'form-control']) !!}
            {!! $errors->first('people_count', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('count') ? 'has-error' : ''}}">
        {!! Form::label('count', 'Count', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('count', null, ['class' => 'form-control']) !!}
            {!! $errors->first('count', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
        {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('price', null, ['class' => 'form-control','step' => "any"]) !!}
            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    {{--</div>--}}
@endsection