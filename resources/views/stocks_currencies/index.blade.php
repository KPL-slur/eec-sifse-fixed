@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Stocks and their currencies')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        {{-- card paling luar --}}
        <div class="card">
          {{-- header read plg luar --}}
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Table Inventory and Exchange Rate</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>

          {{-- body paling luar --}}
          <div class="card-body">
            <button class="btn"type="button" onclick="showNotification('top', 'right', 'test')">oi</button>
            <p class="text-center">Harga Kurs Sekarang : <div class="text-primary text-center display-4">Rp {{ $rates->rates->IDR }}</div></p>
            <div class="text-right">
              <a class="btn btn-sm btn-primary text-right" href="{{ route('stock_currency_create') }}">Add Inventory</a>
            </div>
            @if (session('status1'))
                <script>
                  window.onload = () => {
                    showNotification('top', 'right', 'success' ,'<?php echo session('status1') ?>');
                  };
                </script>
                {{-- <div class="alert alert-success">
                  {{ session('status1') }}
                </div> --}}
            @endif
            @if (session('status2'))
                <div class="alert alert-warning">
                  {{ session('status2') }}
                </div>
            @endif

            @php
                $i1 = $i2 = $i3 = 1;
            @endphp

            @foreach ($stocks as $st)
                @if ($st->group == 1)
                  @if ($i1 == 1)
                    {{-- card kedua --}}
                    <div class="card ">

                      {{-- header kedua --}}
                      <div class="card-header card-header-rose">
                        <h4 class="card-title">Group 1 transmitter</h4>
                        <p class="card-category">sub</p>
                      </div>

                      {{-- card body kedua --}}
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
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
                  @endif            
                                <tr>
                                  <td scope="row">{{$i1}}</td>
                                  <td>{{ $st->site }}</td>
                                  <td>{{ $st->nama_barang }}</td>
                                  <td>{{ $st->part_number }}</td>
                                  <td>{{ $st->serial_number }}</td>
                                  <td>{{ $st->tgl_masuk }}</td>
                                  <td>{{ $st->expired }}</td>
                                  <td>{{ $st->kurs_beli }}</td>
                                  <td>{{ $st->jumlah_unit }}</td>
                                  <td>{{ $st->status }}</td>
                                  <td class="td-actions text-center">
                                    <a rel="tooltip" class="btn btn-lg btn-warning " href="{{ url('stock_currency') }}/{{ $st->stock_id }}/edit" type="submit">
                                      <i class="material-icons">edit</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    <button class="btn btn-lg btn-danger " onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                      <i class="material-icons">delete</i>
                                      <div class="ripple-container"></div>
                                    </button>
                                  </td>
                                </tr>
                              </tbody>
                  @if ($i1 == 1)
                          </table>
                        </div>
                        {{-- table-responsive --}}
                      </div>
                      {{-- card body kedua --}}
                    </div>
                    {{-- card kedua --}}
                  @endif
                  @php
                      $i1++;
                  @endphp
                @elseif ($st->group == 2)
                  @if ($i2 == 1)
                    {{-- card ketiga --}}
                    <div class="card ">

                      {{-- header ketiga --}}
                      <div class="card-header card-header-rose">
                        <h4 class="card-title">Group 2 receiver</h4>
                        <p class="card-category">sub</p>
                      </div>

                      {{-- card body ketiga --}}
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
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
                  @endif            
                            <tbody>
                                <tr>
                                  <td scope="row">{{$i2}}</td>
                                  <td>{{ $st->site }}</td>
                                  <td>{{ $st->nama_barang }}</td>
                                  <td>{{ $st->part_number }}</td>
                                  <td>{{ $st->serial_number }}</td>
                                  <td>{{ $st->tgl_masuk }}</td>
                                  <td>{{ $st->expired }}</td>
                                  <td>{{ $st->kurs_beli }}</td>
                                  <td>{{ $st->jumlah_unit }}</td>
                                  <td>{{ $st->status }}</td>
                                  <td class="td-actions text-center">
                                    <a rel="tooltip" class="btn btn-lg btn-warning " href="{{ url('stock_currency') }}/{{ $st->stock_id }}/edit" type="submit">
                                      <i class="material-icons">edit</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    <button class="btn btn-lg btn-danger " onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                      <i class="material-icons">delete</i>
                                      <div class="ripple-container"></div>
                                    </button>
                                  </td>
                                </tr>
                              </tbody>
                  @if ($i2 == 1)
                          </table>
                        </div>
                        {{-- table-responsive --}}
                      </div>
                      {{-- card body ketiga --}}
                    </div>
                    {{-- card ketiga --}}
                  @endif
                  @php
                      $i2++;
                  @endphp
                @elseif ($st->group == 3)
                  @if ($i3 == 1)
                    {{-- card keempat --}}
                    <div class="card ">

                      {{-- header keempat --}}
                      <div class="card-header card-header-rose">
                        <h4 class="card-title">Group 3 antenna</h4>
                        <p class="card-category">sub</p>
                      </div>

                      {{-- card body keempat --}}
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
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
                  @endif
                              <tbody>
                                <tr>
                                  <td scope="row">{{$i3}}</td>
                                  <td>{{ $st->site }}</td>
                                  <td>{{ $st->nama_barang }}</td>
                                  <td>{{ $st->part_number }}</td>
                                  <td>{{ $st->serial_number }}</td>
                                  <td>{{ $st->tgl_masuk }}</td>
                                  <td>{{ $st->expired }}</td>
                                  <td>{{ $st->kurs_beli }}</td>
                                  <td>{{ $st->jumlah_unit }}</td>
                                  <td>{{ $st->status }}</td>
                                  <td class="td-actions text-center">
                                    <a rel="tooltip" class="btn btn-lg btn-warning " href="{{ url('stock_currency') }}/{{ $st->stock_id }}/edit" type="submit">
                                      <i class="material-icons">edit</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    <button class="btn btn-lg btn-danger " onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                      <i class="material-icons">delete</i>
                                      <div class="ripple-container"></div>
                                    </button>
                                  </td>
                                </tr>
                              </tbody>
                  @if ($i3 == 1)    
                          </table>
                        </div>
                        {{-- table-responsive --}}
                      </div>
                      {{-- card body keempat --}}
                    </div>
                    {{-- card keempat --}}
                  @endif
                  @php
                      $i3++;
                  @endphp
                @endif
            @endforeach

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