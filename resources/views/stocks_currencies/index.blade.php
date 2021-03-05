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
            <p class="text-center">Harga Kurs Sekarang : <div class="text-primary text-center display-4">Rp {{ $rate_fix }}</div></p>
            <div class="text-right">
              {{-- button modal trigger  --}}
              <button type="button" rel="tooltip" title="print data" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal_input_stocks_report">
                <i class="material-icons">print</i>
              </button>
              {{-- for create button --}}
              <a type="button" rel="tooltip" title="add item" class="btn btn-md btn-outline-primary text-right m-4 " href="{{ route('stock_currency_create') }}">
                <i class="material-icons">note_add</i>
              </a>
              {{-- for recommendatio item --}}
              <a type="button" rel="tooltip" title="recommendation item" class="btn btn-md btn-outline-primary text-right m-8 " href="{{ route('recommendation') }}">
                <i class="material-icons">shopping_basket</i>
              </a>
            </div>

            {{-- for modal --}}
            <div class="modal fade" id="modal_input_stocks_report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="input_date_start_stocks_report">Tanggal Awal</label>
                      <input type="date" name="input_date_start_stocks_report" id="input_date_start_stocks_report" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="input_date_end_stocks_report">Tanggal Akhir</label>
                      <input type="date" name="input_date_end_stocks_report" id="input_date_end_stocks_report" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button id="reset_input_stocks_report" type="button" class="btn btn-warning">Reset!</button>
                    <a href="#" id="link_stocks_report" class="btn btn-success" style="pointer-events: none;">Input tanggal awal dan akhir!</a>
                  </div>

                  {{-- script for modal input --}}
                  <script>
                    const id_input_date_start = document.getElementById("input_date_start_stocks_report");
                    const id_input_date_end = document.getElementById("input_date_end_stocks_report");
                    var button_input = document.getElementById("link_stocks_report");
                    var href_input_js = button_input.href;
                    href_input_js = "stock_currency/";
                    var href_input_start, href_input_end;

                    const input_date_start = id_input_date_start.addEventListener("input", (e) => {
                      href_input_start = e.target.value;
                      href_input_js = href_input_js + href_input_start + '/';
                      id_input_date_end.disabled = false;
                    });
                    const input_date_end = id_input_date_end.addEventListener("input", (e) => {
                      href_input_end = e.target.value;
                      href_input_js = href_input_js + href_input_end;
                      button_input.href = href_input_js;
                      button_input.style.pointerEvents = "";
                      button_input.innerHTML = "Report!";
                      button_input.target = "_blank";
                    });
                    
                    window.onload = () => {
                      // kalo teken button reset
                      $('#reset_input_stocks_report').on('click', function(){
                        alert("every input will be resetted");
                        id_input_date_start.value = "";
                        id_input_date_end.value = "";
                        button_input.innerHTML = "Input tanggal awal dan akhir!";
                      });

                      // kalo modal ditutup
                      $('#modal_input_stocks_report').on('hide.bs.modal', function(){
                        if (id_input_date_end.value != "" || id_input_date_start.value != ""){
                          alert('every date input will be deleted');
                          $('#input_date_start_stocks_report').val("");
                          $('#input_date_end_stocks_report').val("");
                          $('#link_stocks_report').css('pointer-events', 'none');
                          $('#input_date_end_stocks_report').prop("disabled", true);
                          $('#link_stocks_report').html("Input tanggal awal dan akhir!");
                          href_input_js = "stock_currency/";
                        }
                      });
                    }
                  </script>
                  {{-- script for modal input --}}

                </div>
              </div>
            </div>
            {{-- for end modal --}}

            {{-- success created new sparepart --}}
            @if (session('status1'))
                <script>
                  window.onload = () => {
                    showNotification('top', 'right', 'success' ,'<?php echo session('status1') ?>');
                  };
                </script>
            {{-- success edited sparepart --}}
            @elseif (session('status2'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'warning' ,'<?php echo session('status2') ?>');
                };
              </script>
            {{-- success deleted sparepart --}}
            @elseif (session('status0'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'danger' ,'<?php echo session('status0') ?>');
                };
              </script>
            @endif

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
                  <table class="table" id="indexStocksTable">
                    <thead class=" text-primary text-middle">
                      <th>No</th>
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
                                <button type="submit" class="btn btn-lg btn-danger m-2" title="delete" onclick="return confirm('Are you sure you want to delete '+ '{{ $st->nama_barang }}' +'?')">
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