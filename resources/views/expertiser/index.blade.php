@extends('layouts.app', ['activePage' => 'expert-management', 'titlePage' => __('Expert Management')])

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Expert Management</h4>
              </div>
              
              <div class="card-body">
                  <div class="row">
                    <div class="col-12 text-right">
                        <a rel="tooltip" title="Adding Expert" class="btn btn-sm btn-primary" href="addExpert">
                            <i class="material-icons">
                                add
                            </i>Add Expert
                        </a>
                    </div>
    
                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
                            <thead class=" text-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Expert Company</th>
                                    <th class="text-center">Update or Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($experts as $expert)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$expert->name}}</td>
                                    <td>{{$expert->nip}}</td>
                                    <td>{{$expert->expert_company}}</td>
            
                                    <td class="td-actions text-center">

                                        <a title="edit" class="btn btn-warning m-2" href="editExpert/{{$expert->expert_id}}">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                        </a>
            
                                        <form method="POST" action="/deleteExp/{{$expert->expert_id}}" class="d-inline">
                                          @csrf
                                          @method('delete')
                                          <button class="btn btn-danger m-2" title="delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" >
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