<div class="row">
    <label class="col-sm-2 col-form-label" for="input{{ $namaKolom }}">{{ $namaKolom }}</label>
    <div class="col-sm-8">
        <div class="form-group @error($namaKolom) label-floating has-danger @enderror">
            @error($namaKolom)
            <label class="control-label force-has-danger">{{ $message }}</label>
            <span class="material-icons form-control-feedback">clear</span>
            @enderror
            <input class="form-control " wire:model="{{ $namaKolom }}"
                type="{{ $tipeForm }}" name="{{ $namaKolom }}" id="input{{ $namaKolom }}"
                placeholder="{{ $namaKolom }}" value="{{ ($headReport->$namaKolom) ?? old($namaKolom) }}" />
        </div>
    </div>
</div>
