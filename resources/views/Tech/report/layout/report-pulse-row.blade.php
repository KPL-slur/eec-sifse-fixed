<tr>
    @php
        $radioNamaKolom = 'radio_' . $namaKolom;
        $remarkNamaKolom1 = 'hvps_v_' . $namaKolom;
        $remarkNamaKolom2 = 'hvps_i_' . $namaKolom;
        $remarkNamaKolom3 = 'mag_i_' . $namaKolom;
    @endphp
    <td>{{ $namaKolom }}</td>
    <td>{{ ($pmBodyReport->$radioNamaKolom === 0 ? 'FAIL' : $pmBodyReport->$radioNamaKolom === 1) ? 'PASS' : 'not defined' }}
    </td>
    <td>{{ $pmBodyReport->$remarkNamaKolom1 ?? 'empty' }} <strong>V</strong></td>
    <td>{{ $pmBodyReport->$remarkNamaKolom2 ?? 'empty' }} <strong>A</strong></td>
    <td>{{ $pmBodyReport->$remarkNamaKolom3 ?? 'empty' }} <strong>mA</strong></td>
</tr>
