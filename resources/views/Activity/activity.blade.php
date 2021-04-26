@extends('layouts.app', ['activePage' => 'activity', 'titlePage' => __('FSE Activity')])

@section('content')
    
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{strtoupper($maintenance_type)}} Activity Report</h4>
              
            </div>
            <div class="card-body">
              <div class="text-left">
                  <a type="button" href="/expertActivity" class="btn btn-info btn-md ml-3">Back</a>
              </div>
                <div class="row">

                  <div class="col material-datatables">
                    <x-ui.spinner id="spinner" className="spinner-center"/>
                    <table class="table table-no-bordered table-hover d-none" cellspacing="0" width="100%" style="width:100%" id="indexPMTable">
                      <thead class=" text-primary">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Radar Name</th>
                          <th scope="col">Station ID</th>
                          <th scope="col">Date Start</th>
                          <th scope="col">Date End</th>
                          <th scope="col">FSE</th>
                          <th class="disabled-sorting text-center">Detail</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($reports as $report)
                          <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{$report->site->radar_name}}</td>
                            <td>{{$report->site->station_id}}</td>
                            <td>{{$report->report_date_start}}</td>
                            <td>{{$report->report_date_end}}</td>
                            <td>
                              @foreach ($report->experts as $exp)
                                  {{ $exp->name }};
                              @endforeach
                            </td>
                            <td class="td-actions text-center">
                              
                              <a rel="tooltip" class="btn btn-info" href="{{ route("activity.show", ['id' => $report->head_id, 'maintenance_type' => $maintenance_type]) }}">
                                <i class="material-icons">visibility</i>
                                <div class="ripple-container"></div>
                              </a>
    
                            </td>
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
</div>

@push('scripts')
<script>
  $(document).ready( function () {
      $('#indexPMTable').DataTable({
          "pagingType": "numbers",
          "lengthMenu": [
              [10, 25, 50, 100, 250, 500],
              [10, 25, 50, 100, 250, 500]
          ],
          responsive: true,
          language: {
          searchPlaceholder: "Search records",
          },
          // "columnDefs": [
          // { className: "none", "targets": [ 2 ] }
          // ],
      });
      $('#spinner').addClass('d-none');
      $('#indexPMTable').removeClass('d-none');
  });
</script>
@endpush

@endsection
