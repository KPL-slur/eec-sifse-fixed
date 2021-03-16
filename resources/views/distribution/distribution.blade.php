@extends('layouts.app', ['activePage' => 'distribution-management', 'titlePage' => __('Distribution Management')])

@section('content')
    
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Distribution</h4>
              <p class="card-category"> Here you can manage distributions</p>
            </div>
            <div class="card-body">
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class=" text-primary">
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
@endsection
