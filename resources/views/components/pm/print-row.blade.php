<tr>
    <td>{{ $label }}</td>
    @if ($radio === '1')
        <td>V</td>
        <td>&nbsp;</td>
    @elseif ($radio === "0")
        <td>&nbsp;</td>
        <td>V</td>
    @else
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    @endif
    @if ($remark !== NULL)
        <td>{{ $remark }} {{ $satuan }}</td>
    @endif
</tr>
