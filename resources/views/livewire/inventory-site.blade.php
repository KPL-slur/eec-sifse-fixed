<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @csrf

    <table class="table" id="products_table">
        <thead>
            <tr>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sitedStock as $index => $sitedStock)
                <tr>
                    <td>
                        <select name="stocks[{{ $index }}][stock_id]"
                            wire:model="sitedStock.{{ $index }}.stock_id"
                            class="form-control">

                            <option value="">-- choose product --</option>
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->stock_id }}">
                                    {{ $stock->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <a href="#"
                            wire:click.prevent="removeStock({{ $index }})">Delete</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-secondary" wire:click.prevent="addStock">+ Add Another Product</button>
        </div>
    </div>
</div>
