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
                <h4 class="card-title mt-2" >Addition to Distribution</h4>
              </div>
              <div class="col-md-6">
               
              </div>
            </div>
          </div>
          
        <div class="card-body text-center">
            <div class="table-responsive">
                {{-- {{$errors}} --}}
                <form method="POST" action="/addDst">
                  @csrf
                  <div class="form-group">
                    <label>Station ID</label>
                    <select name="site_id" id="site_id" class="form-control distribution @error('site_id') is-invalid @enderror ">
                      <option selected disabled value="">--Choose Station ID--</option>
                      @foreach ($sites as $st)
                        <option value="{{ $st->site_id }}" {{ old('site_id') == $st->site_id ? 'selected' : '' }}>{{$st->station_id}}</option>
                      @endforeach
                    </select>
                    <small class="form-text text-muted">If the site does not exist, then add it to the Site feature first</small>

                    @error('site_id')
                        <div class="invalid-feedback">
                          {{$message}}
                        </div>
                    @enderror

                  </div>
                  
                  <div class="form-group">
                    <label >Expert Name</label>
                    <select name="expert_id" id="expert_id" class="form-control distribution @error('expert_id') is-invalid @enderror ">
                        <option value="" selected disabled>--Choose FSE Name--</option>
                        @foreach ($experts as $exp)
                          <option value={{$exp->expert_id}} {{old('expert_id') == $exp->expert_id ? 'selected' : '' }}>{{$exp->name}}</option>
                        @endforeach                        
                    </select>
                    <small class="form-text text-muted">If the FSE not exist, then add it to the FSE Management feature first</small>
                    
                    @error('expert_id')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror

                  </div>
                  
                  <button type="submit" onclick="return confirm('Are you sure, you want to add this distribution ?')" class="btn btn-primary">Submit</button>
                  <a href="/viewDistribution/{{$st->site_id}}" class="btn btn-info">Back</a>
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