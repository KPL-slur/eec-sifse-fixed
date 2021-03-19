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
                  {{-- <th>Serial Number</th> --}}
                  <th class="text-center">Units Needed</th>
                  <th class="text-center">Units on Site</th>
                  <th class="text-center">Units on Stock</th>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($recommends as $rcm)
                      <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $rcm->name }}</td>
                        <td class="text-center">{{ $rcm->jumlah_unit_needed }}</td>
                        <td class="text-center">
                          @foreach($site_stocks as $site)
                            @if ($site->station_id === $rcm->headReports->site->station_id)
                              @foreach ($site->stocks as $stock)
                                @if ($stock->nama_barang === $rcm->name)
                                  {{$stock->nama_barang}}
                                @endif
                              @endforeach
                            @endif
                          @endforeach
                        </td>
                        <td class="text-center">
                          @foreach ($site_stocks as $site)
                            @if ($site->station_id === $rcm->headReports->site->station_id)
                              @foreach ($site->stocks as $stock)
                                @if ($stock->nama_barang === $rcm->name)
                                  {{ $stock->jumlah_unit }}
                                @endif
                              @endforeach
                            @endif
                          @endforeach
                        </td>
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
            <div class="card-body table-responsive-md">
              <table class="table table-hover table-striped" id="dashboardPmTable">
                <thead>
                  <th>No</th>
                  <th>Lokasi</th>
                  <th>Date</th>
                  <th>Technicians</th>
                  <th class="text-center">Remark</th>
                </thead>
                <tbody>
                  @foreach ($pm as $pm)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $pm->site->station_id }}</td>
                      <td>{{ $pm->report_date_start }}-{{ $pm->report_date_end }}</td>
                      <td>
                        @foreach ($pm->experts as $expert)
                          {{ $expert->name }}, 
                        @endforeach
                      </td>
                      <td>{{ $pm->pmBodyReport->remark }}</td>
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
            <div class="card-body table-responsive-md">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>No</th>
                  <th>Lokasi</th>
                  <th>Date</th>
                  <th>Technicians</th>
                  <th>Remark</th>
                </thead>
                <tbody>
                  @foreach ($cm as $cm)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $cm->site->station_id }}</td>
                      <td>{{ $cm->report_date_start }}-{{ $cm->report_date_end }}</td>
                      <td>
                        @foreach ($cm->experts as $expert)
                          {{ $expert }},
                        @endforeach
                      </td>
                      <td>{{ $cm->cmBodyReport->remark }}</td>
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
@endsection

@push('js')
  {{-- <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script> --}}
@endpush