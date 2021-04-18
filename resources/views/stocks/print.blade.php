<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Print Stock of Sparepart')}}</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    {{-- <link href="{{ asset('user') }}/css/frameworks/gutenberg.css" rel="stylesheet" />
    <link href="{{asset('user')}}/css/print-inventory.css" rel="stylesheet" />  --}}
</head>

<body style="font-family: 'Times New Roman', Times, serif">

  <table>
    <thead>
      <tr>
        <td>
        <div class="headers">
          <img class="mT-30 mL-20" src="{{asset('user')}}/img/kop.png" alt="kop image" style="width: 300px !important;" />
          <p class="text-tiny">
            Jl. Benyamin Suaeb No. 5 Grand Palace Blok A No. 16 Kemayoran<br>
            Jakarta Pusat 10630, Indonesia<br>
            Phone : 021-22606878<br>
            FAX : 021-22606878<br>
          </p>
          {{-- <h4 class="c-grey-900 text-center mT-40 mB-0"><b>PT. Era Elektra Corpora Indonesia</b></h4>
          <h4 class="c-grey-900 text-center mB-50"><b>Inventory Stock</b></h4>
          <div class="text-center"> --}}
            <p id="demo"></p>
            <script>
              var d = new Date();
              document.getElementById("demo").innerHTML = d;
            </script>
          {{-- </div> --}}
        </div>
      </td>
    </tr>
    </thead>

    <tbody>
      <tr>
        <td>
        <div class="content">

          <div class="row">
              <div class="table-responsive">
                <table class="table tablesorter" id="">
                    <thead class=" text-primary">
                        <th scope="col">#</th>
                        <th scope="col">Group</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Ref des</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Expired</th>
                        <th scope="col">Kurs Beli</th>
                        <th scope="col">Jumlah Unit</th>
                        <th scope="col">Status</th>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $st)
                        <tr>
                          <td scope="row">{{$loop->iteration}}</td>
                          <td>{{ $st->group }}</td>
                          <td>{{ $st->nama_barang }}</td>
                          <td>{{ $st->ref_des }}</td>
                          <td>{{ $st->part_number }}</td>
                          <td>{{ $st->tgl_masuk }}</td>
                          <td>{{ $st->expired }}</td>
                          <td>{{ $st->kurs_beli }}</td>
                          <td>{{ $st->jumlah_unit }}</td>
                          <td>{{ $st->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
          </div>

        </div>
      </td>
    </tr>
    </tbody>

  </table>

  <script type="text/javascript">
    window.print();
 </script>

</body>

{{-- <body>
  <img class="mT-30 mL-20" src="{{ asset('material') }}/img/kop.png" alt="image" style="width:300px !important;">
  <h4 class="c-grey-900 text-center mT-40 mB-0"><b>PT. Era Elektra Corpora Indonesia</b></h4>
  <h4 class="c-grey-900 text-center mB-50"><b>Inventory Stock</b></h4>
  <div class="text-center">
    <p id="demo"></p>
    <script>
      var d = new Date();
      document.getElementById("demo").innerHTML = d;
    </script>
  </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Nama Barang</th>
                        <th>Part Number</th>
                        <th>Serial Number</th>
                        <th>Tanggal Masuk</th>
                        <th>Expired</th>
                        <th>Kurs Beli</th>
                        <th>Jumlah Unit</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $st)
                        <tr>
                          <td scope="row">{{$loop->iteration}}</td>
                          @if($st->group == 1)
                              <td>Transmitter</td>
                          @elseif($st->group == 2)
                              <td>Receiver</td>
                          @elseif($st->group == 3)
                              <td>Antenna</td>
                          @else
                              <td>Tambahan</td>
                          @endif
                          <td>{{ $st->nama_barang }}</td>
                          <td>{{ $st->part_number }}</td>
                          <td>{{ $st->serial_number }}</td>
                          <td>{{ $st->tgl_masuk }}</td>
                          <td>{{ $st->expired }}</td>
                          <td>{{ $st->kurs_beli }}</td>
                          <td>{{ $st->jumlah_unit }}</td>
                          @if ($st->status == 1)
                              <td>Obsolete</td>
                          @else
                              <td>Not Obsolete</td>
                          @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
         window.print();
      </script>

    <footer class="footer-export fixed-bottom text-center">
      <p class="mB-0">Head Office : Eightyeight@Kasablanka Tower A 26D floor. Jl. Raya Casablanca Kav. 88 Jakarta Selatan - 12870</p>
      <p class="mB-0">Operational Office : Grand Palace Rukan A-16. Jl. Benyamin Suaeb No.5 - Kemayoran. Jakarta Pusat - 10630</p>
      <p>Phone : 62-21-22606878, Email : eecindonesia@eecindonesia.co.id</p>
    </footer>

</body> --}}
</html>