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
                <h4 class="card-title mt-2" >Penambahan Tower Baru</h4>
              </div>
              <div class="col-md-6">
                
              </div>
            </div>
          </div>
          <div class="card-body text-center">
            <div class="table-responsive">
              {{$errors}}
              <form method="POST" action="/add" enctype="multipart/form-data">
                @csrf
                <div class="form-group-site">
                  <label for="inputSite">Nama Site</label>
                  <input type="text" class="form-control @error('radar_name') is-invalid @enderror" id="radar_name" name="radar_name" value="{{ old('radar_name') }}" placeholder="Masukan Radar Name">

                  @error('radar_name')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror

                </div>

                <div class="form-group-site">
                  <label for="inputSite">Lokasi Site</label>
                  <input type="text" class="form-control @error('station_id') is-invalid @enderror" id="station_id" name="station_id" value="{{ old('station_id') }}" placeholder="Masukan Station ID">

                  @error('station_id')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror

                </div>
                
                <div class="form-group-site">
                  <label for="inputSite">Tambahkan Foto</label>
                  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-preview fileinput-exists thumbnail img-raised image-upload-preview"></div>
                    <div>
                        <span class="btn btn-raised btn-round btn-default btn-file">
                            <input class="@error('image') is-invalid @enderror" type="file" name="image" id="image" onchange="validateImage()">
                            
                            @error('image')
                              <div class="invalid-feedback">
                                {{$message}}
                              </div>
                            @enderror
                            
                        </span>
                        
                        {{--js image validation--}}
                        {{-- <script type="text/javascript">
                          function validateImage() {
                              var formData = new FormData();
                              var file = document.getElementById("image").files[0];
                              formData.append("Filedata", file);
                              var t = file.type.split('/').pop().toLowerCase();
                              if (t != "jpeg" && t != "jpg" && t != "png") {
                                  alert('Please select a valid image file');
                                  document.getElementById("image").value = '';
                                  return false;
                              }
                              if (file.size > 1024000) {
                                  alert('Max Upload size is 1MB only');
                                  document.getElementById("image").value = '';
                                  return false;
                              }
                              return true;
                          }
                          </script> --}}

                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                  </div>
                </div>

                <br>
                <button type="submit" onclick="return confirm('Apakah yakin ingin menambahkan data?')" class="btn btn-primary">Tambah</button>
                <a href="/site" class="btn btn-primary">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection