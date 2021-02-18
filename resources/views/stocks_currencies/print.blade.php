<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Print</title>
</head>
<body>
    <h1 class="text-center">Laporan Harian</h1>
    <div class="text-center">
      <p id="tanggal"></p>
      <script>
        var d = new Date();
        document.getElementById("tanggal").innerHTML = d;
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
                        <th>Lokasi Site</th>
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
                        @foreach ($siteAndStock as $st)
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
                            <td>{{ $st->station_id }}</td>
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
        // window.print();
      </script>
</body>
</html>