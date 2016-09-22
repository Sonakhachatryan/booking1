@extends('admin.layouts.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
    {{--<div class="container">--}}
    @include('layouts.messages')
    <div class="messages"></div>
    <h1>Add Kitchens</h1>

    {!! Form::open(['url' => '/admin/restaurant/kitchens', 'class' => 'form-horizontal']) !!}

    <div class="form-group {{ $errors->has('kitchens') ? 'has-error' : ''}}">
        {!! Form::label('kitchens', 'Kitchens', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <select class="js-example-basic-multiple form-control" multiple="multiple" name="kitchens[]">
                @foreach($kitchens as $kitchen)
                    <option name="kitchen_id" value="{{ $kitchen->id }}">{{ $kitchen->name}}</option>
                @endforeach
            </select>
            {!! $errors->first('kitchens', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    <h1>My Kitchens</h1>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>S.No</th>
            <th> Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($restKitchens as $item)
            {{-- */$x++;/* --}}
            <tr>
                <td>{{ $restKitchens->perPage()*($restKitchens->currentPage()-1)+$x }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <form method="post" action="{{url('/admin/restaurant/kitchens/'.$item->id)}}" style = 'display:inline'>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="current_page" value="{{$restKitchens->currentPage()}}">
                        <button id="delete_kitchen" hidden type="submit"></button>
                        <button type ='button' data="{{csrf_token()}}" value="{{ $item->id }}" class = 'delete btn btn-danger btn-xs' title = 'Delete Offer'>
                            <span class="delete glyphicon glyphicon-trash" aria-hidden="true" title="Delete Offer" />
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $restKitchens->render() !!} </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $('select').select2();

        $(".delete").on('click',function() {

            var id = $(this).val();
            var token = $(this).attr('data');
            var method = 'DELETE';
            swal({
                title: "Are you sure?",
                text: "The Client Will be Removed to X!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, remove it!",
                closeOnConfirm: false
            }, function () {

                $('#delete_kitchen').click();
            })
        })
    </script>
@endsection
