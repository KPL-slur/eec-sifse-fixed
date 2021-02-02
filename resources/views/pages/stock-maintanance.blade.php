@extends('layouts.app', ['activePage' => 'stock-currency', 'titlePage' => __('Stocks for maintanance')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Table Inventory and Exchange Rate</h4>
                        <p class="card-category"> Here is a subtitle for this table</p>
                    </div>
                    <div class="card-body">
                        <div class="text-right">
                            <a class="btn btn-sm btn-primary text-right" href="#">Add Inventory</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead class=" text-primary text-middle">
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Masuk</th>
                                <th>Kurs Saat Membeli</th>
                                <th class="text-right">Update or delete</th>
                            </thead>
                            <tbody>
                                <tr>
                                <td>1</td>
                                <td>Dakota Rice</td>
                                <td>01-02-2021</td>
                                <td class="text-primary">$36,738</td>
                                <td class="td-actions text-right">
                                    <a rel="tooltip" class="btn btn-lg btn-success btn-link" href="#{{-- route('editDistribution') --}}" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </a>
                                    <button class="btn btn-lg btn-danger btn-link" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                        <i class="material-icons">delete</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection