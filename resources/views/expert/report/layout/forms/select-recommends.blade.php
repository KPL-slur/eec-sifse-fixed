<tr>
    <td>
        {{ $recommend['date'] ?? '' }}
    </td>
    <td>
        <div class='@error('recommends.'.$index.'.name') label-floating has-danger @enderror'>
            @error('recommends.'.$index.'.name')
                <label class="control-label force-has-danger">{{ $message }}</label>
            @enderror
            <select name="recommends[{{ $index }}][name]"
                wire:model="recommends.{{ $index }}.name"
                class="form-control"
            >
                <option value="">-- choose product --</option>
                @foreach ($stocks as $stock)
                <option value="{{ $stock['name'] }}">
                    {{ $stock['name'] }}
                </option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <div class="@error('recommends.'.$index.'.jumlah_unit_needed') label-floating has-danger @enderror">
            @error('recommends.'.$index.'.jumlah_unit_needed')
                <label class="control-label force-has-danger">{{ $message }}</label>
            @enderror
            <input type="text" class="form-control recommends-qty"
            name="recommends[{{ $index }}][jumlah_unit_needed]"
            wire:model.defer="recommends.{{ $index }}.jumlah_unit_needed"
            >
        </div>
    </td>
    <td>
        <a href="#" class="text-danger"
            wire:click.prevent="selectItem({{ $index }}, 'recommendation')">Delete</a>
    </td>
</tr>