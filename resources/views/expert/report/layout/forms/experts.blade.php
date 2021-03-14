<div class="row">
    <div class="card ">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Experts') }}</h4>
        </div>

        <div class="card-body">
            <div>
            
                <table class="table" id="experts_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Nip</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($experts as $index => $expert)
                            <tr>
                                <td>
                                    <div class='@error(' experts.'.$index.'.expert_id') label-floating has-danger @enderror'>
                                        @error('experts.'.$index.'.expert_id')
                                            <label class="control-label force-has-danger">{{ $message }}</label>
                                            <span class="material-icons form-control-feedback">clear</span>
                                        @enderror
                                        <select name="experts[{{ $index }}][expert_id]"
                                            id="experts[{{ $index }}][expert_id]"
                                            wire:model="experts.{{ $index }}.expert_id" wire:change="setCompanyAndNip({{ $index }})" class="form-control">
                                            <option value="">-- choose expert --</option>
                                            @foreach ($expertsData as $expertData)
                                                <option value="{{ $expertData->expert_id }}" 
                                                    {{-- {{ $headReport->site_id == $expertData->expert_id ? 'selected' : '' }} --}}
                                                    >
                                                        {{ $expertData->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        {{-- Jika index masih dalam range count, maka index tersebut pernah diisi pada record sebelumnya.
                                            Maka dari itu, kita harus mengetahui expert_report_id (primary key) dari record tersebut. --}}
                                        @if($index < $countExpertReportId)
                                            {{-- expert_report_id (primary key) dari record sebelumnya, disimpan dan dikirim kedalam
                                                sebuah input hidden untuk selanjutnya digunakan sebagai penanda untuk melakukan update
                                                pada kontroller --}}
                                            <input type="hidden" name="old_expert_report_id[{{$index}}]" value="{{$expertReportId[$index]}}">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    {{-- <select name="experts[{{ $index }}][expert_company]"
                                        wire:model="experts.{{ $index }}.expert_company" class="form-control">
                                        <option value="">-- choose expert company --</option>
                                        @foreach ($uniqueCompanies as $uniqueCompany)
                                            <option value="{{ $uniqueCompany->expert_company }}">
                                                {{ $uniqueCompany->expert_company }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    <input class="form-control "
                                            disabled type="text"
                                            name="experts[{{ $index }}][expert_company]"  
                                            wire:model="experts.{{ $index }}.expert_company"
                                            {{-- value="{{ ($selectedExpert[$index]->expert_company) ?? '' }}"  --}}
                                    />
                                </td>
                                <td>
                                    {{-- <select name="experts[{{ $index }}][expert_nip]"
                                        wire:model="experts.{{ $index }}.expert_nip" class="form-control">
                                        <option value="">-- choose nip --</option>
                                        @foreach ($expertsData as $expertData)
                                            <option value="{{ $expertData->nip }}">
                                                {{ $expertData->nip }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    <input class="form-control "
                                            disabled type="text"
                                            name="experts[{{ $index }}][expert_nip]" 
                                            wire:model="experts.{{ $index }}.expert_nip"
                                            {{-- value="{{ ($selectedExpert[$index]->nip) ?? '' }}"  --}}
                                    />
                                </td>
                                <td>
                                    <div class="@error('experts.'.$index.'.expert_role') label-floating has-danger @enderror">
                                        @error('experts.'.$index.'.expert_role')
                                            <label class="control-label force-has-danger">{{ $message }}</label>
                                            <span class="material-icons form-control-feedback">clear</span>
                                        @enderror
                                        <input class="form-control"
                                                type="text"
                                                name="experts[{{ $index }}][expert_role]" 
                                                wire:model.defer="experts.{{ $index }}.expert_role" 
                                        />
                                    </div>
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent="selectItem({{ $index }}, 'expert')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
            
                        @foreach ($manualExperts as $index => $manualExpert)
                            <tr>
                                <td>
                                    <div class="@error('manualExperts.'.$index.'.expert_name') label-floating has-danger @enderror">
                                        @error('manualExperts.'.$index.'.expert_name')
                                            <label class="control-label force-has-danger">{{ $message }}</label>
                                            <span class="material-icons form-control-feedback">clear</span>
                                        @enderror
                                        <input type="text" class="form-control" name="manualExperts[{{ $index }}][expert_name]"
                                            wire:model.defer="manualExperts.{{ $index }}.expert_name">
                                    </div>
                                </td>
                                <td>
                                    <div class="@error('manualExperts.'.$index.'.expert_company') label-floating has-danger @enderror">
                                        @error('manualExperts.'.$index.'.expert_company')
                                            <label class="control-label force-has-danger">{{ $message }}</label>
                                            <span class="material-icons form-control-feedback">clear</span>
                                        @enderror
                                        <input type="text" class="form-control"
                                            name="manualExperts[{{ $index }}][expert_company]"
                                            wire:model.defer="manualExperts.{{ $index }}.expert_company">
                                    </div>
                                </td>
                                <td>
                                    <div class="@error('manualExperts.'.$index.'.expert_nip') label-floating has-danger @enderror">
                                        @error('manualExperts.'.$index.'.expert_nip')
                                            <label class="control-label force-has-danger">{{ $message }}</label>
                                            <span class="material-icons form-control-feedback">clear</span>
                                        @enderror
                                        <input type="number" class="form-control" name="manualExperts[{{ $index }}][expert_nip]"
                                            wire:model.defer="manualExperts.{{ $index }}.expert_nip">
                                    </div>
                                </td>
                                <td>
                                    <div class="@error('manualExperts.'.$index.'.expert_role') label-floating has-danger @enderror">
                                        @error('manualExperts.'.$index.'.expert_role')
                                            <label class="control-label force-has-danger">{{ $message }}</label>
                                            <span class="material-icons form-control-feedback">clear</span>
                                        @enderror
                                        <input class="form-control"
                                                type="text"
                                                name="manualExperts[{{ $index }}][expert_role]" 
                                                wire:model.defer="manualExperts.{{ $index }}.expert_role" 
                                            />
                                    </div>
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent="selectItem({{ $index }}, 'manualExpert')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addExpert">+ Add Another Expert</button>
                        @if (empty($experts))
                            <p class="text-danger d-inline"> select atleast one expert to continue </p>
                        @else
                            <button class="btn btn-sm btn-secondary" id="btnManualExpert" wire:click.prevent="addManualExpert">+ Add Manual Expert</button>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>