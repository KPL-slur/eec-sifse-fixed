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
    <button class="btn btn-success nextBtn btn-lg pull-right {{ $currentStep !== 5 ? 'd-none' : '' }}" type="button" wire:click="nextStep">Submit</button>
    <button class="btn btn-danger nextBtn btn-lg pull-right {{ $currentStep === 1 ? 'd-none' : '' }}" type="button" wire:click="back">Back</button>
    <a class="btn btn-secondary nextBtn btn-lg pull-right" type="button" href="{{ route('pm.index') }}">Cancel</a>

    <!-- Modal -->
    <x-ui.modal-confirm id="modalConfirm">
        <x-slot name="body">
            @switch($modalType)
                @case('submit')
                    <p>Are You Sure Want to Submit This Form ?</p>
                    @break
                @case('delete')
                    <p>Are You Sure Want to Delete This Item ?</p>
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
                        <button id="submitPmForm" type="submit" wire:click="uploadAll" class="btn btn-success">Yes</button>
                    </div>
                    @break
                @case('delete')
                    <div>
                        <button id="deleteDynamicForm" type="button" wire:click="deleteDynamicForm" class="btn btn-secondary">Yes</button>
                    </div>
                    @break
                @default
                    </div>
                        <button type="button" class="btn btn-primary">Yes</button>
                    </div>
            @endswitch
        </x-slot>
    </x-ui.modal-confirm>
    {{-- <div class="modal" id="modalConfirm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeadConfirm">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @switch($modalType)
                        @case('submit')
                            <p>Are You Sure Want to Submit This Form ?</p>
                            @break
                        @case('delete')
                            <p>Are You Sure Want to Delete This Item ?</p>
                            @break
                        @default
                            <p>Are You Sure ?</p> 
                    @endswitch
                </div>
                <div class="modal-footer">
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
                        @default
                            </div>
                                <button type="button" class="btn btn-primary">Yes</button>
                            </div>
                    @endswitch
                </div>
            </div>
        </div>
    </div> --}}

</form>
<script src="{{ asset('user') }}/js/report.js" type="text/javascript"></script>