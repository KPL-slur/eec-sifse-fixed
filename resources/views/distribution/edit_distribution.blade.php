@extends('layouts.app', ['activePage' => 'distribution-management', 'titlePage' => __('User Management')])

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
                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>
                      Name
                    </th>
                    <th>
                      Tower
                    </th>
                    <th>
                      Location
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                      <tr>
                        <td>
                          Rizky
                        </td>
                        <td>
                          Padang
                        </td>
                        <td>
                          2020-02-24
                        </td>
                        <td class="td-actions text-right">
                              <a rel="tooltip" class="btn btn-success btn-link" href="/distribution/add_distribution" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              <button class="btn btn-danger btn-link" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="material-icons">delete</i>
                                <div class="ripple-container"></div>
                              </button>
                        </td>
                      </tr>
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
