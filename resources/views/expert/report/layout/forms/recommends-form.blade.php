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
                    @if (empty($recommends) && empty($manualRecommends))
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <p class="text-danger">There are no recommendation(s) yet. You can add a new one or click next to skip</p>
                                </td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                        @foreach ($recommends as $index => $recommend)
                            @if (array_key_exists('head_id', $recommend) && $recommend['head_id'] != $head_id)
                                @include('expert.report.layout.forms.select-recommends')
                            @endif
                        @endforeach
                        </tbody>
                        <tbody class="border border-primary">
                        @foreach ($recommends as $index => $recommend)
                            @if (array_key_exists('head_id', $recommend) && $recommend['head_id'] == $head_id)
                                @include('expert.report.layout.forms.select-recommends')
                            @elseif (! array_key_exists('head_id', $recommend))
                                @include('expert.report.layout.forms.select-recommends')
                            @endif
                        @endforeach
                        @foreach ($manualRecommends as $index => $manualRecommend)
                            <tr>
                                <td>
                                    <div class="@error('manualRecommends.'.$index.'.name') label-floating has-danger @enderror">
                                        @error('manualRecommends.'.$index.'.name')
                                            <label class="control-label force-has-danger">{{ $message }}</label>
                                        @enderror
                                        <input type="text" class="form-control"
                                            name="manualRecommends[{{ $index }}][name]"
                                            wire:model.defer="manualRecommends.{{ $index }}.name">
                                    </div>
                                </td>
                                <td>
                                    <div class="@error('manualRecommends.'.$index.'.jumlah_unit_needed') label-floating has-danger @enderror">
                                        @error('manualRecommends.'.$index.'.jumlah_unit_needed')
                                            <label class="control-label force-has-danger">{{ $message }}</label>
                                        @enderror
                                        <input type="text" class="form-control recommends-qty"
                                            name="manualRecommends[{{ $index }}][jumlah_unit_needed]"
                                            wire:model.defer="manualRecommends.{{ $index }}.jumlah_unit_needed"
                                        >
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-danger"
                                        wire:click.prevent="selectItem({{ $index }}, 'manualRecommendation')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif
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