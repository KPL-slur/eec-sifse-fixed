@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Stocks and their currencies')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        {{-- buat oper data stocks ke javascript 'select-group-in-stocks' --}}
        {{-- buat sekarang pake ini dulu, nanti ganti --}}
        {{-- <input type="hidden" id="stockDatas" value="{{ json_encode($stocks) }}"> --}}

        {{-- card paling luar --}}
        <div class="card">
          {{-- header read plg luar --}}
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Table Inventory and Exchange Rate</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>

          {{-- body paling luar --}}
          <div class="card-body">
            <p class="text-center">Harga Kurs Sekarang : <div class="text-primary text-center display-4">Rp {{ $rate_fix }}</div></p>
            <div class="text-right">
              <a class="btn btn-md btn-primary text-right my-4 " href="{{ route('stock_currency_create') }}">Add Inventory</a>
            </div>
            @if (session('status1'))
                <script>
                  window.onload = () => {
                    showNotification('top', 'right', 'success' ,'<?php echo session('status1') ?>');
                  };
                </script>
            @elseif (session('status2'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'warning' ,'<?php echo session('status2') ?>');
                };
              </script>
            @elseif (session('status0'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'danger' ,'<?php echo session('status0') ?>');
                };
              </script>
            @endif

            <div>
              <select name="selectGroupStock" class="form-control m-3" id="selectGroupStock" onchange="selectGroupIndexStocks()" style="max-width:50%;">
                <option selected value="">Semua</option>
                <option value="1" >Transmitter</option>
                <option value="2" >Receiver</option>
                <option value="3" >Antenna</option>
                <option value="0" >Tambahan</option>
            </select>
            </div>
            {{-- card kedua --}}
            <div class="card m-3 my-5">

              {{-- header kedua --}}
              <div class="card-header card-header-rose">
                {{-- <h4 class="card-title">Group 1 transmitter</h4> --}}
                <p class="card-category" id="groupStocksCardHeader">Semua</p>
              </div>

              {{-- card body kedua --}}
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="indexStocksTable">
                    <thead class=" text-primary text-middle">
                      <th>No</th>
                      <th>Lokasi Site</th>
                      <th>Nama Barang</th>
                      <th>Part Number</th>
                      <th>Serial Number</th>
                      <th>Tanggal Masuk</th>
                      <th>Expired</th>
                      <th>Kurs Beli</th>
                      <th>Jumlah Unit</th>
                      <th>Status</th>
                      <th class="text-center">Update or delete</th>
                    </thead>
                      <tbody>
                        @foreach ($stocks as $st)
                          <tr>
                            <input type="hidden" value="{{ $st->group }}">
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{ $st->station_id }}</td>
                            <td>{{ $st->nama_barang }}</td>
                            <td>{{ $st->part_number }}</td>
                            <td>{{ $st->serial_number }}</td>
                            <td>{{ $st->tgl_masuk }}</td>
                            <td>{{ $st->expired }}</td>
                            <td>{{ $st->kurs_beli }}</td>
                            <td>{{ $st->jumlah_unit }}</td>
                            <td>{{ $st->status }}</td>
                            <td class="td-actions text-center">
                              <a rel="tooltip" class="btn btn-lg btn-warning m-2" href="{{ url('stock_currency') }}/{{ $st->stock_id }}/edit" type="submit">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              <form action="{{ url('stock_currency') }}/{{ $st->stock_id }}" class="d-inline" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-lg btn-danger m-2" onclick="return confirm('Are you sure you want to delete '+ '{{ $st->nama_barang }}' +'?')">
                                  <i class="material-icons">delete</i>
                                  <div class="ripple-container"></div>
                                  </button>
                              </form>
                              {{-- <button class="btn btn-lg btn-danger m-2" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="material-icons">delete</i>
                                <div class="ripple-container"></div>
                              </button> --}}
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
                {{-- table-responsive --}}
              </div>
              {{-- card body kedua --}}
            </div>
            {{-- card kedua --}}

          </div>
          {{-- body paling luar --}}
        </div>
        {{-- card paling luar --}}
      </div>
      {{-- col --}}
    </div>
    {{-- row --}}
  </div>
  {{-- container-fluid --}}
</div>
{{-- content --}}
@endsection