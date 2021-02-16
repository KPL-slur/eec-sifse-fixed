<div class="row {{ $index != 1 ? '' : '' }}" id="{{ "dynamicFields$index" }}">
    <label class="col-sm-2 col-form-label" for="inputExpert">{{ __('Expertise') }}</label>
    <div class="form-group col-md-8 @error('expert') label-floating has-danger @enderror">
        @error('expert')
            <label class="control-label force-has-danger">{{ $message }}</label>
            <span class="material-icons form-control-feedback">clear</span>
        @enderror
        <div>
            <select class="form-control inputExpert " name="expert[{{ $index }}]"
                id="expertForms{{ $index }}">
                <option selected value="">Choose...</option>
                @foreach ($experts as $expert)
                    <option value="{{ $expert['name'] }}">{{ $expert['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>      
</div>