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
        @include('expert.report.layout.forms.pm.create')
    </div>

    <div class="row setup-content" id="step-3"
            x-show="step === 3">
        @include('expert.report.layout.forms.ck-editor')
    </div>

    <div class="row setup-content" id="step-4"
            x-show="step === 4">
        @include('expert.report.layout.forms.recommends-form')
    </div>

    <div class="row setup-content" id="step-5"
            x-show="step === 5">
        @include('expert.report.layout.forms.report-images')
    </div>
    
    <x-ui.spinner wire:loading className="pull-right"/>
    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"
            wire:loading.remove
            x-show="step < 5"
            x-on:click="$wire.validateStep(step)
                        .then(result => { if(result)step++ })">
            Next
    </button>
    <button class="btn btn-success nextBtn btn-lg pull-right" type="button"
            wire:loading.remove
            x-show="step === 5" 
            x-on:click="$wire.validateStep(step)
                        .then(result => { if(result)step++ })">
            Submit
    </button>
    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" 
            x-show="step > 1" x-on:click="step--">
            Back
    </button>
    <button class="btn btn-secondary nextBtn btn-lg pull-right" type="button" 
            x-data X-on:click="$dispatch('modal-cancel')">
            Cancel
    </button>

    @include('livewire.include.modal', ['modalType' => $modalType])

</form>

<x-ui.modal-confirm id="modalCancel">
    <x-slot name="body">
        <div>
            <p>Are You Sure Want to Cancel? Any Unsaved Data Will Be Lost</p>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <a class="btn btn-secondary" type="button" href="{{ route('report.index', ['maintenance_type' => 'pm']) }}">Yes</a>
        </div>
    </x-slot>
</x-ui.modal-confirm>

@push('scripts')
    <script src="{{ asset('user') }}/js/report.js" type="text/javascript"></script>
    <script>
        window.addEventListener('modal-cancel', event => {
            $('#modalCancel').modal('show');
        });

        window.addEventListener('openModalConfirm', event => {
            $('#modalConfirm').modal('show');
        });

        window.addEventListener('closeModalConfirm', event => {
            $('#modalConfirm').modal('hide');
        });
    </script>
@endpush