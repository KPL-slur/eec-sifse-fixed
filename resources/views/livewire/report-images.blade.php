<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Attachments') }}</h4>
    </div>

    {{-- <form action="" id="form-upload" enctype="multipart/form-data" class="form-control"
            wire:submit.prevent="fileUpload"> --}}
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
                        <input class="form-control "
                            type="text" name="caption" id="inputCaption"
                            placeholder="Caption..." value="" 
                            wire:model.defer="caption" />
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
                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                    <div>
                        <span class="btn btn-raised btn-round btn-default btn-file">
                            <span class="fileinput-new">Select image</span>
                            <input type="file" name="image" wire:model='image'  />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
            </div>

            <button class="btn btn-success" type="button" wire:click="fileUpload">Upload</button>

        </div>
    {{-- </form> --}}
</div>