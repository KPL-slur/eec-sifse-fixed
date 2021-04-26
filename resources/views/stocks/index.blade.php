@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Shows stocks and their actions')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        {{-- card paling luar --}}
        <div class="card">
          {{-- header read plg luar --}}
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Table Inventory and their actions</h4>
            @is_admin()
              <p class="card-category">Here you can make new Item row, edit specific Item, or delete them.</p>
            @endis_admin
          </div>

          {{-- body paling luar --}}
          <div class="card-body">
            @is_admin()
              <p class="text-center">Current Exchange Rates : <div class="text-primary text-center display-4">Rp {{ $rate_fix }}</div></p>
              <div class="text-right">
                {{-- button modal trigger  --}}
                <button type="button" rel="tooltip" title="print data" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal_input_stocks_report">
                  <i class="material-icons">print</i>
                </button>
                {{-- for create button --}}
                <a type="button" rel="tooltip" title="add item" class="btn btn-md btn-outline-primary text-right m-4 " href="{{ url('stocks/create/') }}">
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
                      <h5 class="modal-title">Print</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="input_date_start_stocks_report">Date Start</label>
                        <input type="date" name="input_date_start_stocks_report" id="input_date_start_stocks_report" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="input_date_end_stocks_report">Date End</label>
                        <input type="date" name="input_date_end_stocks_report" id="input_date_end_stocks_report" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                      <a href="#" id="button_stocks_report" class="btn btn-success px-3" style="pointer-events: none;">Print!</a>
                    </div>
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
            @endis_admin

                <div class="row">
                  <div class="col">
                    <div class="table-responsive material-datatables ">
                      <x-ui.spinner id="spinner" className="spinner-center"/><br>
                      <table class="table none table-striped table-no-bordered table-hover d-none" cellspacing="0" width="100" style="width:100%" id="indexStocksTable">
                        <thead class=" text-primary text-middle">
                          <tr>
                            <th class="disabled-sorting"></th>
                            <th>Item Name</th>
                            <th>Item's Group</th>
                            <th>Part Number</th>
                            <th>Ref Des</th>
                            <th>Date of Entry</th>
                            <th>Expired</th>
                            <th>Buying Rate</th>
                            <th>Number of Units</th>
                            <th>Status</th>
                            <th>Item's Information</th>
                            @is_admin()
                              <th class="disabled-sorting text-center">Actions</th>
                            @endis_admin
                          </tr>
                        </thead>
                          <tbody>
                            @foreach ($stocks as $st)
                              <tr>
                                <td></td>
                                <td>{{ $st->nama_barang }}</td>
                                <td>{{ $st->group }}</td>
                                <td>{{ $st->part_number }}</td>
                                <td>{{ $st->ref_des }}</td>
                                <td>{{ $st->tgl_masuk }}</td>
                                <td>{{ $st->expired }}</td>
                                <td>{{ $st->kurs_beli }}</td>
                                <td class="text-center">{{ $st->jumlah_unit }}</td>
                                <td>{{ $st->status }}</td>
                                <td>{{ $st->keterangan }}</td>
                                @is_admin()
                                  <td class="td-actions text-center">
                                    <a rel="tooltip" class="btn btn-sm btn-warning m-2" href="{{ url('stocks') }}/{{ $st->stock_id }}/edit" type="submit">
                                      <i class="material-icons">edit</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    <form action="{{ url('stocks') }}/{{ $st->stock_id }}" class="d-inline" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button type="submit" class="btn btn-sm btn-danger m-2" title="delete" onclick="return confirm('Are you sure you want to delete '+ '{{ $st->nama_barang }}' +' from sparepart list ?')">
                                        <i class="material-icons">delete</i>
                                        <div class="ripple-container"></div>
                                      </button>
                                    </form>
                                  </td>
                                @endis_admin
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </div>
                    {{-- table-responsive --}}
                  </div>
                  </div>
                </div>

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

{{-- script for dynamic table from select group --}}
@push('scripts')
  @is_admin()
    {{-- script for modal input stocks report--}}
    <script>
      var url_stocks_report = "stocks/print?";
      var url_stocks_repot_date_start = "date-start=";
      var iterator_date_start = 0;
      var url_stocks_repot_date_end = "&date-end=";
      var iterator_date_end = 0;

      $('#input_date_start_stocks_report').on('input', (e) => {
        if (iterator_date_start === 0){ // kalo baru pertama kali ke-detect on input
          url_stocks_repot_date_start = url_stocks_repot_date_start + e.target.value; //masukin input ke url_date_start
          $('#input_date_end_stocks_report').prop("disabled", false); //nyalain input_date_end
          iterator_date_start++;
        } else {
          url_stocks_repot_date_start = "date-start=" + e.target.value;
          url_stocks_report = "stocks/print?" + url_stocks_repot_date_start + url_stocks_repot_date_end;
          $("#button_stocks_report").prop('href', url_stocks_report);
        }
      });

      $('#input_date_end_stocks_report').on('input', (e) => {
        if (iterator_date_end === 0){ // kalo baru pertama kali ke-detect on input
          url_stocks_repot_date_end = url_stocks_repot_date_end + e.target.value; //masukin input ke url_date_end
          if(url_stocks_report.indexOf("date-start")){ //ngecek string date-start ada di dalem url stock report ga.
          // ini gr2 error kl 2x input date start berurutan, 1x input date end
            url_stocks_report = "stocks/print?" + url_stocks_repot_date_start + url_stocks_repot_date_end;
          } else {
            url_stocks_report = url_stocks_report + url_stocks_repot_date_start + url_stocks_repot_date_end;
          }
          $("#button_stocks_report").css('pointer-events', ''); //bikin button print bisa di point
          $("#button_stocks_report").prop('target', '_blank'); //biar pas button di click ke tab baru
          iterator_date_end++;
        } else {
          url_stocks_repot_date_end = "&date-end=" + e.target.value;
          url_stocks_report = "stocks/print?" + url_stocks_repot_date_start + url_stocks_repot_date_end;
        }
        $("#button_stocks_report").prop('href', url_stocks_report); //taro sini krn gapeduli pertama kali ke-detect on input atau ngga, pasti bakal jalan
      });

      //kalo misalkan modal ditutup
      $('#modal_input_stocks_report').on('hide.bs.modal', () => {
        confirm_close = confirm('Are you sure you want to close the input?\nAll input dates will be reset');
        if(confirm_close == true){
          if( $('#input_date_start_stocks_report').val() != "" || $('#input_date_end_stocks_report').val() != "" ){ //value dari value nya ada apa ngga
            $('#input_date_start_stocks_report').val(""); //ngosongin value input date start
            $('#input_date_end_stocks_report').val(""); //ngosongin value input date end
            $('#button_stocks_report').css('pointer-events', 'none'); //bikin button print gabisa di point
            $('#input_date_end_stocks_report').prop("disabled", true); //matiin input date end
            iterator_date_start = 0; //inisialisasi lagi iterator date start
            iterator_date_end = 0; //inisialisasi lagi iterator date end
          }
        }
      });

      $("#modal_input_stocks_report").on("hidden.bs.modal", () => {
        if(confirm_close == false){
          $("#modal_input_stocks_report").modal('show');
        }
      });
      
    </script>
    {{-- script for modal input stocks report --}}
  @endis_admin
  {{-- script for datatable --}}
  <script>
    $(document).ready( () => {
      $("#indexStocksTable").DataTable({
        "pagingType": "numbers",
        "lengthMenu": [
          [10, 25, 50, 100, 250, 500],
          [10, 25, 50, 100, 250, 500]
        ],
        responsive: true,
        "columnDefs": [
          { className: "none", "targets": [ 3, 4, 5, 6, 10 ] }
        ],
        language: {
          searchPlaceholder: "Search stock records",
        }
      });
      $('#spinner').addClass('d-none');
      $("#indexStocksTable").removeClass('d-none');
    });
  </script>
  {{-- script for datatable --}}

@endpush

@endsection