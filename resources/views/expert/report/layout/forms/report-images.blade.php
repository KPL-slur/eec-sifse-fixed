@if (empty($attachments))
    <div class="card ">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Attachments') }}</h4>
        </div>
        <div class="card-body ">
            <h5 class="text-danger">There are no attachment(s) yet. You can add a new one or click submit to skip</h5>
        </div>
    </div>
@endif
@foreach ($attachments as $index => $attachment)

    <div class="card ">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Attachments') }}</h4>
        </div>

        <div class="card-body">
            @if ($attachments[$index]['uploaded'] === 1)
                <div class="row">
                    <div class="col-10 alert alert-success">
                        UPLOADED
                    </div>
                </div>
            @endif
            @error('attachments.' . $index . '.caption')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="row">
                <label class="col-sm-2 col-form-label" for="inputCaption">Caption</label>
                <div class="col-sm-8">
                    <div class="form-group">
                        <input class="form-control" type="text" name="attachments[{{ $index }}][caption]"
                            id="inputCaption{{ $index }}" placeholder="Caption..." value=""
                            wire:model.defer="attachments.{{ $index }}.caption" />
                    </div>
                </div>
            </div>
            @error('attachments.' . $index . '.image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="row">
                {{-- <label class="col-sm-2 col-form-label" for="inputImage">Image File</label>
                <div class="col-sm-8">
                    <div class="form-group">
                        <input class="form-control "
                            type="file" name="image" id="inputImage" value=""
                            wire:model="image" />
                    </div>
                </div> --}}
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    {{-- <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div> --}}
                    <div class="">
                        <span
                            class="btn btn-raised btn-round btn-default btn-file {{ $attachments[$index]['image'] ? 'd-none' : '' }}">
                            <input type="file" name="attachments[{{ $index }}][image]" class="fileinput-new"
                                wire:model='attachments.{{ $index }}.image' />
                        </span>

                    </div>
                </div>
                <div wire:loading wire:target="photo">Uploading...</div>
                @if ($attachments[$index]['image'])
                    <img class="fileinput-preview fileinput-exists thumbnail img-raised image-upload-preview"
                        src="{{ is_string($attachments[$index]['image']) ? asset('storage/'.$attachments[$index]['image']) : $attachments[$index]['image']->temporaryUrl() }}">
                    {{-- <div>
                        <button class="btn btn-sm btn-primary {{ $attachments[$index]['uploaded'] === 1 ? 'd-none' : '' }}"
                            wire:click.prevent="fileUpload({{ $index }})">Upload</button>
                    </div> --}}
                @endif
                <div>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"
                    wire:click.prevent="selectItem({{ $index }}, 'attachment')">
                    <i class="fa fa-times"></i>
                    Remove
                </a>
                </div>
            </div>

        </div>

    </div>

@endforeach
<button class="btn btn-sm btn-secondary" wire:click.prevent="addAttachment">+ Add Another
    Attachment</button>
