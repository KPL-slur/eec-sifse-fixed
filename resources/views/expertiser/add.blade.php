@extends('layouts.app', ['activePage' => 'expert-management', 'titlePage' => __('Expert Management')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Add New Expert</h4>
          </div>

          <div class="card-body">
              <div class="table-responsive">
                <form action="/addExp" method="POST">
                    @csrf
      
                      <div class="form-group expert">
                        <label for="name">Expert Name</label>
                        <br>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror " id="name" name="name" placeholder="Input the Expert's Name" value="{{ old('name') }}">
                        
                        @error('name')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                     
                      <div class="form-group">
                        <label for="nip">NIP</label>
                        <br>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" placeholder="Input NIP Number" value="{{ old('nip') }}">
                        
                        @error('nip')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
      
                      <div class="form-group">
                        <label for="expert_company">Expert Company</label>
                        <br>
                        <input type="text" class="form-control @error('expert_company') is-invalid @enderror" id="expert_company" name="expert_company" placeholder="Input the Expert Company" value="{{ old('expert_company') }}">

                        @error('expert_company')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        
                        <button type="button" id="eec_expert" class="btn btn-sm my-4">if the expert is a member of EEC, click here</button>

                        <script type="text/javascript">
                            document.getElementById("eec_expert").addEventListener("click", (e) => {
                              document.getElementById("expert_company").value = 'Era Elektra Corpora Indonesia';
                            });
                          </script>

                        
                      </div>
                      
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure, you want to add this expert ?')">Submit</button>
                      <a href="{{ route('expertManagement') }}" class="btn btn-info ml-3 d-inline">Back</a>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection