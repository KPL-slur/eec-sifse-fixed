<div>
    {{-- <form action="{{ url('report/recommendations') }}" method="post"> --}}
    {{-- @csrf --}}

    <table class="table" id="experts_table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Nip</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($experts as $index => $expert)
                <tr>
                    <td>
                        <div class='@error(' experts.0.expert_name') label-floating has-danger @enderror'>
                            @error('experts.0.expert_name')
                                <label class="control-label force-has-danger">{{ $message }}</label>
                                <span class="material-icons form-control-feedback">clear</span>
                            @enderror
                            <select name="experts[{{ $index }}][expert_name]"
                                id="experts[{{ $index }}][expert_name]"
                                wire:model="experts.{{ $index }}.expert_name" class="form-control">
                                <option value="">-- choose expert --</option>
                                @foreach ($expertsData as $expertData)
                                    <option value="{{ $expertData->name }}">
                                        {{ $expertData->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <select name="experts[{{ $index }}][expert_company]"
                            wire:model="experts.{{ $index }}.expert_company" class="form-control">
                            <option value="">-- choose expert company --</option>
                            @foreach ($uniqueCompanies as $uniqueCompany)
                                <option value="{{ $uniqueCompany->expert_company }}">
                                    {{ $uniqueCompany->expert_company }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="experts[{{ $index }}][expert_nip]"
                            wire:model="experts.{{ $index }}.expert_nip" class="form-control">
                            <option value="">-- choose nip --</option>
                            @foreach ($expertsData as $expertData)
                                <option value="{{ $expertData->nip }}">
                                    {{ $expertData->nip }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="removeExpert({{ $index }})">Delete</a>
                    </td>
                </tr>
            @endforeach

            @foreach ($manualExperts as $index => $manualExpert)
                <tr>
                    <td>
                        <input type="text" class="form-control" name="manualExperts[{{ $index }}][expert_name]"
                            wire:model.defer="manualExperts.{{ $index }}.expert_name">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                            name="manualExperts[{{ $index }}][expert_company]"
                            wire:model.defer="manualExperts.{{ $index }}.expert_company">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="manualExperts[{{ $index }}][expert_nip]"
                            wire:model.defer="manualExperts.{{ $index }}.expert_nip">
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="removeManualExpert({{ $index }})">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-secondary" wire:click.prevent="addExpert">+ Add Another Expert</button>
            <button class="btn btn-sm btn-secondary" wire:click.prevent="addManualExpert">+ Add Manual Expert</button>
        </div>
    </div>
    {{-- BUTTON GROUP --}}
    {{-- <div class="d-flex justify-content-end">
            <a type="button" class="btn btn-info" href="{{ url('expert') }}">BACK</a>
            <button type="submit" class="btn btn-primary mx-5">SUBMIT</button>
        </div> --}}
    {{-- </form> --}}
</div>
