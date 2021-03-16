@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Detail Inventory')])

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
            

              <div class="text_left">
                <a title="back" class="btn btn-sm btn-primary m-2" href="/site">
                  <i class="material-icons">arrow_back</i>
                  <div class="ripple-container"></div>
                </a>
              </div>
              
              <div class="text-right">
                {{-- button modal trigger  --}}
                <a type="button" rel="tooltip" title="print data" class="btn btn-outline-primary" href="{{ url('inventorySite') }}/{{$sites->site_id ?? ''}}" >
                  <i class="material-icons">print</i>
                </a>
                {{-- for create button --}}
                <a type="button" rel="tooltip" title="add item" class="btn btn-md btn-outline-primary text-right m-4 " href="/addInventorySite/{{$sites->site_id ?? ''}}">
                  <i class="material-icons">note_add</i>
                </a>
              </div>
            

            <div>
              <select name="selectGroupStock" class="form-control m-3" id="selectGroupStock" onchange="selectGroupIndexStocks()" style="max-width:15%;">
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
                  <table class="table table-striped" id="indexStocksTable">
                    <thead class=" text-primary text-middle">
                      <th>#</th>
                      <th>Nama Barang</th>
                      <th>Part Number</th>
                      <th>Serial Number</th>
                      <th>Tanggal Masuk</th>
                      <th>Expired</th>
                      <th class="text-center">Update or Delete</th>
                    </thead>
                      <tbody>
                        @if ($stocks)
                          @foreach ($stocks as $st)
                            <tr>
                              <input type="hidden" value="{{ $st->group }}">
                              <td scope="row">{{$loop->iteration}}</td>
                              <td>{{ $st->nama_barang }}</td>
                              <td>{{ $st->part_number }}</td>
                              <td>{{ $st->serial_number }}</td>
                              <td>{{ $st->tgl_masuk }}</td>
                              <td>{{ $st->expired }}</td>
                              <td class="td-actions text-center">
                                <a title="edit" class="btn btn-lg btn-warning m-2" href="/editInventorySite/{{$st->sited_stock_id}}" type="submit">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                                </a>
                                
                                <form action="/deleteInventorySite/{{$st->sited_stock_id}}" class="d-inline" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-lg btn-danger m-2" title="delete" onclick="return confirm('Are you sure you want to delete '+ '{{ $st->nama_barang }}' +'?')">
                                    <i class="material-icons">delete</i>
                                    <div class="ripple-container"></div>
                                    </button>
                
                                </form>
                              </td> 
                              
                            </tr>
                          @endforeach
                            
                        @endif
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
      @elseif (session('status3'))
      <script>
        window.onload = () => {
          showNotification('top', 'right', 'danger' ,'<?php echo session('status3') ?>');
        };
      </script>
      @endif
      {{-- col --}}
    </div>
    {{-- row --}}
  </div>
  {{-- container-fluid --}}
</div>
{{-- content --}}
@endsection