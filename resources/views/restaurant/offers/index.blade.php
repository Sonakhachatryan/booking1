{{--{{ dd($offers) }}--}}
@extends('admin.layouts.app')

@section('content')
{{--<div class="container">--}}
    @include('layouts.messages')
    <h1>Offers <a href="{{ url('admin/restaurant/offers/create') }}" class="btn btn-primary btn-xs" title="Add New Offer"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Title </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($offers as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $offers->perPage()*($offers->currentPage()-1)+$x }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <a href="{{ url('admin/restaurant/offers/' . $item->id) }}" class="btn btn-success btn-xs" title="View Offer"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('admin/restaurant/offers/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Offer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/restaurant/offers', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Offer" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Offer',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $offers->render() !!} </div>
    {{--</div>--}}

</div>
@endsection
