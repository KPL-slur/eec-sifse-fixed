<div class="row {{ $index != 1 ? '' : '' }}" id="{{ "dynamicFields$index" }}">
    <label class="col-sm-2 col-form-label" for="inputExpert">{{ __('Expertise') }}</label>
    <div class="form-group col-md-8 @error("expert$index") label-floating has-danger has-error @enderror">
        <select class="form-control inputExpert " name="expert[{{ $index }}]"
            id="expertForms{{ $index }}">
            <option value="">Choose...</option>
            @foreach ($experts as $expert)
            <option value="{{ $expert['expert_id'] }}" {{ old("expert.".$index) == $expert['expert_id'] ? 'selected' : '' }}>{{ $expert['name'] }}</option>
            @endforeach
        </select>
        <select class="form-control inputExpert " name="expert_company[{{ $index }}]"
        id="expertCompanyForms{{ $index }}">
            <option selected value="">Choose...</option>
            @foreach ($uniqueCompany as $company)
            <option value="{{ $company['expert_company'] }} {{ old("expert_company.".$index) == $expert['expert_id'] ? 'selected' : '' }}">{{ $company['expert_company'] }}</option>
            @endforeach
        </select>
        <select class="form-control inputExpert " name="expert_nip[{{ $index }}]"
            id="expertNipForms{{ $index }}">
            <option selected value="">Choose...</option>
            @foreach ($experts as $expert)
            <option value="{{ $expert['nip'] }}" {{ old("expert_nip.".$index) == $expert['expert_id'] ? 'selected' : '' }}>{{ $expert['nip'] }}</option>
            @endforeach
        </select>
    </div>      
    @error("expert$index")
            <label class="control-label force-has-danger">{{ $message }}</label>
            <span class="material-icons form-control-feedback">clear</span>
    @enderror
</div>