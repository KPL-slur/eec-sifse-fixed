<div>
    <form action="{{ url("report/recommendations/$headId") }}" method="post">
        @csrf
        @method('put')

        <input type="hidden" name="head_id" value="{{ $headId }}">

        <table class="table" id="products_table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recommends as $index => $recommend)
                @if (array_key_exists('id', $recommend))
                    <input type="hidden" name="recommends[{{ $index }}][id]" value="{{ $recommend['id'] }}">
                @endif
                    <tr>
                        <td>
                            <select name="recommends[{{ $index }}][spare_part_name]"
                                wire:model="recommends.{{ $index }}.spare_part_name" class="form-control">
                                <option value="">-- choose product --</option>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->nama_barang }}" wire:ignore
                                        {{ $recommend['spare_part_name'] == $stock->nama_barang ? 'selected' : '' }}>
                                        {{ $stock->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="recommends[{{ $index }}][qty]"
                                wire:model="recommends.{{ $index }}.qty" class="form-control" value="{{ $recommend['qty'] }}" />
                        </td>
                        <td>
                            <a href="#" wire:click.prevent="removeRecommend({{ $index }}, {{ $recommend['id'] ?? null }})">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-secondary" wire:click.prevent="addRecommend">+ Add Another
                    Product</button>
            </div>
        </div>
        {{-- BUTTON GROUP --}}
        <div class="d-flex justify-content-end">
            <a type="button" class="btn btn-info" href="{{ url('expert') }}">BACK</a>
            <button type="submit" class="btn btn-primary mx-5">SUBMIT</button>
        </div>
    </form>
</div>