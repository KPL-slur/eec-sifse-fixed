@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Input Stocks and their currencies')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">Input Inventory with Exchange Rate</h4>
            <p class="card-category"> Here you can manage company item</p>
          </div>
          <div class="card-body">
            <p class="mb-4 text-center h3">
              Current Exchange Rates : <span class="text-primary text-center display-4">Rp {{ $rate_fix }}</span> to USD</p>
            <form action="{{ url('stocks/') }}" method="POST">
              @csrf

                <div class="form-group my-4">
                  <label for="nama_barang">Item Name</label>
                  <input type="text" class="form-control @error('nama_barang') is-invalid @enderror " id="nama_barang" name="nama_barang" placeholder="Input Item Name" value="{{ old('nama_barang') }}">
                  
                  @error('nama_barang')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                      
                </div>
                <div class="form-group my-4">
                  <label for="group">Item's Group</label>
                  <br>
                  <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                    <option value="" {{ old('group') == '' ? 'selected' : '' }} >-- Choose Item Group --</option>
                    @foreach ($stocks_group as $sg)
                      <option value="{{$sg}}" {{ old('group') == $sg ? 'selected' : '' }}>{{ $sg }}</option>
                    @endforeach
                  </select>
                  @error('group')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="part_number">Part Number</label>
                  <input type="text" class="form-control @error('part_number') is-invalid @enderror" id="part_number" name="part_number" placeholder="Input Part Number" value="{{ old('part_number') }}">
                  @error('part_number')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="ref_des">Ref des</label>
                  <input type="text" class="form-control @error('ref_des') is-invalid @enderror" id="ref_des" name="ref_des" placeholder="Input Ref des" value="{{ old('ref_des') }}">
                  @error('ref_des')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="tgl_masuk">Date of Entry / Edit</label>
                  <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" name="tgl_masuk" placeholder="Date Input" value="{{ old('tgl_masuk') }}">
                  @error('tgl_masuk')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="expired">Life expectancy</label>
                  <input type="date" class="form-control @error('expired') is-invalid @enderror" id="expired" name="expired" placeholder="Expected lifetime" value="{{ old('expired') }}">
                  @error('expired')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="kurs_beli">Buying Rate</label>
                  <input type="text" class="form-control @error('kurs_beli') is-invalid @enderror" id="kurs_beli" name="kurs_beli" placeholder="Input Buying Rate" value="{{ old('kurs_beli') }}">
                  <button type="button" id="button_kurs_beli" class="btn btn-sm my-4">
                    want to enter the current exchange rate ?</button>
                  <script type="text/javascript">
                    document.getElementById("button_kurs_beli").addEventListener("click", (e) => {
                      document.getElementById("kurs_beli").value = '{{ $rate_fix }}';
                    });
                  </script>
                  @error('kurs_beli')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group my-4">
                  <label for="jumlah_unit">Number of Units</label>
                  <input type="text" class="form-control @error('jumlah_unit') is-invalid @enderror" id="jumlah_unit" name="jumlah_unit" placeholder="How many units do you want to include ?" value="{{ old('jumlah_unit') }}" >
                  @error('jumlah_unit')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror                  
                </div>
                <div class="form-group my-4">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="" disabled selected>-- is it obsolete or not? --</option>
                    <option value="Not Obsolete" {{ old('status') === "Not Obsolete" ? 'selected' : '' }}>Not Obsolete</option>
                    <option value="Obsolete" {{ old('group') === "Obsolete" ? 'selected' : '' }}>Obsolete</option>
                    <option value="Dummy" {{ old('group') === "Dummy" ? 'selected' : '' }}>Dummy</option>
                  </select>
                  @error('status')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>                    
                <div class="form-group my-4">
                  <label for="keterangan">Item's Information</label>
                  <input type="text" class="form-control @error('keterangan') is-invalid @enderror " id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                  @error('keterangan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url('stocks/') }}" class="btn btn-info ml-3 d-inline">Back</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = () => {
    $('#group').select2({
      tags: true
    });
  };
</script>

@endsection
