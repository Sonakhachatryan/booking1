@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Tables <a href="{{ url('admin/restaurant/tables/create') }}" class="btn btn-primary btn-xs"
                  title="Add New Table"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div id="messages">
    @include('layouts.messages')
    </div>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No </th>
                <th> People Count </th>
                <th> Count </th>
                <th> Available </th>
                <th> Price </th>
                <th> Actions </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($tables as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $tables->perPage()*($tables->currentPage()-1)+$x }}</td>
                    <td>{{ $item->people_count }}</td>
                    <td>{{ $item->count }}</td>
                    <td>{{ $item->available }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="{{ url('admin/restaurant/tables/' . $item->id) }}" class="btn btn-success btn-xs"
                           title="View Table"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('admin/restaurant/tables/' . $item->id . '/edit') }}"
                           class="btn btn-primary btn-xs" title="Edit Table"><span class="glyphicon glyphicon-pencil"
                                                                                   aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/restaurant/tables', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Table" />', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete Table',
                                'onclick'=>'return confirm("Confirm delete?")'
                        )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $tables->render() !!} </div>
    </div>

    {{--</div>--}}
@endsection

@section('script')
    <script>
        setTimeout(function() {
            $("#messages").fadeOut("slow").empty();
        }, 5000);
    </script>
@endsection
