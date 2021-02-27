@extends('layouts.app', ['activePage' => 'distribution-management', 'titlePage' => __('Edit Distributions')])

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-6">
                <h4 class="card-title mt-2">Perubahan Distribusi</h4>
              </div>
              <div class="col-md-6">
               
              </div>
            </div>
          </div>
          <div class="card-body text-center">
            <div class="table-responsive">
              <form method="POST" action="/edit">
                @csrf

                <div class="form-group">
                    <label>Station ID</label>
                    <select name="site_id" id="site_id" class="form-control @error('site_id') is-invalid @enderror">
                      <option selected disabled value="">--Pilih Site--</option>
                      @foreach ($sites as $st)
                          <option value="{{$st->site_id}}" @if ($distributions->site_id  == $st->site_id) selected @endif>{{$st->station_id}}</option>
                      @endforeach
                  </select>
                  
                  @error('site_id')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                  
                </div>
                
                  <div class="form-group">
                    <label>Nama Teknisi</label>
                    <select name="expert_id" id="expert_id" class="form-control @error('expert_id') is-invalid @enderror">
                      <option selected disabled value="">--Pilih Nama Expert--</option>
                        @foreach ($experts as $exp)
                            <option value="{{$exp->expert_id}}" @if ($exp->expert_id  == $exp->expert_id) selected @endif>{{$exp->name}}</option>
                        @endforeach
                    </select>    
                  </div>


                  <button type="submit" onclick="return confirm('Apakah anda yakin untuk mengubah data ini?')" class="btn btn-primary">Ubah</button>
                  <a href="viewDistribution/{{$sites->site_id}}" class="btn btn-primary">Kembali</a>
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