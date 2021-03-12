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
                <form action="{{ url('stock_currency/') }}/{{ $stock->stock_id }}/update" method="POST">
                  @method('PUT')
                  @csrf
                    {{-- <div class="form-group my-4">
                      <label for="site_id">Pilih Site(?)</label>
                      <select name="site_id" id="site_id" class="form-control">
                        @php
                            $chosen_site = 0;
                        @endphp
                        @foreach ($sites as $st)
                          <option value="{{ $st->site_id }}" @if ($stock->site_id == $st->site_id) selected @php $chosen_site = 1 @endphp @endif >{{ $st->station_id }}</option>
                        @endforeach
                          <option value="{{ $stock->site_id }}" @if ($chosen_site == 0) selected  @endif >{{ $stock->station_id ?? 'Site ini masih belum ada namanya' }}</option>
                      </select>
                    </div> --}}
                    <div class="form-group my-4">
                      <label for="nama_barang">Nama Barang</label>
                      <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{ $stock->nama_barang }}" >
                      {{-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group my-4">
                      <label for="group">Group nya</label>
                      {{-- <select name="group" id="group" class="form-control">
                        <option value="1" @if ($stock->group === 1) selected @endif >Transmitter</option>
                        <option value="2" @if ($stock->group === 2) selected @endif >Receiver</option>
                        <option value="3" @if ($stock->group === 3) selected @endif >Antenna</option>
                        <option value="0" @if ($stock->group === 0) selected @endif >Tambahan</option>
                      </select> --}}
                      <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                        <option value="" disabled @if($stock->group === "") selected @endif {{ old('group') == '' ? 'selected' : '' }} >-- Pilih jenis barang --</option>
                        @foreach ($stocks_group as $sg)
                          <option value="{{$sg->group}}" @if($sg->group === $stock->group) selected @endif {{ old('group') == $sg->group ? 'selected' : '' }}>{{ $sg->group }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group my-4">
                      <label for="part_number">Part Number</label>
                      <input type="text" class="form-control" id="part_number" name="part_number" placeholder="Masukkan part number" value="{{ $stock->part_number }}" >
                    </div>
                    <div class="form-group my-4">
                      <label for="serial_number">Serial Number</label>
                      <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Masukkan part number" value="{{ $stock->serial_number }}" >
                    </div>
                    <div class="form-group my-4">
                      <label for="tgl_masuk">Tanggal Masuk / Edit</label>
                      <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Input" value="{{ $stock->tgl_masuk }}">
                    </div>
                    <div class="form-group my-4">
                      <label for="expired">Life expectancy</label>
                      <input type="date" class="form-control" id="expired" name="expired" placeholder="Expected lifetime" value="{{ $stock->expired }}">
                    </div>
                    <div class="form-group my-4">
                      <label for="kurs_beli">Kurs Beli</label>
                      <input type="text" class="form-control" id="kurs_beli" name="kurs_beli" placeholder="Kurs Beli" value="{{ $stock->kurs_beli }}">
                    </div>
                    <div class="form-group my-4">
                      <label for="jumlah_unit">Jumlah Unit</label>
                      <input type="text" class="form-control" id="jumlah_unit" name="jumlah_unit" value="{{ $stock->jumlah_unit }}">
                    </div>
                    <div class="form-group my-4">
                      <label for="status">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="Not Obsolete" @if ($stock->status === "Not Obsolete") selected @endif>Not Obsolete</option>
                        <option value="Obsolete" @if ($stock->status === "Obsolete") selected @endif>Obsolete</option>
                        <option value="Dummy" @if ($stock->status === "Dummy") selected @endif>Dummy</option>
                      </select>
                    </div>                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ url('stock_currency/') }}" class="btn btn-info ml-3 d-inline">Kembali</a>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  window.onload = () => {
    $('#group').select2({
      tags: true
    });
  };
</script>
@endsection