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
            <div class="card-body">
                <div class="row">
                <div class="col-12 text-right">
                  <a href="" class="btn btn-sm btn-primary">Add Distribution</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class=" text-primary">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nama Teknisi</th>
                      <th scope="col">Tower</th>
                      <th scope="col">Location</th>
                      <th class="text-right">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($distributions as $dst)
                      <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$dst->teknisi}}</td>
                        <td>{{$dst->tower}}</td>
                        <td>{{$dst->lokasi}}</td>
                        <td class="td-actions text-right">
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('editDistribution') }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              <button class="btn btn-danger btn-link" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="material-icons">delete</i>
                                <div class="ripple-container"></div>
                              </button>
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
