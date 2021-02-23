<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
    </div>

    <div class="card-body">
        <div>
        
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
                            <tr>
                                <td>
                                    <select name="recommends[{{ $index }}][stock_id]"
                                        wire:model="recommends.{{ $index }}.stock_id"
                                        class="form-control"
                                    >
                                        <option value="">-- choose product --</option>
                                        @foreach ($stocks as $stock)
                                            <option value="{{ $stock->stock_id }}">
                                                {{ $stock->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control"
                                        name="recommends[{{ $index }}][jumlah_unit_needed]" 
                                        wire:model="recommends.{{ $index }}.jumlah_unit_needed"
                                    >
                                </td>
                                <td></td>
                                <td>
                                    <a href="#"
                                        wire:click.prevent="removeRecommend({{ $index }})">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Group</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($manualRecommends as $index => $manualRecommend)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" 
                                        name="manualRecommends[{{ $index }}][nama_barang]" 
                                        wire:model.defer="manualRecommends.{{ $index }}.nama_barang">
                                </td>
                                <td>
                                    <select name="manualRecommends[{{ $index }}][group]"
                                        wire:model="manualRecommends.{{ $index }}.group"
                                        class="form-control"
                                    >
                                        <option selected value="0">TAMBAHAN</option>
                                        <option value="1">TRANSMITTER</option>
                                        <option value="2">RECEIVER</option>
                                        <option value="3">ANTENNA</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control"
                                        name="manualRecommends[{{ $index }}][jumlah_unit_needed]" 
                                        wire:model.defer="manualRecommends.{{ $index }}.jumlah_unit_needed"
                                    >
                                </td>
                                <td>
                                    <a href="#"
                                        wire:click.prevent="removeManualRecommends({{ $index }})">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addRecommend">+ Add Another Product</button>
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addManualRecommends">+ Add Manual Product</button>
                    </div>
                </div>
        </div>
        
    </div>
</div>