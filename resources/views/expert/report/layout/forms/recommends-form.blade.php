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
                            {{-- <th>Group</th> --}}
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

                                    {{-- Jika index masih dalam range count, maka index tersebut pernah diisi pada record sebelumnya.
                                        Maka dari itu, kita harus mengetahui expert_report_id (primary key) dari record tersebut. --}}
                                    @if($index < $countRecommendationId)
                                        {{-- expert_report_id (primary key) dari record sebelumnya, disimpan dan dikirim kedalam
                                            sebuah input hidden untuk selanjutnya digunakan sebagai penanda untuk melakukan update
                                            pada kontroller --}}
                                        <input type="hidden" name="old_recommendation_id[{{$index}}]" value="{{$recommendationId[$index]}}">
                                    @endif
                                </td>
                                {{-- <td>
                                    <select name="recommends[{{ $index }}][group]"
                                        wire:model="recommends.{{ $index }}.group"
                                        class="form-control" disabled
                                    >
                                        <option selected value="0">TAMBAHAN</option>
                                        <option value="1">TRANSMITTER</option>
                                        <option value="2">RECEIVER</option>
                                        <option value="3">ANTENNA</option>
                                    </select>
                                </td> --}}
                                <td>
                                    <input type="text" class="form-control recommends-qty"
                                    name="recommends[{{ $index }}][jumlah_unit_needed]" 
                                    wire:model.defer="recommends.{{ $index }}.jumlah_unit_needed"
                                    >
                                </td>
                                <td>
                                    <a href="#"
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
                                {{-- <td>
                                    <select name="manualRecommends[{{ $index }}][group]"
                                        wire:model="manualRecommends.{{ $index }}.group"
                                        class="form-control"
                                    >
                                        <option selected value="0">TAMBAHAN</option>
                                        <option value="1">TRANSMITTER</option>
                                        <option value="2">RECEIVER</option>
                                        <option value="3">ANTENNA</option>
                                    </select>
                                </td> --}}
                                <td>
                                    <input type="text" class="form-control recommends-qty"
                                        name="manualRecommends[{{ $index }}][jumlah_unit_needed]" 
                                        wire:model.defer="manualRecommends.{{ $index }}.jumlah_unit_needed"
                                    >
                                </td>
                                <td>
                                    <a href="#"
                                        wire:click.prevent="selectItem({{ $index }}, 'manualRecommendation')">Delete</a>
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