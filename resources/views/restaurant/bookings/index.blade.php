@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Bookings</h1>
    @include('layouts.messages')
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No </th>
                <th> People Count </th>
                <th> Date </th>
                <th> Status </th>
                <th> Actions </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($bookings as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $bookings->perPage()*($bookings->currentPage()-1)+$x }}</td>
                    <td>{{ $item->people_count }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ url('/admin/restaurant/bookings/' . $item->id) }}" class="btn btn-success btn-xs"
                           title="View Booking"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/restaurant/bookings/' . $item->id . '/edit') }}"
                           class="btn btn-primary btn-xs" title="Edit Booking"><span class="glyphicon glyphicon-pencil"
                                                                                     aria-hidden="true"/></a>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $bookings->render() !!} </div>
    </div>

    {{--</div>--}}
@endsection
