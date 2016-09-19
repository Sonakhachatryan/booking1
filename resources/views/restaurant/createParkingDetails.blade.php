@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}
    @include('layouts.messages')
    <h1>Create New Cinema</h1>
    <hr/>

    {!! Form::open([
    'method' => 'post',
    'url' => '/admin/restaurant/parking-details/create',
    'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
        {!! Form::label('duration', 'Duration', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('duration', null, ['class' => 'form-control']) !!}
            {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
        {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('price', null, ['class' => 'form-control']) !!}
            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('count') ? 'has-error' : ''}}">
        {!! Form::label('count', 'Count', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('count', null, ['class' => 'form-control']) !!}
            {!! $errors->first('count', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('available') ? 'has-error' : ''}}">
        {!! Form::label('available', 'Available', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('available', null, ['class' => 'form-control']) !!}
            {!! $errors->first('available', '<p class="help-block">:message</p>') !!}
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
