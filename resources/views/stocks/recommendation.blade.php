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

            {{-- card kedua --}}
            <div class="card m-3 my-5">

              {{-- header kedua --}}
              <div class="card-header card-header-rose">
                {{-- <h4 class="card-title">2020 year</h4> --}}
                <p class="card-category" id="yearRecommendsCardHeader">Semua</p>
              </div>

              {{-- card body kedua --}}
              <div class="row">
                <div class="col">
                  <div class="table-responsive material-datatables">
                    <table class="table table-striped" id="indexRecommendsTable" >
    
                      <thead class=" text-primary text-middle">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Radar Name</th>
                          <th scope="col">Station ID</th>
                          <th scope="col">Nama Barang</th>
                          <th>Amount Required</th>
                          <th scope="col">Year</th>
                        </tr>
                      </thead>
    
                      <tbody>
                        @foreach ($recommendations as $rcm)
                          <tr>
                            <td scope="row"></td>
                            <td>{{$rcm->radar_name}}</td>
                            <td>{{$rcm->station_id}}</td>
                            <td>{{$rcm->name}}</td>
                            <td>{{$rcm->jumlah_unit_needed}}</td>
                            <td>{{$rcm->year}}</td>
                          </tr>
                        @endforeach
                      </tbody>
    
                    </table>
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
</div>
{{-- content --}}

@push('scripts')

<script>
  $(document).ready(function(){
      $("#indexRecommendsTable").DataTable({
        "pagingType": "numbers",
        "lengthMenu": [
          [10, 25, 50, 100, 250, 500],
          [10, 25, 50, 100, 250, 500]
        ],
        responsive: true,
        language: {
          searchPlaceholder: "Search recommendation records",
        }
      });
  });
</script>
@endpush

@endsection