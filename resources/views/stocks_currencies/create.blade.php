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
                <p class="mb-4 text-center h3">Harga Kurs Sekarang : <span class="text-primary">$1000</span></p>
                <form>
                    <div class="form-group my-4">
                      <label for="nama_barang">Nama Barang</label>
                      <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan nama barang">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group my-4">
                      <label for="tgl_masuk">Tanggal Masuk / Edit</label>
                      <input type="date" class="form-control" id="tgl_masuk" placeholder="Tanggal Input">
                    </div>
                    <div class="form-group my-4">
                      <label for="kurs_beli">Kurs Beli</label>
                      <input type="text" class="form-control" id="kurs_beli" placeholder="Kurs Beli">
                    </div>
                    <div class="form-group my-4">
                      <label for="sisa_stok">Sisa Stok</label>
                      <input type="text" class="form-control" id="sisa_stok" placeholder="Stok yg ada">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <a href="{{ url('stock_currency/') }}" class="btn btn-info">Kembali</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection