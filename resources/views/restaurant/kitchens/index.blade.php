{{--{{ dd($offers) }}--}}
@extends('admin.layouts.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
    {{--<div class="container">--}}
    @include('layouts.messages')
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
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['admin/restaurant/kitchens', $item->id],
                        'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Offer" />', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'title' => 'Delete Offer',
                            'onclick'=>'return swal({
  title: "Are you sure?",
  text: "You will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false,
  html: false
}, function(){
  swal("Deleted!",
  "Your imaginary file has been deleted.",
  "success");
})'
                    )) !!}
                    {!! Form::close() !!}
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

        //        $(document).ready(function() {
        //            $(".js-example-basic-multiple").select2();
        //        });
    </script>
@endsection
