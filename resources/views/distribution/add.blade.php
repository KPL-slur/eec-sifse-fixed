@extends('layouts.app', ['activePage' => 'distribution-management', 'titlePage' => __('Add Distributions')])

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-6">
                <h4 class="card-title mt-2" >Penambahan Distribusi</h4>
              </div>
              <div class="col-md-6">
               
              </div>
            </div>
          </div>
          <div class="card-body text-center">
            <div class="table-responsive">
          
                <form method="POST" action="/add">
                  @csrf
                  <div class="form-group">
                    <label >Nama Teknisi</label>
                    <select name="tech_id" id="tech_id" class="form-control ">
                        <option value="">--Pilih Teknisi--</option>
                        @foreach ($technisians as $tns)
                          <option value={{$tns->tech_id}}>{{$tns->name}}</option>
                        @endforeach                        
                    </select>

                  </div>
                  <div class="form-group">
                    <label>Site</label>
                    <select name="site_id" id="site_id" class="form-control ">
                      <option value="">--Pilih Site--</option>

                      @foreach ($sites as $sts)
                        <option value={{$sts->site_id}}>{{$sts->lokasi}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <button type="submit" onclick="return confirm('Apakah yakin ingin menambahkan data?')" class="btn btn-primary">Tambah</button>
                  <a href="/distribution" class="btn btn-primary">Kembali</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection