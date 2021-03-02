<form method="post" action="{{ ($edit) ? route('pm.update', ['id' => $headId]) : route('pm.store') }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @if ($edit)
        @method('put')
    @endif
    <input type="hidden" name="head_id" value="{{ $headId }}">
    
    <div class="row setup-content {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">
        @include('expert.report.layout.forms.head.create')
    </div>

    <div class="row setup-content {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">
        @include('expert.report.layout.forms.pm.create')
    </div>

    <div class="row setup-content {{ $currentStep != 3 ? 'd-none' : '' }}" id="step-3">
        @include('expert.report.layout.forms.ck-editor')
    </div>

    <div class="row setup-content {{ $currentStep != 4 ? 'd-none' : '' }}" id="step-4">
        @include('expert.report.layout.forms.recommends-form')
    </div>

    <div class="row setup-content {{ $currentStep != 5 ? 'd-none' : '' }}" id="step-3">
        @include('expert.report.layout.forms.report-images')
    </div>
    
    <button class="btn btn-primary nextBtn btn-lg pull-right {{ $currentStep === 5 ? 'd-none' : '' }}" type="button" wire:click="nextStep">Next</button>
    <button class="btn btn-success nextBtn btn-lg pull-right {{ $currentStep !== 5 ? 'd-none' : '' }}" type="submit" wire:click="uploadAll">Submit</button>
    <button class="btn btn-danger nextBtn btn-lg pull-right {{ $currentStep === 1 ? 'd-none' : '' }}" type="button" wire:click="back">Back</button>
    <a class="btn btn-danger nextBtn btn-lg pull-right {{ $currentStep !== 1 ? 'd-none' : '' }}" type="button" href="{{ route('pm.index') }}">Cancel</a>

    <!-- Modal -->
    <div class="modal" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeadDelete">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are You Sure Want to Delete This Item ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" wire:click="deleteDynamicForm" class="btn btn-secondary">Yes</button>
                </div>
            </div>
        </div>
    </div>

</form>
<script src="{{ asset('user') }}/js/report.js" type="text/javascript"></script>