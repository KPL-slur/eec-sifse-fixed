@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Detail Inventory')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        {{-- card paling luar --}}
        <div class="card">
          {{-- header read plg luar --}}
          <div class="card-header card-header-primary">
              <h4 class="card-title">Table Part of {{$sites->radar_name}}</h4>
          </div>

          {{-- body paling luar --}}
          <div class="card-body">
            

            <div class="text_left">
                <a type="button" href="/site" class="btn btn-info btn-md ml-3">Back</a>
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
            

            {{-- <div>
              <select name="selectGroupStock" class="form-control m-3" id="selectGroupStock" style="max-width:15%;">
                <option selected value="">Semua</option>
                @foreach ($stocks_group as $group)
                    <option value="{{$group}}">{{$group}}</option>
                @endforeach
              </select>
            </div> --}}

            {{-- card kedua --}}
            <div class="card m-3 my-5">

              {{-- header kedua --}}
              <div class="card-header card-header-rose">
                {{-- <p class="card-category" id="groupStocksCardHeader">Semua</p> --}}
              </div>

              {{-- card body kedua --}}
              <div class="card-body">
                <div class="row">

                  <div class="col material-datatables">
                    <x-ui.spinner id="spinner" className="spinner-center"/>
                    <table class="table none table-striped table-no-bordered table-hover d-none" cellspacing="0" width="100%" style="width: 100%" id="indexStocksTable">
                      <thead class=" text-primary text-middle">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama Barang</th>
                          <th scope="col">Part Number</th>
                          <th scope="col">Ref_des</th>
                          <th scope="col">Tanggal Masuk</th>
                          <th scope="col">Expired</th>
                          <th class="disabled-sorting text-center">Update or Delete</th>
                        </tr>
                      </thead>

                        <tbody>
                         
                            @foreach ($stocks as $st)
                              <tr>
                                {{-- <input type="hidden" value="{{ $st->group }}"> --}}
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{ $st->nama_barang }}</td>
                                <td>{{ $st->part_number }}</td>
                                <td>{{ $st->ref_des }}</td>
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
                                    <button type="submit" class="btn btn-lg btn-danger m-2" title="delete" onclick="return confirm('Are you sure you want to delete '+ '{{ $st->nama_barang }}' +'from this site ?')">
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
                  {{--  --}}
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
{{-- dynamic year select --}}

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

<script>
    $(document).ready( function () {
        $('#indexStocksTable').DataTable({
            "pagingType": "numbers",
            "lengthMenu": [
                [10, 25, 50, 100, 250, 500],
                [10, 25, 50, 100, 250, 500]
            ],
            responsive: true,
            language: {
            searchPlaceholder: "Search records",
            }
        });
        $('#spinner').addClass('d-none');
        $('#indexStocksTable').removeClass('d-none');
    });
</script>


@endpush
@endsection