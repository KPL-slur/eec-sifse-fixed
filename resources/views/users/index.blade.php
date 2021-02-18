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
                <div class="col-12 text-right">
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddUser">
                    <i class="material-icons">
                      add
                    </i>Add User
                  </button>
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
                        <div class="modal-body">
        
                            <div class="form-group-site">
                              <label for="inputName">Name</label>
                              <input type="text" class="form-control" name="name" placeholder="Input Name">
                            </div>

                            <div class="form-group-site">
                              <label for="inputEmail">Email</label>
                              <input type="email" class="form-control" name="email" placeholder="Input Email">
                            </div>

                            <div class="form-group-site">
                              <label for="inputPassword">Password</label>
                              <input type="text" class="form-control" name="password" placeholder="Input Name">
                            </div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" onclick="return confirm('Aapakah anda yakin ingin menambah data ini?')" class="btn btn-primary">Add</button>
                        </div>

                      </form> 
                    </div>
                  </div>
                </div>

              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Creation Date</th>
                    <th class="text-right">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($user as $user)
                      <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td>{{$user->created_at}}</td>

                        <td class="td-actions text-right">
                                <a rel="tooltip" class="btn btn-warning" data-toggle="modal" data-target="#modalEditUser" href="editUser/{{ $user->id }}" >
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                                </a>

                              <form method="POST" action="/deleteUser/{{$user->id}}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                  <i class="material-icons">delete</i>
                                  <div class="ripple-container"></div>
                                </button>
                              </form>
                        </td>
                        <!-- Modal Edit User -->
                          <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form method="POST" action="/editUser">
                                  @csrf
                                  <div class="modal-body">
                  
                                      <div class="form-group-site">
                                        <label for="inputName">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Input Name">
                                      </div>

                                      <div class="form-group-site">
                                        <label for="inputEmail">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Input Email">
                                      </div>

                                      <div class="form-group-site">
                                        <label for="inputPassword">Password</label>
                                        <input type="text" class="form-control" name="password" placeholder="Input Name">
                                      </div>

                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" onclick="return confirm('Aapakah anda yakin ingin mengubah data ini?')" class="btn btn-primary">Edit</button>
                                  </div>

                                </form> 
                              </div>
                            </div>
                          </div>

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
