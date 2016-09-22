@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Table {{ $table->id }}
        <a href="{{ url('admin/restaurant/tables/' . $table->id . '/edit') }}" class="btn btn-primary btn-xs"
           title="Edit Table"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/restaurant/tables', $table->id],
            'style' => 'display:inline'
        ]) !!}
        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                'type' => 'submit',
                'class' => 'btn btn-danger btn-xs',
                'title' => 'Delete Table',
                'onclick'=>'return confirm("Confirm delete?")'
        ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $table->id }}</td>
            </tr>
            <tr>
                <th> Count</th>
                <td> {{ $table->count }} </td>
            </tr>
            <tr>
                <th> Price</th>
                <td> {{ $table->price }} </td>
            </tr>
            <tr>
                <th> Available</th>
                <td> {{ $table->available }} </td>
            </tr>
            <tr>
                <th> People Count</th>
                <td> {{ $table->people_count }} </td>
            </tr>
            </tbody>
        </table>
    </div>

    {{--</div>--}}
@endsection
