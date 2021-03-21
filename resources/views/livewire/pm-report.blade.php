<form method="post" wire:submit.prevent="upstore" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @if (isset($id))
        @method('put')
    @endif

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
    <button class="btn btn-success nextBtn btn-lg pull-right {{ $currentStep !== 5 ? 'd-none' : '' }}" type="button" wire:click="nextStep">Submit</button>
    <button class="btn btn-danger nextBtn btn-lg pull-right {{ $currentStep === 1 ? 'd-none' : '' }}" type="button" wire:click="back">Back</button>
    <button class="btn btn-secondary nextBtn btn-lg pull-right" type="button" wire:click="cancel">Cancel</button>

    <!-- 
        Modal
        params: $modalType
     -->
    <x-ui.modal-confirm id="modalConfirm">
        <x-slot name="body">
            @switch($modalType)
                @case('submit')
                    <p>Are You Sure Want to Submit This Form ?</p>
                    @break
                @case('delete')
                    <p>Are You Sure Want to Delete This Item ?</p>
                    @break
                @case('cancel')
                    <p>Are You Sure Want to Cancel? Any Unsaved Data Will Be Lost</p>
                @break
                @default
                    <p>Are You Sure ?</p> 
            @endswitch
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            @switch($modalType)
                @case('submit')
                    <div>
                        <button id="submitPmForm" type="submit" class="btn btn-success">Yes</button>
                    </div>
                    @break
                @case('delete')
                    <div>
                        <button id="deleteDynamicForm" type="button" wire:click="deleteDynamicForm" class="btn btn-secondary">Yes</button>
                    </div>
                    @break
                @case('cancel')
                    <div>
                        <a class="btn btn-secondary" type="button" href="{{ route('report.index', ['maintenance_type' => 'pm']) }}">Yes</a>
                    </div>
                @break
                @default
                    </div>
                        <button type="btn btn-secondary" class="btn btn-primary">Yes</button>
                    </div>
            @endswitch
        </x-slot>
    </x-ui.modal-confirm>

</form>
<script src="{{ asset('user') }}/js/report.js" type="text/javascript"></script>