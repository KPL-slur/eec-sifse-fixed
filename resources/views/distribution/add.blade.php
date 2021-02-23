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
          
                <form method="POST" action="/addDst">
                  @csrf
                  <div class="form-group">
                    <label >Nama Teknisi</label>
                    <select name="expert_id" id="expert_id" class="form-control ">
                        <option selected disabled value="">--Pilih Teknisi--</option>
                        @foreach ($experts as $exp)
                          <option value={{$exp->expert_id}}>{{$exp->name}}</option>
                        @endforeach                        
                    </select>

                  </div>
                  <div class="form-group">
                    <label>Station ID</label>
                    <select name="site_id" id="site_id" class="form-control ">
                      <option selected disabled value="">--Pilih Station ID--</option>

                      @foreach ($sites as $sts)
                        <option value={{$sts->site_id}}>{{$sts->station_id}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <button type="submit" onclick="return confirm('Apakah yakin ingin menambahkan data?')" class="btn btn-primary">Tambah</button>
                  <a href="/distribution" class="btn btn-primary">Kembali</a>
                </form>
              </div>
            </div>
            @if (session('status1'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'success' ,'<?php echo session('status1') ?>');
                };
              </script>
              @elseif (session('status2'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'warning' ,'<?php echo session('status2') ?>');
                };
              </script>
              @elseif (session('status3'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'danger' ,'<?php echo session('status3') ?>');
                };
              </script>
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection