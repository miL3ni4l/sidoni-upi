
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
@if(Auth::user()->level == 'admin')
          
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-currency-usd text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Pendapatan</p>
                      <div class="fluid-container">
                        <h3 class="counter text-right m-t-15 text-danger">{{$transaksis}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Total seluruh pendapatan
                  </p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cloud-download text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Donasi</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-danger mb-0">{{$transaksi->count()}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Total seluruh donasi
                  </p>
                </div>
              </div>
            </div>
           
         
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-multiple text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Donatur</p>
                      <div class="fluid-container">
                       <h3 class="counter text-right m-t-15 text-danger">{{$anggotas}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Total seluruh donatur
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-microphone-variant text-success icon-lg" style="width: 40px;height: 40px;"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Acara</p>
                      <div class="fluid-container">
                        <h3 class="counter text-right m-t-15 text-danger">{{$acaras}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Total seluruh acara
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-check text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Lunas</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-danger mb-0">{{$transaksi->where('status', 'lunas')->count()}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Sudah lunas
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card" >
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-close text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Belum</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-danger mb-0">{{$transaksi->where('status', 'belum')->count()}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Belum lunas
                  </p>
                </div>
              </div>
            </div>
 
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card"  >
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-star text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Admin</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-danger mb-0">{{$user->where('level', 'admin')->count()}}</h3>
                      </div> 
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Admin UPI
                  </p>
                </div>
              </div>
            </div>
             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card" >
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-switch text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Users</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-danger mb-0">{{$user->where('level', 'user')->count()}}</h3>
                      </div> 
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> User UPI
                  </p>
                </div>
              </div>
            </div>
</div>

<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Data Transaksi </h4>
            
                  
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
                            Donatur
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



<div class="row">
@else
           <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cloud-download text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Donasi</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-danger mb-0">{{$transaksi->count()}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Total seluruh donasi
                  </p>
                </div>
              </div>
            </div>
           
         
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-multiple text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Donatur</p>
                      <div class="fluid-container">
                       <h3 class="counter text-right m-t-15 text-danger">{{$anggotas}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Total seluruh donatur
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-microphone-variant text-success icon-lg" style="width: 40px;height: 40px;"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Acara</p>
                      <div class="fluid-container">
                        <h3 class="counter text-right m-t-15 text-danger">{{$acaras}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-chart-arc mr-1" aria-hidden="true"></i> Total seluruh acara
                  </p>
                </div>
              </div>
            </div>
          
      
</div>


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
