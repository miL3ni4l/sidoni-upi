@extends('layouts.app')

@section('content')

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Detail <b>{{$data->kode_transaksi}}</b></h4>
                    <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" @if($data->acara->cover) src="{{ asset('images/acara/'.$data->acara->cover) }}" @endif />
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                            <label for="kode_transaksi" class="col-md-4 control-label">Kode Donasi</label>
                            <div class="col-md-6">
                                <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" value="{{$data->kode_transaksi}}" required readonly="">
                            </div>
                      
                         <div class="form-group{{ $errors->has('tgl_lunas') ? ' has-error' : '' }}">
                            <label for="tgl_lunas" class="col-md-4 control-label">Tanggal lunas</label>
                            <div class="col-md-3">
                                <input id="tgl_lunas" type="date"  class="form-control" name="tgl_lunas" value="{{ date('Y-m-d', strtotime($data->tgl_lunas)) }}" readonly="">
                            </div>
                        </div>


                  
                        <div class="form-group">
                            <label for="anggota_id" class="col-md-4 control-label">Donatur</label>
                            <div class="col-md-6">
                                <input id="anggota_nama" type="text" class="form-control" readonly="" value="{{$data->anggota->nama}}">

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                @if($data->status == 'belum')
                                  <label class="badge badge-warning">Belum</label>
                                @else
                                  <label class="badge badge-success">Lunas</label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="ket" type="text" class="form-control" name="ket" value="{{ $data->ket }}" readonly="">
                            </div>
                        </div>

                        <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>


@endsection