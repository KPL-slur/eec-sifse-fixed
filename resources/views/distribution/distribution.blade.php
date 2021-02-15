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
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="addDistribution" class="btn btn-sm btn-primary">
                      <i class="material-icons">
                        add
                      </i>Add Distribution
                    </a>
                  </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class=" text-primary">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama Teknisi</th>
                      <th scope="col">Radar Name</th>
                      <th scope="col">Station ID</th>
                      <th class="text-right">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($experts as $exp)
                      <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$exp->name}}</td>
                        <td>{{$exp->radar_name}}</td>
                        <td>{{$exp->station_id}}</td>
                        <td class="td-actions text-right">
                              <a rel="tooltip" class="btn btn-warning " href="editDistribution/{{$exp->expert_id}}">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              
                              <form method="POST" action="/deleteDistribution/{{$exp->expert_id}}" class="d-inline">
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
@endsection
