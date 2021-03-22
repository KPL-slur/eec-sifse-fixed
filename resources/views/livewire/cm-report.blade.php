<form method="post" wire:submit.prevent="upstore" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @if (isset($id))
        @method('put')
    @endif
    
    <div class="row setup-content {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">
        @include('expert.report.layout.forms.head.create')
    </div>
 
    <div class="row setup-content {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">
        @include('expert.report.layout.forms.ck-editor')
    </div>
    
    <div class="row setup-content {{ $currentStep != 3 ? 'd-none' : '' }}" id="step-3">
        @include('expert.report.layout.forms.recommends-form')
    </div>

    <div class="row setup-content {{ $currentStep != 4 ? 'd-none' : '' }}" id="step-4">
        @include('expert.report.layout.forms.report-images')
    </div>

    <button class="btn btn-primary nextBtn btn-lg pull-right {{ $currentStep === 4 ? 'd-none' : '' }}" type="button" wire:click="nextStep">Next</button>
    <button class="btn btn-success nextBtn btn-lg pull-right {{ $currentStep !== 4 ? 'd-none' : '' }}" type="button" wire:click="nextStep">Submit</button>
    <button class="btn btn-danger nextBtn btn-lg pull-right {{ $currentStep === 1 ? 'd-none' : '' }}" type="button" wire:click="back">Back</button>
    <button class="btn btn-secondary nextBtn btn-lg pull-right" type="button" wire:click="cancel">Cancel</button>

    @include('livewire.include.modal', ['modalType' => $modalType])

</form>

@push('scripts')
    <script src="{{ asset('user') }}/js/report.js" type="text/javascript"></script>
    <script>
        window.addEventListener('openModalConfirm', event => {
            $('#modalConfirm').modal('show');
        });

        window.addEventListener('closeModalConfirm', event => {
            $('#modalConfirm').modal('hide');
        });
    </script>
@endpush