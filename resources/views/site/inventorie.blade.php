@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Detail Inventorie')])

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
              <h4 class="card-title">Table Inventory {{$sites->radar_name}}</h4>
          </div>

          {{-- body paling luar --}}
          <div class="card-body">
            
                      
            <div class="col-12 text-left">
              <select class="btn btn-primary" name="selectGroupStock" class="form-control m-3" id="selectGroupStock" onchange="selectGroupIndexStocks()" style="max-width:15%;">
                <option selected value="">Semua</option>
                <option value="1" >Transmitter</option>
                <option value="2" >Receiver</option>
                <option value="3" >Antenna</option>
                <option value="0" >Tambahan</option>
              </select>
            </div>
            
            <div class="col-12 text-right">
                      
              <a rel="tooltip" class="btn btn-success" type="button" href="{{ url('inventorySite') }}/{{$stocks[0]->site_id}}">
                <i class="material-icons">
                  local_printshop
                </i> Print Data
              </a>
      
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
                  <table class="table table-bordered" id="indexStocksTable">
                    <thead class=" text-primary text-middle">
                      <th>#</th>
                      <th>Nama Barang</th>
                      <th>Part Number</th>
                      <th>Serial Number</th>
                      <th>Tanggal Masuk</th>
                      <th>Expired</th>
                    </thead>
                      <tbody>
                        @foreach ($stocks as $st)
                          <tr>
                            <input type="hidden" value="{{ $st->group }}">
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{ $st->nama_barang }}</td>
                            <td>{{ $st->part_number }}</td>
                            <td>{{ $st->serial_number }}</td>
                            <td>{{ $st->tgl_masuk }}</td>
                            <td>{{ $st->expired }}</td>
                              
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

{{-- @section('content')
<div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Inventory</h4>
                <p class="card-category"> Here you can manage inventory</p>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-12 text-left">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Item Utama
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <button class="btn btn-primary dropdown-item" type="button">ITEM PENDUKUNG</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 text-right">
                      
                        <a rel="tooltip" class="btn btn-success" type="button" href="{{ url('inventorySite') }}/{{ $id }}">
                          <i class="material-icons">
                            local_printshop
                          </i> Print Data
                        </a>
                
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-stk">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sparepart</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Installed Date</th>
                            <th scope="col">Expired Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($stocks as $stk)
                            <tr>
                              <th scope="row">{{$loop->iteration}}</th>
                              <td>{{$stk->nama_barang}}</td>
                              <td>{{$stk->part_number}}</td>
                              <td>{{$stk->serial_number}}</td>
                              <td>{{$stk->tgl_masuk}}</td>
                              <td>{{$stk->expired}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection --}}