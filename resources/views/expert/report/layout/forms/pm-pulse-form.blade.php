{{-- INPUT LIST:
    radio_{{ $namaKolom }}
    hvps_v_{{ $namaKolom }}
    hvps_i_{{ $namaKolom }}
    mag_i_{{ $namaKolom }} --}}
@php
    $radioNamaKolom = 'radio_' . $namaKolom;
    $hvpsVNamaKolom = 'hvps_v_' . $namaKolom;
    $hvpsINamaKolom = 'hvps_i_' . $namaKolom;
    $magINamaKolom = 'mag_i_' . $namaKolom;
@endphp
<div class="row">
    <label class="col-sm-2 col-form-label" for="input_HVPS_V_{{ $namaKolom }}">{{ $namaKolom }}</label>
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
    <div class="col-sm-2">
        <div class="input-group">
            <input class="form-control" input type="text" name="hvps_v_{{ $namaKolom }}"
                id="input_HVPS_V_{{ $namaKolom }}" placeholder="{{ __('HVPS_V') }}" value="{{ $pmBodyReport->$hvpsVNamaKolom ?? old("hvps_v_$namaKolom") }}" />
            <div class="input-group-append">
                <span class="input-group-text">V</span>
            </div>
        </div>
        <div class="form-group @error('hvps_v_' . $namaKolom) label-floating has-danger @enderror">
            @error('hvps_v_' . $namaKolom)
                <label class="control-label force-has-danger">{{ $message }}</label>
                <span class="material-icons form-control-feedback ">clear</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-2">
        <div class="input-group">
            <input class="form-control" input type="text" name="hvps_i_{{ $namaKolom }}"
                id="input_HVPS_I{{ $namaKolom }}" placeholder="{{ __('HVPS_I') }}" value="{{ $pmBodyReport->$hvpsINamaKolom ?? old("hvps_i_$namaKolom") }}" />
            <div class="input-group-append">
                <span class="input-group-text">A</span>
            </div>
        </div>
        <div class="form-group @error('hvps_i_' . $namaKolom) label-floating has-danger @enderror">
            @error('hvps_i_' . $namaKolom)
                <label class="control-label force-has-danger">{{ $message }}</label>
                <span class="material-icons form-control-feedback ">clear</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-2">
        <div class="input-group">
            <input class="form-control" input type="text" name="mag_i_{{ $namaKolom }}"
                id="input_Mag_I{{ $namaKolom }}" placeholder="{{ __('Mag_I') }}" value="{{ $pmBodyReport->$magINamaKolom ?? old("mag_i_$namaKolom") }}" />
            <div class="input-group-append">
                <span class="input-group-text">mA</span>
            </div>
        </div>
        <div class="form-group @error('mag_i_' . $namaKolom) label-floating has-danger @enderror">
            @error('mag_i_' . $namaKolom)
                <label class="control-label force-has-danger">{{ $message }}</label>
                <span class="material-icons form-control-feedback ">clear</span>
            @enderror
        </div>
    </div>

</div>
