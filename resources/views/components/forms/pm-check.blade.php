<div class="row">
    <label class="col-sm-2 col-form-label" for="input_{{ $namaKolom }}">{{ $slot->isEmpty() ? $namaKolom : $slot }}</label>
    <div class="col-sm-2">
        {{--  --}}
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label @error('radio_' . $namaKolom) force-has-danger @enderror">
                <input {{ ($pmBodyReport->$radioNamaKolom ?? old("radio_$namaKolom")) == "1" ? 'checked' : '' }} class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}1" value="1" wire:model.defer="radio_{{ $namaKolom }}"> PASS
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label @error('radio_' . $namaKolom) force-has-danger @enderror">
                <input {{ ($pmBodyReport->$radioNamaKolom ?? old("radio_$namaKolom")) == "0" ? 'checked' : '' }} class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}0" value="0" wire:model.defer="radio_{{ $namaKolom }}"> FAIL
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
    @if ( $type == 'pulse' )
        <div class="col-sm-2">
            <div class="input-group">
                <input class="form-control" input type="text" name="hvps_v_{{ $namaKolom }}"
                    id="input_HVPS_V_{{ $namaKolom }}" placeholder="{{ __('HVPS_V') }}" value="{{ $pmBodyReport->$hvpsVNamaKolom ?? old("hvps_v_$namaKolom") }}" wire:model.defer="hvps_v_{{ $namaKolom }}" />
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
                    id="input_HVPS_I{{ $namaKolom }}" placeholder="{{ __('HVPS_I') }}" value="{{ $pmBodyReport->$hvpsINamaKolom ?? old("hvps_i_$namaKolom") }}" wire:model.defer="hvps_i_{{ $namaKolom }}" />
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
                    id="input_Mag_I{{ $namaKolom }}" placeholder="{{ __('Mag_I') }}" value="{{ $pmBodyReport->$magINamaKolom ?? old("mag_i_$namaKolom") }}" wire:model.defer="mag_i_{{ $namaKolom }}" />
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
    @else
        <div class="col-sm-5">
            <div class="input-group">
                <input class="form-control @error($namaKolom) label-floating has-danger @enderror" input type="text"
                    name="{{ $namaKolom }}" id="input_{{ $namaKolom }}" placeholder="{{ $slot->isEmpty() ? $namaKolom : $slot }} remark"
                    value="{{ $pmBodyReport->$namaKolom ?? old($namaKolom) }}" wire:model.defer="{{ $namaKolom }}" />
                @if ($satuan)
                    <div class="input-group-append">
                        <span class="input-group-text">{{ $satuan }}</span>
                    </div>
                    @error($namaKolom)
                    <label class="control-label force-has-danger">{{ $message }}</label>
                    <span class="material-icons force-has-danger">clear</span>
                    @enderror
                @endif
            </div>
        </div>
    @endif
</div>