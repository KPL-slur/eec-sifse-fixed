@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Detail Site')])

@section('content')
  <div class="content">
    <div class="container">
      <div class="col-6 mt-10 text-left">
        <a href="addSite" class="btn btn-sm btn-primary">
          <i class="material-icons">
            add
          </i> Add New Site
        </a>
      </div>
      <div class="row">

        @foreach ($sites as $sts)
        
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <img id="towers" src="storage/image/{{ $sts->image }}" alt="tower" >
                  </div>
                  <h3 class="card-title"><strong>{{$sts->station_id}}</strong></h3>
              </div>

              {{-- <div class="card card-row"> --}}

                <div class="card-footer">
                    <a rel="tooltip" href="inventory/{{$sts->site_id}}" class="btn btn-sm btn-info" >VIEW</a>
                </div>
  
                <form action="/deleteSite/{{$sts->site_id}}" class="" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-danger m-2" title="delete" onclick="return confirm('Are you sure you want to delete')">
                    DELETE
                  </button>
                </form>

              {{-- </div> --}}

          </div>
        </div>

        @endforeach
      </div>
  </div>
</div>

@endsection