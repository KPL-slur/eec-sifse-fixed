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
            <h4 class="card-title ">Recommendations Item</h4>
          </div>

          {{-- body paling luar --}}
          <div class="card-body">

            <div class="d-flex ">
              <a href="{{ url('stocks/') }}" class="btn btn-info ml-3 d-inline">Kembali</a>
              <select name="selectYearStock" class="form-control ml-auto d-inline" id="selectYearStock" style="max-width:15%;">
                <option selected value="">Semua</option>
                @foreach ($rcm_year as $rcm)
                    <option value="{{$rcm}}">{{$rcm}}</option>
                @endforeach
              </select>
            </div>

            {{-- card kedua --}}
            <div class="card m-3 my-5">

              {{-- header kedua --}}
              <div class="card-header card-header-rose">
                {{-- <h4 class="card-title">2020 year</h4> --}}
                <p class="card-category" id="yearRecommendsCardHeader">Semua</p>
              </div>

              {{-- card body kedua --}}
              <div class="table-responsive">
                <table class="table table-striped" id="indexRecommendsTable" >

                  <thead class=" text-primary text-middle">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Radar Name</th>
                      <th scope="col">Station ID</th>
                      <th scope="col">Nama Barang</th>
                      {{-- <th scope="col">Part Number</th>
                      <th scope="col">Serial Number</th> --}}
                      {{-- <th scope="col">Stock Quantity</th> --}}
                      <th scope="col">Amount Required</th>
                      {{-- <th scope="col">Status</th> --}}
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($recommendations as $rcm)
                      <tr>
                        <input type="hidden" value="{{ $rcm->year }}">
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$rcm->radar_name}}</td>
                        <td>{{$rcm->station_id}}</td>
                        <td>{{$rcm->name}}</td>
                        {{-- <td>{{$rcm->part_number}}</td>
                        <td>{{$rcm->serial_number}}</td> --}}
                        {{-- <td>{{$rcm->jumlah_unit}}</td> --}}
                        <td>{{$rcm->jumlah_unit_needed}}</td>
                        {{-- <td>{{$rcm->status}}</td> --}}
                        <td class="td-actions text-center">

                          <a title="edit" class="btn btn-lg btn-warning m-2" href="" type="submit">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                          </a>

                          <form method="POST" action=" " class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" title="delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
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

@push('scripts')

{{-- script for dynamic table from select year --}}
<script>
  window.onload = () => {
    $("#selectYearStock").change(()=>{

      var rcm_years = JSON.parse('<?php echo json_encode($rcm_year)?>');
      var input, header, table, tr, td, i, j;
      // dropdown name
      input = document.getElementById("selectYearStock").value;
      // dynamic header
      header = document.getElementById("yearRecommendsCardHeader");
      // table id
      table = document.getElementById("indexRecommendsTable");
      // import row
      tr = table.getElementsByTagName("tr");
      // mulai dari 1 karena tr yg pertama tuh cuma no, radarname dll
      for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("input")[0].value;
        console.log(td);
        if (td){
          // console.log("test");
          if (input == td || input == ""){
            tr[i].style.display = "";
              rcm_years.forEach((year) => {
                if (input == ""){
                  header.innerHTML = "Semua";
                } else if (input == year){
                  header.innerHTML = year;
                }
              });
          } 
          else {
            tr[i].style.display = "none";
          }
        } 
      }
    });
  };
</script>
<script>
  $(document).ready(function(){
      $("#indexRecommendsTable").DataTable();
  });
</script>
@endpush

@endsection
{{-- @section('content')
    
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Recommendations Item</h4>
            </div>
            <div class="card-body">
              
              <div>
                <select name="selectYearStock" class="form-control m-3" id="selectYearStock" onchange="selectYearIndexStocks()" style="max-width:15%;">
                  <option selected value="">Semua</option>
                  <option value="1" >2020</option>
                  <option value="2" >2021</option>
                  <option value="3" >2022</option>
                  <option value="0" ></option>
              </select>
              </div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class=" text-primary">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Radar Name</th>
                    <th scope="col">Station ID</th>
                    <th scope="col">Part Number</th>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Stock Quantity</th>
                    <th scope="col">Amount Required</th>
                    <th scope="col">Status</th>
                    <th class="text-right">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($recommendations as $rcm)
                        
                      <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$rcm->radar_name}}</td>
                        <td>{{$rcm->station_id}}</td>
                        <td>{{$rcm->part_number}}</td>
                        <td>{{$rcm->serial_number}}</td>
                        <td>{{$rcm->jumlah_unit}}</td>
                        <td>{{$rcm->jumlah_unit_needed}}</td>
                        <td>{{$rcm->status}}</td>
                          
                        <td class="td-actions text-right">
                                
                            <a rel="tooltip" class="btn btn-lg btn-warning m-2" href="" type="submit">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                            </a>

                              <form method="POST" action=" " class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                  <i class="material-icons">delete</i>
                                  <div class="ripple-container"></div>
                                </button>
                              </form>
                        </td>
                    @endforeach
                  </tbody>
                </table>
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
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection --}}
