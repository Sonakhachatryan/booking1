@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Booking {{ $booking->id }}
        <a href="{{ url('bookings/' . $booking->id . '/edit') }}" class="btn btn-primary btn-xs"
           title="Edit Booking"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $booking->id }}</td>
            </tr>
            <tr>
                <th> People Count</th>
                <td> {{ $booking->people_count }} </td>
            </tr>
            <tr>
                <th> Date</th>
                <td> {{ $booking->date }} </td>
            </tr>
            <tr>
                <th> Status</th>
                <td> {{ $booking->status }} </td>
            </tr>
            </tbody>
        </table>
    </div>

    {{--</div>--}}
@endsection
