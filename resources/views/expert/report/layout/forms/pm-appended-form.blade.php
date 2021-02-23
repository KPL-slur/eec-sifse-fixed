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
                    id="input_{{ $namaKolom }}1" value="1" wire:model="radio_{{ $namaKolom }}"> PASS
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label @error('radio_' . $namaKolom) force-has-danger @enderror">
                <input {{ ($pmBodyReport->$radioNamaKolom ?? old("radio_$namaKolom")) == "0" ? 'checked' : '' }} class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}0" value="0" wire:model="radio_{{ $namaKolom }}"> FAIL
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
        <div class="input-group">
            <input class="form-control @error($namaKolom) label-floating has-danger @enderror" input type="text"
                name="{{ $namaKolom }}" id="input_{{ $namaKolom }}" placeholder="{{ $namaKolom }} remark"
                value="{{ $pmBodyReport->$namaKolom ?? old($namaKolom) }}" wire:model.defer="{{ $namaKolom }}" />
            <div class="input-group-append">
                <span class="input-group-text">{{ $satuan }}</span>
            </div>
            @error($namaKolom)
                <label class="control-label force-has-danger">{{ $message }}</label>
                <span class="material-icons force-has-danger">clear</span>
            @enderror
        </div>
    </div>
</div>
