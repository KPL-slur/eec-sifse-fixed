@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
    
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Users Management</h4>
            </div>
            
            <div class="card-body">
                <div class="row">

                <div class="col material-datatables">
                  <x-ui.spinner id="spinner" className="spinner-center"/>
                  <table class="table table-bordered table-hover d-none" cellspacing="0" width="100%" style="width:100%" id="indexUsersTable">
                      <thead class="text-primary">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Creation Date</th>
                          <th class="disabled-sorting text-center">Delete</th>
                          <th class="text-center">Status</th>
                        </tr>
                      </thead>
                    <tbody>
                      
                      @foreach ($users as $user)
                        <tr>
                          <td scope="row">{{$loop->iteration}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->created_at}}</td>
  
                          <td class="td-actions text-center">
  
                                <form method="POST" action="/deleteUser/{{$user->id}}" class="d-inline">
                                  @csrf
                                  @method('delete')
                                  <button title="delete" class="btn btn-danger" onclick="return confirm('Are you sure, you want to delete this user ?')">
                                    <i class="material-icons">delete</i>
                                    <div class="ripple-container"></div>
                                  </button>
                                </form>
                          </td>

                          <td class="td-actions text-center">
                              @if ($user->is_approved == 0)
                                <form method="POST" action="/approveUser/{{$user->id}}" onclick="return confirm('Are you sure, you want to verify this user ?')" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning">Pending</button>
                                </form>
                              @else
                                <button class="btn btn-sm btn-success">Approved</button>
                              @endif
                          </td>
  
                      @endforeach
  
                    </tbody>
                  </table>
                </div>

                <!-- Modal Add User-->
                <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      
                      <form method="POST" action="/addUser">
                        @csrf
                        {{$errors}}
                        <div class="modal-body">
                          {{-- {{$errors}} --}}
                            <div class="form-group-site">
                              <label for="inputName">Name</label>
                              {{-- <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Input Name"> --}}

                              <select name="expert_id" id="expert_id" class="form-control @error('expert_id') is-invalid @enderror ">
                                <option selected disabled value="">--Pilih Expert--</option>
                                @foreach ($experts as $exp)
                                  <option value="{{ $exp->expert_id }}" {{ old('expert_id') == $exp->expert_id ? 'selected' : '' }} >{{$exp->name}}</option>
                                @endforeach
                              </select>
                                <span>

                                  @error('expert_id')
                                  <div style="color: red">
                                    {{$message}}
                                  </div>
  
                                  <script type="text/javascript">    
                                    window.onload = () => {
                                      $('#modalAddUser').modal('show');
                                    }
                                  </script>
  
                                  @enderror
                                </span>
                            </div>

                            <div class="form-group-site">
                              <label for="inputEmail">Email</label>
                              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Input Email">
                              <span>

                                @error('email')
                                <div style="color: red">
                                  {{$message}}
                                </div>

                                <script type="text/javascript">
                                  window.onload = () => {
                                    $('#modalAddUser').modal('show');
                                  }
                                </script>

                                @enderror
                              </span>
                            </div>

                            <div class="form-group-site">
                              <label for="inputPassword">Password</label>
                              <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Input Password">
                              <span>

                                @error('password')
                                <div style="color: red">
                                  {{$message}}
                                </div>

                                <script type="text/javascript">
                                  window.onload = () => {
                                    $('#modalAddUser').modal('show');
                                  }
                                </script>

                                @enderror
                              </span>
                            </div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" onclick="return confirm('Apakah anda yakin ingin menambah data ini?')" class="btn btn-primary">Add</button>
                        </div>

                      </form> 
                    </div>
                  </div>
                </div>

              </div>

              @if (session('status1'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'success' ,"{{ session('status1') }}");
                };
              </script>
              @elseif (session('status3'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'danger' ,"{{ session('status3') }}");
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
      $('#indexUsersTable').DataTable({
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
      $('#indexUsersTable').removeClass('d-none');
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
