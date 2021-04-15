@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Show '.$stock->nama_barang.' details')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Show Inventory</h4>
          </div>
          <div class="card-body">
            <div class="form-group my-4">
              <label for="nama_barang">Nama Barang</label>
              <input type="text" disabled class="form-control " id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{ $stock->nama_barang }}" >
            </div>
            <div class="form-group my-4">
              <label for="group">Group nya</label><br>
              <select name="group" disabled id="group" class="form-control ">
                <option value="" disabled @if($stock->group === "") selected @endif {{ old('group') == '' ? 'selected' : '' }} >-- Pilih jenis barang --</option>
                @foreach ($stocks_group as $sg)
                  <option disabled value="{{$sg}}" @if($sg === $stock->group) selected @endif {{ old('group') == $sg ? 'selected' : '' }}>{{ $sg }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group my-4">
              <label for="part_number">Part Number</label>
              <input type="text" disabled class="form-control" id="part_number" name="part_number" placeholder="Masukkan part number" value="{{ $stock->part_number }}" >
            </div>
            <div class="form-group my-4">
              <label for="ref_des">Ref Des</label>
              <input type="text" disabled class="form-control" id="ref_des" name="ref_des" placeholder="Masukkan Ref Des" value="{{ $stock->ref_des }}" >
            </div>
            <div class="form-group my-4">
              <label for="tgl_masuk">Tanggal Masuk</label>
              <input type="date" disabled class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Input" value="{{ $stock->tgl_masuk }}">
            </div>
            <div class="form-group my-4">
              <label for="expired">Life expectancy</label>
              <input type="date" disabled class="form-control" id="expired" name="expired" placeholder="Expected lifetime" value="{{ $stock->expired }}">
            </div>
            <div class="form-group my-4">
              <label for="kurs_beli">Kurs Beli</label>
              <input type="text" disabled class="form-control" id="kurs_beli" name="kurs_beli" placeholder="Kurs Beli" value="{{ $stock->kurs_beli }}">
            </div>
            <div class="form-group my-4">
              <label for="jumlah_unit">Jumlah Unit</label>
              <input type="text" disabled class="form-control" id="jumlah_unit" name="jumlah_unit" value="{{ $stock->jumlah_unit }}">
            </div>
            <div class="form-group my-4">
                <label for="status">Status</label>
                <select name="status" id="status" disabled class="form-control">
                    <option value="Not Obsolete" disabled @if ($stock->status === "Not Obsolete") selected @endif>Not Obsolete</option>
                    <option value="Obsolete" disabled @if ($stock->status === "Obsolete") selected @endif>Obsolete</option>
                    <option value="Dummy" disabled @if ($stock->status === "Dummy") selected @endif>Dummy</option>
                </select>
            </div>        
            <div class="form-group my-4">
                <label for="keterangan">Keterangan</label>
                <input type="text" disabled class="form-control" id="keterangan" name="keterangan" value="{{ $stock->keterangan }}">
            </div>
            <a href="{{ url('stocks/') }}" class="btn btn-info m-2 d-inline">Kembali</a>
            <a rel="tooltip" class="btn btn-warning m-2" href="{{ url('stocks') }}/{{ $stock->stock_id }}/edit" type="submit">Edit</a>
            <form action="{{ url('stocks') }}/{{ $stock->stock_id }}" class="d-inline" method="POST">
              @method('DELETE')
              @csrf
              <button rel="tooltip" type="submit" class="btn btn-danger m-2" title="delete" onclick="return confirm('Are you sure you want to delete '+ '{{ $stock->nama_barang }}' +'?')">Delete</button>
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