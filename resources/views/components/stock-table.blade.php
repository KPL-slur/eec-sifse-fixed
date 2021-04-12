<div class="card m-3 my-5">

    <div class="card-header card-header-rose">
        <p class="card-category" id="groupStocksCardHeader">Semua</p>
    </div>

    <div class="card-body">
        <div class="row">

            <x-ui.spinner id="spinner" className="spinner-center"/>

            <div class="col material-datatables">
                <table class="table table-no-bordered table-hover d-none" cellspacing="0" width="100%" style="width:100%" id="indexStocksTable">
                    <thead class=" text-primary text-middle">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Part Number</th>
                        <th>Serial Number</th>
                        <th>Tanggal Masuk</th>
                        <th>Expired</th>
                        <th>Kurs Beli</th>
                        <th>Jumlah Unit</th>
                        <th>Status</th>
                        <th class="text-center">Update or delete</th>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $st)
                            <tr>
                                <input type="hidden" value="{{ $st->group }}">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $st->nama_barang }}</td>
                                <td>{{ $st->part_number }}</td>
                                <td>{{ $st->serial_number }}</td>
                                <td>{{ $st->tgl_masuk }}</td>
                                <td>{{ $st->expired }}</td>
                                <td>{{ $st->kurs_beli }}</td>
                                <td>{{ $st->jumlah_unit }}</td>
                                <td>{{ $st->status }}</td>
                                <td class="td-actions text-center">
                                    <a rel="tooltip" class="btn btn-lg btn-warning m-2"
                                        href="{{ url('stocks') }}/{{ $st->stock_id }}/edit" type="submit">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </a>
                                    <form action="{{ url('stocks') }}/{{ $st->stock_id }}" class="d-inline"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-lg btn-danger m-2" title="delete"
                                            onclick="return confirm('Are you sure you want to delete '+ '{{ $st->nama_barang }}' +'?')">
                                            <i class="material-icons">delete</i>
                                            <div class="ripple-container"></div>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(() => {
            $("#indexStocksTable").DataTable({
                "pagingType": "numbers",
                "lengthMenu": [
                    [5, 10, 20, 50, 250, 500],
                    [5, 10, 20, 50, 250, 500],
                ],
                responsive: true,
                language: {
                    searchPlaceholder: "Search records",
                }
            });
            $('#spinner').addClass('d-none');
            $("#indexStocksTable").removeClass('d-none');
        });

    </script>
@endpush
