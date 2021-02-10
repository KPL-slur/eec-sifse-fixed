{{-- INPUT LIST=
    radio_{{ $namaKolom }}
    {{ $namaKolom }} --}}
@php
    $radioNamaKolom = 'radio_' . $namaKolom;
@endphp
<div class="row">
    <label class="col-sm-2 col-form-label" for="input_{{ $namaKolom }}">{{ $namaKolom }}</label>
    <div class="col-sm-2">
        {{--  --}}
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label @error('radio_' . $namaKolom) force-has-danger @enderror">
                <input {{ ($pmBodyReport->$radioNamaKolom ?? old("radio_$namaKolom")) == "1" ? 'checked' : '' }} class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}1" value="1"> PASS
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label @error('radio_' . $namaKolom) force-has-danger @enderror">
                <input {{ ($pmBodyReport->$radioNamaKolom ?? old("radio_$namaKolom")) == "0" ? 'checked' : '' }} class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}0" value="0"> FAIL
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        {{--  --}}
        @error('radio_' . $namaKolom)
            <span class="material-icons force-has-danger">clear</span>
            <label class="control-label force-has-danger">{{ $message }}</label>
        @enderror
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            @error($namaKolom)
                <label class="control-label">{{ $message }}</label>
                <span class="material-icons form-control-feedback">clear</span>
            @enderror
            <input class="form-control @error($namaKolom) label-floating has-danger @enderror" input type="text"
                name="{{ $namaKolom }}" id="input_{{ $namaKolom }}" placeholder="{{ $namaKolom }} remark"
                value="{{ $pmBodyReport->$namaKolom ?? old($namaKolom) }}" />
        </div>
    </div>
</div>
