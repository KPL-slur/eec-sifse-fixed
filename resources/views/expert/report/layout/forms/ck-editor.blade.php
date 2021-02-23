{{-- CKEDITOR REMARK --}}
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('REMARK') }}</h4>
    </div>

    <div class="card-body ">
        <div class="row">
            <div class="col-sm-7">
                <p class="text-danger">
                    @error('remark') {{ $message }} @enderror
                </p>
                <div class="form-group" wire:ignore>
                    <textarea class="editor" name="remark" id="editor" cols="50" rows="10" wire:model="remark"
                        class="form-control" placeholder="@error('remark') {{ $message }} @enderror">
                        {{ old('remark') }}
                    </textarea>
                </div>
                {{-- <button type="button" class="btn btn-info" id="save">Save</button> --}}
            </div>
        </div>
    </div>
</div>
{{-- END OF CKEDITOR REMARK --}}
