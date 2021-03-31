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
              <a type="button" rel="tooltip" title="add item" class="btn btn-md btn-outline-primary text-right m-4 " href="{{ route('stocks-create') }}">
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

            <div>
              <select name="selectGroupStock" class="form-control m-3" id="selectGroupStock" style="max-width:15%;">
                <option selected value="">Semua</option>
                @foreach ($stocks_group as $sg)
                  <option value="{{$sg}}">{{ $sg }}</option>
                @endforeach
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
                <div class="row">
                    <div class="col table-responsive-lg">
                      <table class="table d-none" id="indexStocksTable">
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
                                  <a rel="tooltip" class="btn btn-lg btn-warning m-2" href="{{ url('stocks') }}/{{ $st->stock_id }}/edit" type="submit">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <form action="{{ url('stocks') }}/{{ $st->stock_id }}" class="d-inline" method="POST">
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
                          </tbody>
                      </table>
                    </div>
                    {{-- table-responsive --}}
                  </div>
                </div>
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

{{-- script for dynamic table from select group --}}
@push('scripts')
  <script>
      $("#selectGroupStock").change(()=>{

        var stock_group = JSON.parse('<?php echo json_encode($stocks_group)?>');

        var input, header, table, tr, td, i, j;
        // dropdown name
        input = document.getElementById("selectGroupStock").value;
        // dynamic header
        header = document.getElementById("groupStocksCardHeader");
        // table id
        table = document.getElementById("indexStocksTable");
        // import row
        tr = table.getElementsByTagName("tr");
        // mulai dari 1 karena tr yg pertama tuh cuma no, namabarang dll
        for (i = 1; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("input")[0].value;
          if (td){
            if (input == td || input == ""){
              tr[i].style.display = "";
                stock_group.forEach((group) => {
                  if (input == ""){
                    header.innerHTML = "Semua";
                  } else if (input == group){
                    header.innerHTML = group;
                  }
                });
            } else {
              tr[i].style.display = "none";
            }
          } 
        }
      });
  </script>
  {{-- script for dynamic table from select group --}}

  {{-- script for modal input stocks report--}}
  <script>
    let url_stocks_report = "print?";
    let url_stocks_repot_date_start = "date-start=";
    let iterator_date_start = 0;
    let url_stocks_repot_date_end = "&date-end=";
    let iterator_date_end = 0;

    $('#input_date_start_stocks_report').on('input', (e) => {
      if (iterator_date_start === 0){ // kalo baru pertama kali ke-detect on input
        url_stocks_repot_date_start = url_stocks_repot_date_start + e.target.value; //masukin input ke url_date_start
        $('#input_date_end_stocks_report').prop("disabled", false); //nyalain input_date_end
        iterator_date_start++;
      } else {
        url_stocks_repot_date_start = "date-start=" + e.target.value;
        url_stocks_report = "print?" + url_stocks_repot_date_start + url_stocks_repot_date_end;
        $("#button_stocks_report").prop('href', url_stocks_report);
      }
    });

    $('#input_date_end_stocks_report').on('input', (e) => {
      if (iterator_date_end === 0){ // kalo baru pertama kali ke-detect on input
        url_stocks_repot_date_end = url_stocks_repot_date_end + e.target.value; //masukin input ke url_date_end
        if(url_stocks_report.indexOf("date-start")){ //ngecek string date-start ada di dalem url stock report ga.
        // ini gr2 error kl 2x input date start berurutan, 1x input date end
          url_stocks_report = "print?" + url_stocks_repot_date_start + url_stocks_repot_date_end;
        } else {
          url_stocks_report = url_stocks_report + url_stocks_repot_date_start + url_stocks_repot_date_end;
        }
        $("#button_stocks_report").css('pointer-events', ''); //bikin button print bisa di point
        $("#button_stocks_report").prop('target', '_blank'); //biar pas button di click ke tab baru
        iterator_date_end++;
      } else {
        url_stocks_repot_date_end = "&date-end=" + e.target.value;
        url_stocks_report = "print?" + url_stocks_repot_date_start + url_stocks_repot_date_end;
      }
      $("#button_stocks_report").prop('href', url_stocks_report); //taro sini krn gapeduli pertama kali ke-detect on input atau ngga, pasti bakal jalan
    });

    //kalo misalkan modal ditutup
    $('#modal_input_stocks_report').on('hide.bs.modal', () => {
      confirm_close = confirm('Apakah Anda yakin ingin menutup input?\nSemua tanggal input akan di-reset');
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
  
  <script>
    $(document).ready( () => {
      $("#indexStocksTable").DataTable();
      $("#indexStocksTable").removeClass('d-none');
    });
  </script>

@endpush

@endsection