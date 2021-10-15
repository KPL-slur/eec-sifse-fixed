@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard Admin')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">Recommendation - Sited Stocks</h4>
            </div>
            {{-- div card header --}}
            <div class="card-body table-responsive-md">
              <table class="table table-hover">
                <thead>
                  <th>No</th>
                  <th>Name</th>
                  <th class="text-center">Units Needed</th>
                  <th class="text-center">Units on Stock</th>
                </thead>
                <tbody>
                  @foreach ($recommends as $rcm)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $rcm->name }}</td>
                      <td class="text-center">{{ $rcm->jumlah_unit_needed }}</td>
                      <td class="text-center">{{ $stock_rec[$rcm->name]  }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{-- div card body --}}
          </div>
        </div>
      </div>
      {{-- div row --}}

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">PM</h4>
            </div>
            {{-- div card header --}}
            <div class="card-body table-responsive-md material-datatables">
              <x-ui.spinner id="spinner-pm" className="spinner-center"/><br>
              <table class="table table-hover table-striped d-none" id="PMTable" cellspacing="0" width="100" style="width:100%">
                <thead>
                  <th>#</th>
                  <th>Lokasi</th>
                  <th>Date</th>
                  <th>FSE</th>
                  <th class="text-center">Remark</th>
                </thead>
                <tbody>
                  @foreach ($pm as $pm)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $pm->site->station_id }}</td>
                      <td>{{ date('j M Y', strtotime($pm->report_date_start))}} until {{ date('j M Y', strtotime($pm->report_date_end)) }}</td>
                      <td>
                        @foreach ($pm->experts as $expert)
                          {{ $expert->name }}, 
                        @endforeach
                      </td>
                      <td class="text-center">{{ $pm->pmBodyReport->remark }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{-- div card body --}}
          </div>
          {{-- div card --}}
        </div>
        {{-- div col --}}
      </div>
      {{-- div row --}}

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">CM</h4>
            </div>
            <div class="card-body table-responsive-md material-datatables">
              <x-ui.spinner id="spinner-cm" className="spinner-center"/><br>
              <table class="table table-hover table-striped d-none" id="CMTable" cellspacing="0" width="100" style="width:100%">
                <thead class="text-warning">
                  <th>#</th>
                  <th>Lokasi</th>
                  <th>Date</th>
                  <th>FSE</th>
                  <th class="text-center">Remark</th>
                </thead>
                <tbody>
                  @foreach ($cm as $cm)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $cm->site->station_id }}</td>
                      <td>{{ date('j M Y', strtotime($cm->report_date_start))}} until {{ date('j M Y', strtotime($cm->report_date_end)) }}</td>
                      <td>
                        @foreach ($cm->experts as $expert)
                          {{ $expert->name }},
                        @endforeach
                      </td>
                      <td class="text-center">{{ $cm->cmBodyReport->remark }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{-- div card body --}}
          </div>
          {{-- div card --}}
        </div>
        {{-- div col --}}
      </div>
      {{-- div row --}}
      
    </div>
    {{-- div container fluid --}}
  </div>
  {{-- div content --}}

@push('scripts')
{{-- script for datatable --}}
<script>
  $(document).ready( () => {
    $("#PMTable").DataTable({
      responsive: true,
      "columnDefs": [
        { className: "none", "targets": [ -1 ] },
        { orderable: false, "targets" : [ 0, 1, 2, 3] },
      ],
      "searching" : false,
      "paging" : false,
      "info" : false,
    });
    $('#spinner-pm').addClass('d-none');
    $("#PMTable").removeClass('d-none');

    $("#CMTable").DataTable({
      responsive: true,
      "columnDefs": [
        { className: "none", "targets": [ -1 ] },
        { orderable: false, "targets" : [ 0, 1, 2, 3] },
      ],
      "searching" : false,
      "paging" : false,
      "info" : false
    });
    $('#spinner-cm').addClass('d-none');
    $("#CMTable").removeClass('d-none');
  });
</script>
{{-- script for datatable --}}
@endpush

@endsection
