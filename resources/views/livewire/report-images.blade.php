@foreach ($attachments as $index => $attachment)

    <div class="card ">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Attachments') }}</h4>
        </div>

        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @error('caption')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="row">
                <label class="col-sm-2 col-form-label" for="inputCaption">Caption</label>
                <div class="col-sm-8">
                    <div class="form-group">
                        <input class="form-control" type="text" name="attachments[{{ $index }}][caption]"
                            placeholder="Caption..." value=""
                            wire:model.defer="attachments.{{ $index }}.caption" />
                    </div>
                </div>
            </div>
            @error('image')
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
                    <div>
                        <span class="btn btn-raised btn-round btn-default btn-file">
                            <input type="file" name="attachments[{{ $index }}][image]" class="fileinput-new"
                                wire:model='attachments.{{ $index }}.image' />
                        </span>
                        <a class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"
                            wire:click.prevent="addAttachment">
                            <i class="fa fa-times"></i>
                            {{-- Remove --}}
                            Add
                        </a>
                    </div>
                </div>
                {{-- <div wire:loading wire:target="photo">Uploading...</div> --}}
                @if ($attachments[$index]['image'])
                    <img class="fileinput-preview fileinput-exists thumbnail img-raised image-upload-preview"
                        src="{{ $attachments[$index]['image']->temporaryUrl() }}"/>
                @endif
            </div>
            
        </div>
        `   
    </div>

@endforeach
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-sm btn-secondary" wire:click.prevent="$toggle('addAttachment')">+ Addaaa
            Attachment</button>
            <button class="btn btn-sm btn-secondary" wire:click.prevent="fileUpload">+ Add
            Attachment</button>

    </div>

</div>