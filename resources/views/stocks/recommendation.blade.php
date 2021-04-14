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


              {{-- card body kedua --}}
              <div class="row">
                <div class="col">
                  <div class="table-responsive material-datatables">
                    <table class="table none table-striped table-no-bordered table-hover" cellspacing="0" width="100" style="width:100%" id="indexRecommendsTable" >
    
                      <thead class=" text-primary text-middle">
                        <tr>
                          <th>#</th>
                          <th>Radar Name</th>
                          <th>Station ID</th>
                          <th>Nama Barang</th>
                          <th>Amount Required</th>
                          <th>Year</th>
                        </tr>
                      </thead>
    
                      <tbody>
                        @foreach ($recommendations as $rcm)
                          <tr>
                            <td></td>
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