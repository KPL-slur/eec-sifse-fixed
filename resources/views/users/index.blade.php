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
                  <a href="#" class="btn btn-sm btn-primary">Add user</a>
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
                              <a rel="tooltip" class="btn btn-warning " href="#" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              <button class="btn btn-danger " onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="material-icons">delete</i>
                                <div class="ripple-container"></div>
                              </button>
                        </td>
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
