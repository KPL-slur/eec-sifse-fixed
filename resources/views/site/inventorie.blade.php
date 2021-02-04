@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Detail Inventorie')])

@section('content')
<div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Inventorie</h4>
                <p class="card-category"> Here you can manage inventorie</p>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-12 text-left">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Item Utama
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <button class="btn btn-primary dropdown-item" type="button">ITEM PENDUKUNG</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 text-right">
                        <a rel="tooltip" class="btn btn-success" type="button" href="inventorySite">
                          <i class="material-icons">
                            local_printshop
                          </i> Print Data
                        </a> 
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sparepart</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Installed Date</th>
                            <th scope="col">Expired Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($stocks as $stk)
                            <tr>
                              <th scope="row">{{$loop->iteration}}</th>
                              <td>{{$stk->nama_barang}}</td>
                              <td>{{$stk->part_number}}</td>
                              <td>{{$stk->serial_number}}</td>
                              <td>{{$stk->tgl_masuk}}</td>
                              <td>{{$stk->expired}}</td>
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