@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">
&nbsp; &nbsp;
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Halaman Utama
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="{{ route('anggota.index') }}">Donatur</a></li>
    <li><a href="{{ route('jenisdonatur.index') }}"> Jenis Donatur</a></li>
  </ul>
</div>
&nbsp; &nbsp; &nbsp;

<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Tambah Donatur
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="{{ route('anggota.create') }}">Tambah Donatur</a></li>
    <li><a href="{{ route('jenisdonatur.create') }}"> Tambah Jenis Donatur</a></li>
  </ul>
</div>


    <div class="col-lg-12">
                  @if (Session::has('message'))
                  <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                  @endif
                  </div>
</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Data Donatur</h4>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-multiple text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Donatur</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$anggota->count()}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-account mr-1" aria-hidden="true"></i> Total seluruh donatur
                  </p>
                </div>
              </div>
            </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                       
                          <th>
                            Nama Donatur
                          </th>
                          <th>
                            No Donatur
                          </th>
                          <th>
                            Alamat
                          </th>
                          <th>
                            No HP
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                       
                          <td class="py-1">
                          @if($data->user->gambar)
                            <img src="{{url('images/user', $data->user->gambar)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />
                          @endif

                            {{$data->nama}}
                          </td>

                          <td>
                          <a href="{{route('anggota.show', $data->id)}}"> 
                            {{$data->nid}}
                          </a>
                          </td>
            
                          <td>
                            {{$data->alamat}}
                          </td>

                          <td>
                            {{$data->hp}}
                          </td>
                          

                          <td>
                           <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{route('anggota.edit', $data->id)}}"> Edit </a>
                            <form action="{{ route('anggota.destroy', $data->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                            </button>
                          </form>
                           
                          </div>
                        </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
               {{--  {!! $datas->links() !!} --}}
                </div>
              </div>
            </div>
          </div>
@endsection