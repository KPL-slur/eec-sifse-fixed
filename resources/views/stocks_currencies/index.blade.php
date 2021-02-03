@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Stocks and their currencies')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Table Inventory and Exchange Rate</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>
          <div class="card-body">
            <p class="">Harga Kurs Sekarang : <span class="text-primary">$1000</span></p>
            <div class="text-right">
              <a class="btn btn-sm btn-primary text-right" href="{{ route('stock_currency_create') }}">Add Inventory</a>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary text-middle">
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Tanggal Masuk</th>
                  <th>Kurs Saat Membeli</th>
                  <th>Sisa Stok</th>
                  <th>Status</th>
                  <th class="text-center">Update or delete</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($stocks as $st)
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $st->nama_barang }}</td>
                      <td>{{ $st->tgl_masuk }}</td>
                      <td>{{ $st->kurs_beli }}</td>
                      <td>{{ $st->sisa_stok }}</td>
                      <td>{{ $st->status }}</td>
                      <td class="td-actions text-center">
                        <a rel="tooltip" class="btn btn-lg btn-success btn-link" href="#" data-original-title="" title="">
                          <i class="material-icons">edit</i>
                          <div class="ripple-container"></div>
                        </a>
                        <button class="btn btn-lg btn-danger btn-link" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                          <i class="material-icons">delete</i>
                          <div class="ripple-container"></div>
                        </button>
                      </td>
                        
                    @endforeach
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection