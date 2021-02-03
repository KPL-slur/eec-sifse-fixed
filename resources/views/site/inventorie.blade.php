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
                              <a class="dropdown-item" href="inventorie">ITEM PENDUKUNG</a>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Part</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Description</th>
                            <th scope="col">In</th>
                            <th scope="col">Out</th>
                            <th scope="col">Expired Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Transmitter</td>
                            <td>O1xxx</td>
                            <td>Penghubung dengan antena</td>
                            <td>date in</td>
                            <td>date out</td>
                            <td>03-03-2021</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Stalo</td>
                            <td>O2xxx</td>
                            <td>Stable Local Oscilator</td>
                            <td>date in</td>
                            <td>date out</td>
                            <td>03-03-2021</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td></td>
                            <td>O1xxx</td>
                            <td>Penghubung dengan antena</td>
                            <td>date in</td>
                            <td>date out</td>
                            <td>03-03-2021</td>
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