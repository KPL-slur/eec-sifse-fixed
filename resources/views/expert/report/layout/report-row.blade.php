<tr>
    @php
        $radioNamaKolom = 'radio_' . $namaKolom;
    @endphp
    <td>{{ $namaKolom }}</td>
    <td>{{ ($pmBodyReport->$radioNamaKolom === 0 ? 'FAIL' : $pmBodyReport->$radioNamaKolom === 1) ? 'PASS' : 'not defined' }}
    </td>
    <td colspan="3">{{ $pmBodyReport->$namaKolom ?? 'empty' }} <strong>{{ $satuan ?? "" }}</strong></td>
</tr>
