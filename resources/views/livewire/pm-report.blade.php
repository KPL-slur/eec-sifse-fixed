<form method="post" action="{{ url('/expert/pm/') }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    {{-- @if ($id)
        @method('put')
    @endif --}}
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
    <button class="btn btn-success nextBtn btn-lg pull-right {{ $currentStep !== 5 ? 'd-none' : '' }}" type="submit">Submit</button>
    <button class="btn btn-danger nextBtn btn-lg pull-right {{ $currentStep === 1 ? 'd-none' : '' }}" type="button" wire:click="back">Back</button>
</form>
<script src="{{ asset('user') }}/js/report.js" type="text/javascript"></script>