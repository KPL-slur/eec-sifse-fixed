<form method="post" wire:submit.prevent="upstore" class="form-horizontal" enctype="multipart/form-data"
        x-data="{step: 1}" x-cloak>
    @csrf
    @if (isset($id))
        @method('put')
    @endif

    <div class="row setup-content" id="step-1"
            x-show="step === 1">
        @include('expert.report.layout.forms.head.create')
    </div>

    <div class="row setup-content" id="step-2"
            x-show="step === 2">
        @include('expert.report.layout.forms.ck-editor')
    </div>

    <div class="row setup-content" id="step-3"
            x-show="step === 3">
        @include('expert.report.layout.forms.recommends-form')
    </div>

    <div class="row setup-content" id="step-4"
            x-show="step === 4">
        @include('expert.report.layout.forms.report-images')
    </div>

    <x-ui.spinner wire:loading className="pull-right"/>
    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"
            wire:loading.remove
            x-show="step < 4"
            x-on:click="$wire.validateStep(step)
                        .then(result => { if(result)step++ })">
            Next
    </button>
    <button class="btn btn-success nextBtn btn-lg pull-right" type="button"
            wire:loading.remove
            x-show="step === 4" 
            x-on:click="$wire.validateStep(step)
                        .then(result => { if(result)step++ })">
            Submit
    </button>
    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" 
            x-show="step > 1" x-on:click="step--">
            Back
    </button>
    <button class="btn btn-secondary nextBtn btn-lg pull-right" type="button" 
            wire:click="cancel">
            Cancel
    </button>

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