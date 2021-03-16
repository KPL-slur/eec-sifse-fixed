@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard Admin')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-12">
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
                  <th>Failed Tests</th>
                  <th>Remark</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Banjarmasin</td>
                    <td>Sekian</td>
                    <td>1</td>
                    <td>halohalohalo</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Banjarmasin</td>
                    <td>Sekian</td>
                    <td>1</td>
                    <td>halohalohalo</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Banjarmasin</td>
                    <td>Sekian</td>
                    <td>1</td>
                    <td>halohalohalo</td>
                  </tr>
                </tbody>
              </table>
            </div>
            {{-- div card body --}}
          </div>
          {{-- div card --}}
        </div>
        {{-- div col --}}
        <div class="col-lg-6 col-md-12">
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
                  <th>Remark</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
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
                  <th>Units on Stock</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td class="text-center">3</td>
                    <td class="text-center">4</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Dakota Rice</td>
                    <td class="text-center">3</td>
                    <td class="text-center">4</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Dakota Rice</td>
                    <td class="text-center">3</td>
                    <td class="text-center">4</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Dakota Rice</td>
                    <td class="text-center">3</td>
                    <td class="text-center">4</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Dakota Rice</td>
                    <td class="text-center">3</td>
                    <td class="text-center">4</td>
                    <td>0</td>
                  </tr>
                </tbody>
              </table>
            </div>
            {{-- div card body --}}
          </div>
        </div>
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