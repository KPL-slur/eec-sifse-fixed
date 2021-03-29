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
                <p>Are You Sure Want to Delete This Item ? <strong class="text-danger">This Action Is Autosave and Cannot Be Undone</strong></p>
                @break
            @case('cancel')
                <p>Are You Sure Want to Cancel ? <strong class="text-danger">Any Unsaved Data Will Be Lost</strong></p>
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
                    <button id="submitCmForm" type="submit" class="btn btn-success">Yes</button>
                    <x-ui.spinner wire:loading/>
                </div>
                @break
            @case('delete')
                <div>
                    <button id="deleteDynamicForm" type="button" wire:click="deleteDynamicForm" class="btn btn-secondary">Yes</button>
                </div>
                @break
            @case('cancel')
                <div>
                    <a class="btn btn-secondary" type="button" href="{{ route('report.index', ['maintenance_type' => 'cm']) }}">Yes</a>
                </div>
                @break
            @default
                <div>
                    <button type="btn btn-secondary" class="btn btn-primary">Yes</button>
                </div>
        @endswitch
    </x-slot>
</x-ui.modal-confirm>