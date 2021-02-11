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
                      <th scope="col">Site</th>
                      <th scope="col">Location</th>
                      <th class="text-right">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($technisians as $tns)
                      <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$tns->name}}</td>
                        <td>{{$tns->site}}</td>
                        <td>{{$tns->lokasi}}</td>
                        <td class="td-actions text-right">
                              <a rel="tooltip" class="btn btn-warning " href="editDistribution/{{$tns->tech_id}}">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              
                              <form method="POST" action="/deleteDistribution/{{$tns->tech_id}}" class="d-inline">
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
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
