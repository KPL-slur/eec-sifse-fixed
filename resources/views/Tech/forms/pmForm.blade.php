<div class="row">
    <label class="col-sm-2 col-form-label"
        for="input_{{ $namaKolom }}">{{ $namaKolom }}</label>
    <div class="col-sm-2">
        {{--  --}}
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}1" value="1"> PASS
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}0" value="0"> FAIL
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        {{--  --}}
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <input class="form-control" input type="text" name="{{ $namaKolom }}"
                id="input_{{ $namaKolom }}" placeholder="{{ $namaKolom }} remark" value=""
                   />
        </div>
    </div>
</div>