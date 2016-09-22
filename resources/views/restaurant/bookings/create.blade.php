@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Create New Booking</h1>
    <hr/>
    @include('layouts.messages')
    {!! Form::open(['url' => '/bookings', 'class' => 'form-horizontal', 'files' => true]) !!}

    <div class="form-group {{ $errors->has('restaurant_id') ? 'has-error' : ''}}">
        {!! Form::label('restaurant_id', 'Restaurant Id', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('restaurant_id', null, ['class' => 'form-control']) !!}
            {!! $errors->first('restaurant_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('people_count') ? 'has-error' : ''}}">
        {!! Form::label('people_count', 'People Count', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('people_count', null, ['class' => 'form-control']) !!}
            {!! $errors->first('people_count', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
        {!! Form::label('date', 'Date', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('date', null, ['class' => 'form-control']) !!}
            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
        {!! Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('status', null, ['class' => 'form-control']) !!}
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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