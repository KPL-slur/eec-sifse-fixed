<div class="row d-none" id="dynamicFields{{ $iterasiKe }}">
    <label class="col-sm-2 col-form-label"
        for="inputExpertise{{ $iterasiKe }}">{{ __('External Expertise') }}</label>
    <div class="col-sm-4">
        <div class="form-group @error('expertise' . $iterasiKe) label-floating has-danger @enderror">
            @error('expertise' . $iterasiKe)
                <label class="control-label">{{ $message }}</label>
                <span class="material-icons form-control-feedback">clear</span>
            @enderror
            @php
                $expertise = 'expertise' . $i;
            @endphp
            <input class="form-control" input type="text" name="expertise{{ $iterasiKe }}"
                id="inputExpertise{{ $iterasiKe }}" placeholder="{{ __('Name') }}"
                value="{{ $headReport->$expertise ?? old("expertise$iterasiKe") }}" />
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group @error('expertise_company' . $iterasiKe) label-floating has-danger @enderror">
            @error('expertise_company' . $iterasiKe)
                <label class="control-label">{{ $message }}</label>
                <span class="material-icons form-control-feedback">clear</span>
            @enderror
            {{-- Concat it with iteration so it can be used to extract the object --}}
            @php
                $expertiseCompany = 'expertise_company' . $i;
            @endphp
            <input class="form-control" input type="text" name="expertise_company{{ $iterasiKe }}"
                id="inputExpertiseCompany{{ $iterasiKe }}" placeholder="{{ __('Expertise Company') }}"
                value="{{ $headReport->$expertiseCompany ?? old("expertise_company$iterasiKe") }}" />
        </div>
    </div>
</div>
