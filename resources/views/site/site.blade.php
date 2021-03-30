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

                <div class="card-footer d-flex">
                    <a title="view" href="inventory/{{$sts->site_id}}" class="btn btn-sm btn-info" >VIEW</a>

                    <button title="delete" class="btn btn-sm btn-danger m-2" data-toggle="modal" data-target="#modalDeleteSite">
                      DELETE
                    </button>
                    {{-- <form action="/deleteSite/{{$sts->site_id}}" class="d-inline" method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-sm btn-danger m-2" title="delete" onclick="return confirm('Are you sure you want to delete')">
                        DELETE
                      </button>
                    </form> --}}
                    
                </div>
  
          </div>

           {{-- Modal Confirmation--}}
           <div class="modal fade" id="modalDeleteSite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Are You Sure, You Want To Delete This Site ?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-footer">
                  <form method="POST" action="/deleteSite/{{$sts->site_id}}" class="d-inline">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    @csrf
                    @method('delete')
                    <button type="submit" role="tooltip" class="btn btn-info">Yes</button>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>

        @endforeach
      </div>
  </div>
</div>

@if (session('status3'))
    <script>
      window.onload = () => {
        showNotification('top', 'right', 'danger', '<?php echo session('status3') ?>');
      }
    </script>
@endif

@endsection