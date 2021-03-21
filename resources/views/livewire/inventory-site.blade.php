<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @csrf

    <div class="form-group-site" id="products_table">
        <label>Stock</label>
        <div class="">
            @foreach ($sitedStock as $index => $sitedStock)
                <tr>
                    <td style="width: 20%">
                        <select name="stocks[{{ $index }}][stock_id]"
                            wire:model="sitedStock.{{ $index }}.stock_id"
                            class="form-control">
                            <option value="">-- choose product --</option>
                            @foreach ($stocks as $stock)
                            
                                @if ($stock->jumlah_unit > 0)
                                
                                    <option value="{{ $stock->stock_id }}">
                                        {{ $stock->nama_barang }}
                                    </option>
                                    
                                @endif
                            
                            @endforeach
                        </select>
                        <a class="d-inline mt-4 ml-1" href="#" 
                            wire:click.prevent="removeStock({{ $index }})">Delete
                        </a>
                    </td>
                </tr>
            @endforeach

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-secondary" wire:click.prevent="addStock">+ Add Another Product</button>
        </div>
    </div>
</div>
