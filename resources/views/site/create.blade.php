@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Input Stocks on Site')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">Input Inventory {{$sites->radar_name}}</h4>
          </div>
          <div class="card-body">
            <form action="/addInventorySite" method="POST">
              @csrf
              <div class="form-group my-4">
                  <input type="hidden" class="form-control" id="site_id" name="site_id" value="{{ $sites->site_id }}">
                  <label for="nama_barang">Nama Barang</label>
                  {{-- <input type="text" class="form-control @error('nama_barang') is-invalid @enderror " id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{ old('nama_barang') }}"> --}}
                  <select name="nama_barang" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror">
                    <option selected disabled value="">--Pilih Barang--</option>
                    @foreach ($stocks as $stk)
                      <option value="{{ $stk->nama_barang }}" {{ old('nama_barang') == $stk->nama_barang ? 'selected' : '' }}>{{$stk->nama_barang}}</option>
                    @endforeach
                  </select>

                  {{-- <input type="text" class="form-control @error('nama_barang') is-invalid @enderror " id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{ old('nama_barang') }}"> --}}
                  
                  @error('nama_barang')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                      
                </div>
                <div class="form-group my-4">
                  <label for="group">Group Stock</label>
                  <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                    <option disabled selected value=" " {{ old('group') == '' ? 'selected' : '' }} >-- Pilih jenis barang --</option>
                    <option value="1" {{ old('group') == 1 ? 'selected' : '' }}>Transmitter</option>
                    <option value="2" {{ old('group') == 2 ? 'selected' : '' }}>Receiver</option>
                    <option value="3" {{ old('group') == 3 ? 'selected' : '' }}>Antenna</option>
                    <option value="0" {{ old('group') == 4 ? 'selected' : '' }}>Tambahan</option>
                  </select>
                  
                  @error('group')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>

                {{-- Select2 --}}
                {{-- <script>
                  window.onload = () =>{
                    $("#nama_barang").select2({
                      tags: true
                    });

                    $("#group").select2({
                      tags: true
                    });
                  }
                </script> --}}

                <div class="form-group my-4">
                  <label for="part_number">Part Number</label>
                  <input type="text" class="form-control @error('part_number') is-invalid @enderror" id="part_number" name="part_number" placeholder="Masukkan part number" value="{{ old('part_number') }}">
                  @error('part_number')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>

                <div class="form-group my-4">
                  <label for="serial_number">Serial Number</label>
                  <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" placeholder="Masukkan part number" value="{{ old('serial_number') }}">
                  @error('serial_number')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>

                <div class="form-group my-4">
                  <label for="tgl_masuk">Tanggal Masuk / Edit</label>
                  <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Input" value="{{ old('tgl_masuk') }}">
                  @error('tgl_masuk')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>

                <div class="form-group my-4">
                  <label for="expired">Life expectancy</label>
                  <input type="date" class="form-control @error('expired') is-invalid @enderror" id="expired" name="expired" placeholder="Expected lifetime" value="{{ old('expired') }}">
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