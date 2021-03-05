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
                <form action="{{ url('stock_currency/') }}/{{ $siteAndStock->stock_id }}/update" method="POST">
                  @method('PUT')
                  @csrf
                    {{-- <div class="form-group my-4">
                      <label for="site_id">Pilih Site(?)</label>
                      <select name="site_id" id="site_id" class="form-control">
                        @php
                            $chosen_site = 0;
                        @endphp
                        @foreach ($sites as $st)
                          <option value="{{ $st->site_id }}" @if ($siteAndStock->site_id == $st->site_id) selected @php $chosen_site = 1 @endphp @endif >{{ $st->station_id }}</option>
                        @endforeach
                          <option value="{{ $siteAndStock->site_id }}" @if ($chosen_site == 0) selected  @endif >{{ $siteAndStock->station_id ?? 'Site ini masih belum ada namanya' }}</option>
                      </select>
                    </div> --}}
                    <div class="form-group my-4">
                      <label for="nama_barang">Nama Barang</label>
                      <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{ $siteAndStock->nama_barang }}" >
                      {{-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group my-4">
                      <label for="group">Group nya</label>
                      <select name="group" id="group" class="form-control">
                        <option value="1" @if ($siteAndStock->group === 1) selected @endif >Transmitter</option>
                        <option value="2" @if ($siteAndStock->group === 2) selected @endif >Receiver</option>
                        <option value="3" @if ($siteAndStock->group === 3) selected @endif >Antenna</option>
                        <option value="0" @if ($siteAndStock->group === 0) selected @endif >Tambahan</option>
                      </select>
                    </div>
                    <div class="form-group my-4">
                      <label for="part_number">Part Number</label>
                      <input type="text" class="form-control" id="part_number" name="part_number" placeholder="Masukkan part number" value="{{ $siteAndStock->part_number }}" >
                    </div>
                    <div class="form-group my-4">
                      <label for="serial_number">Serial Number</label>
                      <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Masukkan part number" value="{{ $siteAndStock->serial_number }}" >
                    </div>
                    <div class="form-group my-4">
                      <label for="tgl_masuk">Tanggal Masuk / Edit</label>
                      <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Input" value="{{ $siteAndStock->tgl_masuk }}">
                    </div>
                    <div class="form-group my-4">
                      <label for="expired">Life expectancy</label>
                      <input type="date" class="form-control" id="expired" name="expired" placeholder="Expected lifetime" value="{{ $siteAndStock->expired }}">
                    </div>
                    <div class="form-group my-4">
                      <label for="kurs_beli">Kurs Beli</label>
                      <input type="text" class="form-control" id="kurs_beli" name="kurs_beli" placeholder="Kurs Beli" value="{{ $siteAndStock->kurs_beli }}">
                    </div>
                    <div class="form-group my-4">
                      <label for="jumlah_unit">Jumlah Unit</label>
                      <input type="text" class="form-control" id="jumlah_unit" name="jumlah_unit" value="{{ $siteAndStock->jumlah_unit }}">
                    </div>
                    <div class="form-group my-4">
                      <label for="status">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="0" @if ($siteAndStock->status === 0) selected @endif>Not Obsolete</option>
                        <option value="1" @if ($siteAndStock->status === 1) selected @endif>Obsolete</option>
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
@endsection