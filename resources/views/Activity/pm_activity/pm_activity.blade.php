@extends('layouts.app', ['activePage' => 'activity', 'titlePage' => __('Technisians Activity')])

@section('content')
    
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">PM Report</h4>
              
            </div>
            <div class="card-body">
                <div class="row">
                  {{-- <div class="col-12 text-right">
                    <a href="addPm" class="btn btn-sm btn-primary">
                      <i class="material-icons">
                        add
                      </i>Add PM Schedule
                    </a>
                  </div> --}}
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class=" text-primary">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Radar Name</th>
                      <th scope="col">Station ID</th>
                      <th scope="col">Date Start</th>
                      <th scope="col">Date End</th>
                      <th scope="col">Expertises</th>
                      <th class="text-center">Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pm as $pm)
                      <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$pm->site->radar_name}}</td>
                        <td>{{$pm->site->station_id}}</td>
                        <td>{{$pm->report_date_start}}</td>
                        <td>{{$pm->report_date_end}}</td>
                        <td>
                          @foreach ($pm->experts as $exp)
                              {{ $exp->name }};
                          @endforeach
                        </td>
                        <td class="td-actions text-center">
                          
                          <a rel="tooltip" class="btn btn-info" href="showPm/{{$pm->head_id}}">
                            <i class="material-icons">visibility</i>
                            <div class="ripple-container"></div>
                          </a>
                            {{-- <a rel="tooltip" class="btn btn-warning" href="editPm/{{$pm->head_id}}">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a> --}}
                              
                            <form method="POST" action="/deletePm/{{ $pm->head_id }}" class="d-inline">
                              @csrf
                              @method('delete')
                              <button class="btn btn-danger " onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" >
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
            </div>
            @if (session('status3'))
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
@endsection
