<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Recommendations') }}</h4>
    </div>

    <div class="card-body">
        <div>
        
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($recommends) && empty($manualRecommends))
                            <tr>
                                <td colspan="3">
                                    <p class="text-danger">There are no recommendation(s) yet. You can add a new one or click next to skip</p>
                                </td>
                            </tr>
                        @endif
                        @foreach ($recommends as $index => $recommend)
                            <tr>
                                <td>
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
                                </td>
                                <td>
                                    <input type="text" class="form-control recommends-qty"
                                    name="recommends[{{ $index }}][jumlah_unit_needed]" 
                                    wire:model.defer="recommends.{{ $index }}.jumlah_unit_needed"
                                    >
                                </td>
                                <td>
                                    <a href="#" class="text-danger"
                                        wire:click.prevent="selectItem({{ $index }}, 'recommendation')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($manualRecommends as $index => $manualRecommend)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" 
                                        name="manualRecommends[{{ $index }}][name]" 
                                        wire:model.defer="manualRecommends.{{ $index }}.name">
                                </td>
                                <td>
                                    <input type="text" class="form-control recommends-qty"
                                        name="manualRecommends[{{ $index }}][jumlah_unit_needed]" 
                                        wire:model.defer="manualRecommends.{{ $index }}.jumlah_unit_needed"
                                    >
                                </td>
                                <td>
                                    <a href="#" class="text-danger"
                                        wire:click.prevent="selectItem({{ $index }}, 'manualRecommendation')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <x-ui.action-message on="unsetRecommendation" type="danger">
                            Recommendation Record Deleted
                        </x-ui.action-message>
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addRecommend">+ Add Another Product</button>
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addManualRecommends">+ Add Manual Product</button>
                    </div>
                </div>
        </div>
        
    </div>
</div>