@component('mail::message')
# Expired Stocks

This is the list of stocks that are expired:

@component('mail::table')
| Nama Stock    | Part Number   | Expired Date  |
| ------------- |:-------------:| -------------:|
@foreach ($expired_stocks as $stock)
|{{$stock->nama_barang}}|{{$stock->part_number}}|{{$stock->expired}}|
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent