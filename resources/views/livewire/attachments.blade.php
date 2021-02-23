@foreach ($attachments as $index => $attachment)
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title" >{{ __('Attachments') }}</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <label class="col-sm-2 col-form-table" for="inputCaption">Caption</label>
                <div class="col-sm-8">
                    <div class="form-group">
                        <input class="form-control" type="text" name="attachments[{{ $index }}][caption]"
                        placeholder="Caption..." value="" wire:model.defer="attachments.{{ $index }}.caption">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div>
                        <span class="btn btn-raised btn-round btn-default btn-file">
                            <input type="file" name="attachments[{{ $index }}][image]" class="fileinput-new"
                                wire:model="attachments.{{ $index }}.image"
                            >
                        </span>
                        <div>
                            <a class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"
                            wire:click.prevent="addAttachment">
                                <i class="fa fa-times"></i>
                                Add
                            </a>

                        </div>
                    </div>

                </div>
8
            </div>

        </div>

    </div>
@endforeach
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-sm btn-secondary" wire:click.prevent="addAttachment">+Add</button>
        <button class="btn btn-sm btn-secondary" wire:click.prevent="fileUpload" >File Upload</button>
    </div>
</div>