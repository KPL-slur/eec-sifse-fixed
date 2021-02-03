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
                <h4 class="card-title mt-2" >Perubahan Distribusi</h4>
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
                    <label >Technisian</label>
                    <select name="tech_id" id="tech_id" class="form-control">
                        @foreach ($technisians as $tns)
                            <option value="{{$tns->tech_id}}">{{$tns->name}}</option>
                        @endforeach
                    </select>    
                  </div>
                  <div class="form-group">
                      <label ><b>Sites</b></label>
                      <select name="site_id" id="site_id" class="form-control">
                        <option value="">--Pilih Site--</option>
                        @foreach ($sites as $sites)
                            <option value="{{$sites->site_id}}">{{$sites->site}}</option>
                        @endforeach
                    </select>   
                  </div>
                  <button type="submit" onclick="return confirm('Apakah anda yakin untuk mengubah data ini?')" class="btn btn-primary">Ubah</button>
                  <a href="{{ route('distribution') }}" class="btn btn-primary">Kembali</a>
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