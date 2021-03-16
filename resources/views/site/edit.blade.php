@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Input Stocks on Site')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title ">Edit Inventory {{$sites->radar_name}}</h4>
          </div>
          <div class="card-body">
            <form action="/editInventorySite/{{$stocks->stock_id}}" method="POST">
            @method('put')
              @csrf
                <div class="form-group my-4">
                  <label for="nama_barang">Nama Barang</label>
                  <input type="text" class="form-control @error('nama_barang') is-invalid @enderror " id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{$stocks->nama_barang}}">
                  <input type="hidden" class="form-control" id="site_id" name="site_id" value="{{ $sites->site_id }}">
                  
                  @error('nama_barang')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                      
                </div>
                <div class="form-group my-4">
                  <label for="group">Group nya</label>
                  <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                    <option disabled value="" {{ old('group') == '' ? 'selected' : '' }} >-- Pilih jenis barang --</option>
                    <option value="1" {{ old('group') === 1 ? 'selected' : '' }} @if ($stocks->group === 1) selected @endif>Transmitter</option>
                    <option value="2" {{ old('group') === 2 ? 'selected' : '' }} @if ($stocks->group === 2) selected @endif >Receiver</option>
                    <option value="3" {{ old('group') === 3 ? 'selected' : '' }} @if ($stocks->group === 3) selected @endif>Antenna</option>
                    <option value="0" {{ old('group') === 0 ? 'selected' : '' }} @if ($stocks->group === 0) selected @endif>Tambahan</option>
                  </select>
                  @error('group')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="part_number">Part Number</label>
                  <input type="text" class="form-control @error('part_number') is-invalid @enderror" id="part_number" name="part_number" placeholder="Masukkan part number" value="{{$stocks->part_number}}">
                  @error('part_number')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="serial_number">Serial Number</label>
                  <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" placeholder="Masukkan part number" value="{{$stocks->serial_number}}">
                  @error('serial_number')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="tgl_masuk">Tanggal Masuk / Edit</label>
                  <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Input" value="{{$stocks->tgl_masuk}}">
                  @error('tgl_masuk')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="expired">Life expectancy</label>
                  <input type="date" class="form-control @error('expired') is-invalid @enderror" id="expired" name="expired" placeholder="Expected lifetime" value="{{$stocks->expired}}">
                  @error('expired')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/inventory/{{$sites->site_id}}" class="btn btn-info ml-3 d-inline">Kembali</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection