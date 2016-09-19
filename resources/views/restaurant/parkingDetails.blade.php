
{{--{{ dd($restaurant) }}--}}
@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Parking Details
        <a href="{{ url('/admin/restaurant/parking-details/create') }}" class="btn btn-primary btn-xs" title="Add Parking">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"/>
        </a>
    </h1>
    @include('layouts.messages')
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th> S.No </th>
            <th> Duration </th>
            <th> Price </th>
            <th> Count </th>
            <th> Available </th>
            <th> Actions </th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($restaurant->parkings as $item)
            {{-- */$x++;/* --}}
            {!! Form::open([
               'method' => 'post',
               'url' => ['/admin/restaurant/parking-details/edit', $item->id],
               'class' => 'form-horizontal',
               'files' => true
            ]) !!}
            <tr>
                <td>{{ $x  }}</td>
                <td><input type="text"  name="duration" value="{{ $item->duration }}"></td>
                <td><input type="number"  name="price" value="{{ $item->price }}"></td>
                <td><input type="number"  name="count" value="{{ $item->count }}"></td>
                <td><input type="number"  name="available" value="{{ $item->available }}"></td>
                <td>
                    <button type = "submit" class="btn btn-primary btn-xs"
                            title="Edit parking detail"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                    <a href="{{ url('/admin/restaurant/parking-details/delete/' . $item->id) }}" class="btn btn-danger btn-xs"
                    title="Delete parking detail"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>
                </td>
            </tr>
            {!! Form::close() !!}
        @endforeach
        </tbody>
    </table>
@endsection