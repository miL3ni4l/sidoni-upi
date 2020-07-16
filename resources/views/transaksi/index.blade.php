
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

  <div class="col-lg-2">
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Donasi</a>
  </div>
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b><i class="fa fa-download"></i> Export PDF</b>
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{url('laporan/trs/pdf')}}"> Semua  </a>
                            <a class="dropdown-item" href="{{url('laporan/trs/pdf?status=belum')}}"> Belum Lunas </a>
                            <a class="dropdown-item" href="{{url('laporan/trs/pdf?status=lunas')}}"> Lunas </a>
                          </div>
                        </div>
  

    <div class="col-lg-12">
                  @if (Session::has('message'))
                  <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                  @endif
                  </div>
    </div>
    

@if(Auth::user()->level == 'admin')
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Data Donasi</h4>
                  
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-chart-line text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Donasi</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$transaksi->count()}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total seluruh donasi
                  </p>
                </div>
              </div>
            </div>
        
  
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th>
                            Kode Donasi 
                          </th>
                          <th>
                            Acara
                          </th>
                          <th>
                            Donatur
                          </th>
                          <th>
                            Tanggal Donasi
                          </th>
                          <th>
                            Jenis Donasi
                          </th>
                          <th>
                            Jumlah Donasi
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Ket
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
                          <a href="{{route('transaksi.show', $data->id)}}"> 
                            {{$data->kode_transaksi}}
                          </a>
                          </td>
                         
                          <td>
                            {{$data->acara->nama_acr}}
                          </td>
                         
                          <td>
                            {{$data->anggota->nama}}
                          </td>
              
                          <td>
                            {{date('d/m/y', strtotime($data->tgl_transaksi))}}
                          </td>
                          <td>
                            {{$data->jml_donasi}}
                          </td>
                          
                          <td>
                            {{$data->total_donasi}}
                          </td>
              

                          <td>
                          @if($data->status == 'belum')
                            <label class="badge badge-warning">belum</label>
                          @else
                            <label class="badge badge-success">lunas</label>
                          @endif
                          </td>

                           <td>
                            {{$data->ket}}
                          </td>
                          <td>
                          @if(Auth::user()->level == 'admin')
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                          @if($data->status == 'belum')
                          <form action="{{ route('transaksi.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin data ini sudah lunas?')"> Sudah Lunas
                            </button>
                          </form>
                          @endif
                            <form action="{{ route('transaksi.destroy', $data->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                            </button>
                          </form>
                          </div>
                        </div>
                        @else
                        @if($data->status == 'belum')
                        <form action="{{ route('transaksi.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <button class="btn btn-info btn-xs" onclick="return confirm('Anda yakin data ini sudah lunas?')">Sudah lunas
                            </button>
                          </form>
                          @else
                          -
                          @endif
                        @endif
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
@else
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Data Transaksi</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th>
                            Kode
                          </th>
                          <th>
                            Acara
                          </th>
                         
                          <th>
                            Tanggal Donasi
                          </th>
                          <th>
                            Jumlah Donasi
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Ket
                          </th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td class="py-1">
                          <a href="{{route('transaksi.show', $data->id)}}"> 
                            {{$data->kode_transaksi}}
                          </a>
                          </td>
                         
                          <td>
                            {{$data->acara->nama_acr}}
                          </td>
                         
                        
              
                          <td>
                            {{date('d/m/y', strtotime($data->tgl_transaksi))}}
                          </td>

                          <td>
                            {{$data->total_donasi}}
                          </td>
              

                          <td>
                          @if($data->status == 'belum')
                            <label class="badge badge-warning">belum</label>
                          @else
                            <label class="badge badge-success">lunas</label>
                          @endif
                          </td>

                           <td>
                            {{$data->ket}}
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
          @endif
@endsection