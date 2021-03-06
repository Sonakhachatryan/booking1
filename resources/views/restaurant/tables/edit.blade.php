@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Edit Table {{ $table->id }}</h1>
    @include('layouts.messages')
    {!! Form::model($table, [
        'method' => 'PATCH',
        'url' => ['/admin/restaurant/tables', $table->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

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
    <div class="form-group {{ $errors->has('available') ? 'has-error' : ''}}">
        {!! Form::label('available', 'Available', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('available', null, ['class' => 'form-control']) !!}
            {!! $errors->first('available', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
        {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('price', null, ['class' => 'form-control', 'step' =>'any']) !!}
            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}


    {{--</div>--}}
@endsection