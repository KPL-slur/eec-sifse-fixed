@extends('layouts.app', ['activePage' => 'expert-management', 'titlePage' => __('Expert Management')])

@section('content')
    
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Experts Management</h4>
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

                <div class="col material-datatables">
                  <x-ui.spinner id="spinner" className="spinner-center"/>
                  <table class="table table-no-bordered table-hover d-none" cellspacing="0" width="100%" style="width:100%" id="indexExpertsTable">
                      <thead class="text-primary">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">NIP</th>
                          <th scope="col">Expert Company</th>
                          <th class="disabled-sorting text-center">Update or Delete</th>
                        </tr>
                      </thead>
                    <tbody>
                      
                      @foreach ($experts as $exp)
                        <tr>
                          <td scope="row">{{$loop->iteration}}</td>
                          <td>{{$exp->name}}</td>
                          <td>{{$exp->nip}}</td>
                          <td>{{$exp->expert_company}}</td>  
                          <td class="td-actions text-center">

                            <a title="edit" class="btn btn-lg btn-warning m-2" href="/editExpert/{{$exp->expert_id}}" type="submit">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                                <form method="POST" action="/deleteExp/{{$exp->expert_id}}" class="d-inline">
                                  @csrf
                                  @method('delete')
                                  <button title="delete" class="btn btn-danger" onclick="return confirm('Are you sure, you want to delete'+ '{{$exp->name}}'+ ' from expert list ?')">
                                    <i class="material-icons">delete</i>
                                    <div class="ripple-container"></div>
                                  </button>
                                </form>
                          </td>
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

@push('scripts')
<script>
  $(document).ready( function () {
      $('#indexExpertsTable').DataTable({
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
      $('#indexExpertsTable').removeClass('d-none');
  });
</script>

    {{-- <script>
      $(document).ready( () => {
        $("#indexUsersTable").DataTable();
        $("#indexUsersTable").removeClass('d-none');
      });
    </script> --}}
@endpush

@endsection
