<tr>
    @php
        $radioNamaKolom = 'radio_' . $namaKolom;
    @endphp
    <td>{{ $label }}</td>
    <td
        class="{{ $pmBodyReport->$radioNamaKolom === 0 ? 'text-light bg-danger' : ($pmBodyReport->$radioNamaKolom === 1 ? 'text-light bg-success' : '') }}">
        {{ $pmBodyReport->$radioNamaKolom === 0 ? 'FAIL' : ($pmBodyReport->$radioNamaKolom === 1 ? 'PASS' : 'not defined') }}
    </td>
    <td colspan="3">{{ $pmBodyReport->$namaKolom ?? 'empty' }} <strong>{{ $satuan ?? '' }}</td>
</tr>
