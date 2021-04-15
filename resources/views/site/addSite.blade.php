@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Add New Site')])

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-6">
                <h4 class="card-title mt-2" >Creating Data of New Site</h4>
              </div>
              <div class="col-md-6">
                
              </div>
            </div>
          </div>
          <div class="card-body text-center">
            <div class="table-responsive">
              {{-- {{$errors}} --}}
              <form method="POST" action="/add" enctype="multipart/form-data">
                @csrf
                <div class="form-group form-group-site ">
                  <label for="inputSite">Site Name</label>
                  <input type="text" class="form-control @error('radar_name') is-invalid @enderror" id="radar_name" name="radar_name" value="{{ old('radar_name') }}" placeholder="Input Radar Name">

                  @error('radar_name')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror

                </div>

                <div class="form-group form-group-site ">
                  <label for="inputSite">Site Location</label>
                  <input type="text" class="form-control @error('station_id') is-invalid @enderror" id="station_id" name="station_id" value="{{ old('station_id') }}" placeholder="Input Station ID">

                  @error('station_id')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror

                </div>

                <div class="form-group form-group-site">
                  @livewire('inventory-site', ['stocks' => $stocks])
                </div>
                
                <div class="form-group-site">
                  <label for="inputSite">Add Photo of Site</label>
                  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-preview fileinput-exists thumbnail img-raised image-upload-preview"></div>
                    <div>
                        <span class="btn btn-raised btn-round btn-default btn-file">
                            <input class="@error('image') is-invalid @enderror" type="file" name="image" id="image">
                            
                            @error('image')
                              <div class="invalid-feedback">
                                {{$message}}
                              </div>
                            @enderror
                            
                        </span>
                        
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                  </div>
                </div>

                <br>
                <button type="submit" onclick="return confirm('Are you sure, you want to add new site ?')" class="btn btn-primary">Submit</button>
                <a href="/site" class="btn btn-primary">Back</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection