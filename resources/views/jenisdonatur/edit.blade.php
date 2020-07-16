@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
        </script>
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('jenisdonatur.update', $data->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Jenis Donatur <b>{{$data->jns_donatur}}</b> </h4>
                      <form class="forms-sample">

                        <div class="form-group{{ $errors->has('jns_donatur') ? ' has-error' : '' }}">
                            <label for="jns_donatur" class="col-md-4 control-label">Jenis Donatur</label>
                            <div class="col-md-6">
                                <input id="jns_donatur" type="text" class="form-control" name="jns_donatur" value="{{ $data->jns_donatur }}" required>
                                @if ($errors->has('jns_donatur'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jns_donatur') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Update
                        </button>
                        <a href="{{route('jenisdonatur.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection