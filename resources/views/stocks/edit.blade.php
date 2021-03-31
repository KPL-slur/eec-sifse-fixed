@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Edit Stocks and their currencies')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title ">Input Inventory with Exchange Rate</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>
          <div class="card-body">
              <p class="mb-4 text-center h3">Harga Kurs Sekarang : <span class="text-primary display-4">Rp {{ $rate_fix }}</span> ke USD</p>
              <form action="{{ url('stocks/') }}/{{ $stock->stock_id }}/update" method="POST">
                @method('PUT')
                @csrf
                  <div class="form-group my-4">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{ $stock->nama_barang }}" >
                    @error('nama_barang')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group my-4">
                    <label for="group">Group nya</label>
                    <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                      <option value="" disabled @if($stock->group === "") selected @endif {{ old('group') == '' ? 'selected' : '' }} >-- Pilih jenis barang --</option>
                      @foreach ($stocks_group as $sg)
                        <option value="{{$sg}}" @if($sg === $stock->group) selected @endif {{ old('group') == $sg ? 'selected' : '' }}>{{ $sg }}</option>
                      @endforeach
                    </select>
                    @error('group')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group my-4">
                    <label for="part_number">Part Number</label>
                    <input type="text" class="form-control @error('part_number') is-invalid @enderror" id="part_number" name="part_number" placeholder="Masukkan part number" value="{{ $stock->part_number }}" >
                    @error('part_number')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group my-4">
                    <label for="serial_number">Serial Number</label>
                    <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" placeholder="Masukkan part number" value="{{ $stock->serial_number }}" >
                    @error('serial_number')
                      {{ $message }}
                    @enderror
                  </div>
                  <div class="form-group my-4">
                    <label for="tgl_masuk">Tanggal Masuk / Edit</label>
                    <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Input" value="{{ $stock->tgl_masuk }}">
                    @error('tgl_masuk')
                      {{ $message }}
                    @enderror
                  </div>
                  <div class="form-group my-4">
                    <label for="expired">Life expectancy</label>
                    <input type="date" class="form-control @error('expired') is-invalid @enderror" id="expired" name="expired" placeholder="Expected lifetime" value="{{ $stock->expired }}">
                    @error('expired')
                      {{ $message }}
                    @enderror
                  </div>
                  <div class="form-group my-4">
                    <label for="kurs_beli">Kurs Beli</label>
                    <input type="text" class="form-control @error('kurs_beli') is-invalid @enderror" id="kurs_beli" name="kurs_beli" placeholder="Kurs Beli" value="{{ $stock->kurs_beli }}">
                    @error('kurs_beli')
                      {{ $message }}
                    @enderror
                  </div>
                  <div class="form-group my-4">
                    <label for="jumlah_unit">Jumlah Unit</label>
                    <input type="text" class="form-control @error('jumlah_unit') is-invalid @enderror " id="jumlah_unit" name="jumlah_unit" value="{{ $stock->jumlah_unit }}">
                    @error('jumlah_unit')
                      {{ $message }}
                    @enderror
                  </div>
                  <div class="form-group my-4">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                      <option value="Not Obsolete" @if ($stock->status === "Not Obsolete") selected @endif>Not Obsolete</option>
                      <option value="Obsolete" @if ($stock->status === "Obsolete") selected @endif>Obsolete</option>
                      <option value="Dummy" @if ($stock->status === "Dummy") selected @endif>Dummy</option>
                    </select>
                    @error('status')
                      {{ $message }}
                    @enderror
                  </div>                    
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{ url('stocks/') }}" class="btn btn-info ml-3 d-inline">Kembali</a>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push('js')
  <script>
    $('#group').select2({
      tags: true
    });
  </script>
@endpush
@endsection