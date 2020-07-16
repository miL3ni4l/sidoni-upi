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

<form method="POST" action="{{ route('acara.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tambah Acara Baru</h4>
                      
                        <div class="form-group{{ $errors->has('nama_acr') ? ' has-error' : '' }}">
                            <label for="nama_acr" class="col-md-4 control-label">Acara</label>
                            <div class="col-md-6">
                                <input id="nama_acr" type="text" class="form-control" name="nama_acr" value="{{ old('nama_acr') }}" required>
                                @if ($errors->has('nama_acr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_acr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('tgl_acara') ? ' has-error' : '' }}">
                            <label for="tgl_acara" class="col-md-4 control-label">Tanggal Pelaksanaan</label>
                            <div class="col-md-6">
                                <input id="tgl_acara" type="date" class="form-control" name="tgl_acara" value="{{ old('tgl_acara') }}" required>
                                @if ($errors->has('tgl_acara'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_acara') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lokasi') ? ' has-error' : '' }}">
                            <label for="lokasi" class="col-md-4 control-label">Lokasi Acara</label>
                            <div class="col-md-6">
                                <input id="lokasi" type="text" class="form-control" name="lokasi" value="{{ old('lokasi') }}" required>
                                @if ($errors->has('lokasi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lokasi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                
                        <div class="form-group{{ $errors->has('jumlah_acara') ? ' has-error' : '' }}">
                            <label for="jumlah_acara" class="col-md-4 control-label">Rencana Anggaran</label>
                            <div class="col-md-6">
                                <input id="jumlah_acara" type="number" maxlength="4" class="form-control" name="jumlah_acara" value="{{ old('jumlah_acara') }}" required>
                                @if ($errors->has('jumlah_acara'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_acara') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-12">
                                <input id="ket" type="text" class="form-control" name="ket" value="{{ old('ket') }}" >
                                @if ($errors->has('ket'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ket') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Cover</label>
                            <div class="col-md-6">
                                <img width="200" height="200" />
                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="{{route('acara.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection