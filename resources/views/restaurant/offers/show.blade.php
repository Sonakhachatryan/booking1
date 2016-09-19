@extends('admin.layouts.app')

@section('content')
{{--<div class="container">--}}
    @include('layouts.messages')
    <h1>{{ $offer->title }}
        <a href="{{ url('admin/restaurant/offers/' . $offer->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Offer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/restaurant/offers', $offer->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Offer',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <p>{{ $offer->content }}</p>
    </div>

{{--</div>--}}
@endsection
