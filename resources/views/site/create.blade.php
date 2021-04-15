@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Input Stocks on Site')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Input Inventory {{$sites->radar_name}}</h4>
          </div>
          <div class="card-body text-center">

            <form action="/addInventorySite" method="POST">
              @csrf
              <input type="hidden" class="form-control @error('stock_id') is-invalid @enderror" id="site_id" name="site_id" value="{{ $sites->site_id }}">
              
              <div class="form-group-site ">
                @livewire('inventory-site', ['stocks' => $stocks])
                
              </div>


                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/inventory/{{$sites->site_id}}" class="btn btn-info ml-3 d-inline">Back</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection