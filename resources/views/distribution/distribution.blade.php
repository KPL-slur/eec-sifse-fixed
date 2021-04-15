@extends('layouts.app', ['activePage' => 'distribution-management', 'titlePage' => __('Distribution Management')])

@section('content')
    
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Distribution</h4>
              <p class="card-category"> Here you can manage distributions</p>
            </div>
            
              <div class="row">

                <div class="col material-datatables">
                  <x-ui.spinner id="spinner" className="spinner-center"/>
                  <table class="table table-no-bordered table-hover d-none" cellspacing="0" width="100%" style="width: 100%" id="distributionsTable">
                    <thead class="text-primary">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Radar Name</th>
                        <th scope="col">Station ID</th>
                        <th class="text-center">Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sites as $st)
                        <tr>
                          <td scope="row">{{$loop->iteration}}</td>
                          <td>{{$st->radar_name}}</td>
                          <td>{{$st->station_id}}</td>
                          <td class="td-actions text-center">

                            <a rel="tooltip" class="btn btn-info" href="viewDistribution/{{$st->site_id}}">
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

@push('scripts')
  <script>
      $(document).ready( function () {
          $('#distributionsTable').DataTable({
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
          $('#distributionsTable').removeClass('d-none');
      });
  </script>
@endpush

@endsection
