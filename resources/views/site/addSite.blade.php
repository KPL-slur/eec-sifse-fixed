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
              
              <form method="POST" action="/add" enctype="multipart/form-data">
                @csrf
                <div class="form-group-site">
                  <label for="inputSite">Nama Site</label>
                  <input type="text" class="form-control" id="site" name="site" placeholder="Masukan Nama Site">
                </div>

                <div class="form-group-site">
                  <label for="inputSite">Lokasi Site</label>
                  <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukan Lokasi Site">
                </div>
                
                <div class="form-group-site">
                  <label for="inputSite">Tambahkan Foto</label>
                  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                    <div>
                        <span class="btn btn-raised btn-round btn-default btn-file">
                            {{-- <span class="fileinput-new">Select image</span> --}}
                            {{-- <span class="fileinput-exists">Change</span> --}}
                            <input type="file" name="image" id="image"/>
                        </span>
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