@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Input Stocks and their currencies')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">Input Inventory with Exchange Rate</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>
          <div class="card-body">
            <p class="mb-4 text-center h3">Harga Kurs Sekarang : <span class="text-primary text-center display-4">Rp {{ $rate_fix }}</span> ke USD</p>
            <form action="{{ url('stock_currency/') }}" method="POST">
              @csrf
                {{-- <div class="form-group my-4">
                  <label for="site_id">Pilih Site</label>
                  <select name="site_id" id="site_id" class="form-control @error('site_id') is-invalid @enderror">
                    <option value="">-- Pilih Site --</option>
                    @foreach ($sites as $st)
                      <option value="{{ $st->site_id }}" {{ old('site_id') == $st->site_id ? 'selected' : '' }}>{{ $st->station_id }}</option>  
                    @endforeach
                  </select>
                  <input type="text" class="form-control" id="site_id" name="site_id"> DISINI TADINYA KE-KOMEN
                  <small class="form-text text-muted">Apabila site tidak ada, berarti tambah dahulu di fitur site</small>
                  @error('site_id')
                    <div class="invalid-feedback">
                      Lokasi site belum diisi
                    </div>
                  @enderror
                </div> --}}

                <div class="form-group my-4">
                  <label for="nama_barang">Nama Barang</label>
                  <input type="text" class="form-control @error('nama_barang') is-invalid @enderror " id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{ old('nama_barang') }}">
                  
                  @error('nama_barang')
                    <div class="invalid-feedback">
                      Nama barang harus diisi
                    </div>
                  @enderror
                      
                </div>
                <div class="form-group my-4">
                  <label for="group">Group nya</label>
                  {{-- <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                    <option value="" {{ old('group') == '' ? 'selected' : '' }} >-- Pilih jenis barang --</option>
                    <option value="1" {{ old('group') == 1 ? 'selected' : '' }} >Transmitter</option>
                    <option value="2" {{ old('group') == 2 ? 'selected' : '' }}>Receiver</option>
                    <option value="3" {{ old('group') == 3 ? 'selected' : '' }}>Antenna</option>
                  </select> --}}
                  <br>
                  <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                    <option value="" {{ old('group') == '' ? 'selected' : '' }} >-- Pilih jenis barang --</option>
                    @foreach ($stocks_group as $sg)
                      <option value="{{$sg}}" {{ old('group') == $sg ? 'selected' : '' }}>{{ $sg }}</option>
                    @endforeach
                  </select>
                  @error('group')
                    <div class="invalid-feedback">
                      Jenis barang (group) belum diisi
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="part_number">Part Number</label>
                  <input type="text" class="form-control @error('part_number') is-invalid @enderror" id="part_number" name="part_number" placeholder="Masukkan part number" value="{{ old('part_number') }}">
                  @error('part_number')
                    <div class="invalid-feedback">
                      Part Number belum diisi
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="serial_number">Serial Number</label>
                  <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" placeholder="Masukkan part number" value="{{ old('serial_number') }}">
                  @error('serial_number')
                    <div class="invalid-feedback">
                      Serial Number belum diisi
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="tgl_masuk">Tanggal Masuk / Edit</label>
                  <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Input" value="{{ old('tgl_masuk') }}">
                  @error('tgl_masuk')
                    <div class="invalid-feedback">
                      Tanggal masuk belum diisi
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="expired">Life expectancy</label>
                  <input type="date" class="form-control @error('expired') is-invalid @enderror" id="expired" name="expired" placeholder="Expected lifetime" value="{{ old('expired') }}">
                  @error('expired')
                    <div class="invalid-feedback">
                      Life expectancy belum diisi
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="kurs_beli">Kurs Beli</label>
                  <input type="text" class="form-control @error('kurs_beli') is-invalid @enderror" id="kurs_beli" name="kurs_beli" placeholder="Kurs Beli" value="{{ old('kurs_beli') }}">
                  <button type="button" id="button_kurs_beli" class="btn btn-sm my-4">Ingin masukkan kurs sekarang?</button>
                  <script type="text/javascript">
                    document.getElementById("button_kurs_beli").addEventListener("click", (e) => {
                      document.getElementById("kurs_beli").value = '<?php echo $rate_fix ?>';
                    });
                  </script>
                  @error('kurs_beli')
                    <div class="invalid-feedback">
                      Kurs beli belum diisi
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="jumlah_unit">Jumlah Unit</label>
                  <input type="text" class="form-control @error('jumlah_unit') is-invalid @enderror" id="jumlah_unit" name="jumlah_unit" placeholder="Mau berapa banyak unit yang ingin dimasukkan?" value="{{ old('jumlah_unit') }}" >
                  @error('jumlah_unit')
                    <div class="invalid-feedback">
                      Jumlah unit belum diisi
                    </div>
                  @enderror                  
                </div>
                <div class="form-group my-4">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="" disabled selected>-- is it obsolete or not? --</option>
                    <option value="Not Obsolete" {{ old('status') === "Not Obsolete" ? 'selected' : '' }}>Not Obsolete</option>
                    <option value="Obsolete" {{ old('group') === "Obsolete" ? 'selected' : '' }}>Obsolete</option>
                    <option value="Dummy" {{ old('group') === "Dummy" ? 'selected' : '' }}>Dummy</option>
                  </select>
                  @error('status')
                    <div class="invalid-feedback">
                      Status item belum diisi
                    </div>
                  @enderror
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