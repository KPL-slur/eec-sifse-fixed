<div>
    @if (empty($reports))
        <h5 class="text-danger">
            There are no scanned report yet.
            @can('update', $headReport)
                Click +Add Scanned Report To Upload Your Report.
            @endcan
        </h5>
    @else
        @can('update', $headReport)
            @foreach ($reports as $index => $report)
                <div class="row">
                    <div class="col table-responsive">
                        <table class="table">
                            <tbody x-data="{ changeFile: false, customFileName: '', disableInput: false, disableCheck: true }" x-cloak>
                                <tr>
                                    <td>File Name</td>
                                    <td>
                                        @error('reports.' . $index . '.fileName')
                                            <p class="text-danger">{{ $message }}</p>
                                        @else
                                            @if (!empty($reports[$index]['file']))
                                                {{ $reports[$index]['file']->getClientOriginalName() }}
                                            @elseif (isset(explode("/", $reports[$index]['fileName'])[1]))
                                                <p x-show="!changeFile">{{ explode("/", $reports[$index]['fileName'])[1] }}</p>
                                                <div x-show="changeFile">
                                                    @include('livewire.include.fileNameCheck')
                                                </div>
                                            @else 
                                                @include('livewire.include.fileNameCheck')
                                            @endif
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>Action</td>
                                    <td>
                                        <div class="spinner" wire:loading wire:target="reports.{{ $index }}.file">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                        @if ($report['uploaded'] === 1)
                                            <a type="button" x-show="!changeFile"
                                                href="{{ route('report.pdf.download', [
                                                                                            'id' => $headReport->head_id,
                                                                                            'maintenance_type' => $maintenance_type,
                                                                                            'path' => explode('/', $reports[$index]['fileName'])[1],
                                                                                        ]) }}"
                                                class="btn btn-success">Download</a>
                                            <a type="button" x-show="!changeFile"
                                                href="{{ route('report.pdf.show', [
                                                                                        'id' => $headReport->head_id,
                                                                                        'maintenance_type' => $maintenance_type,
                                                                                        'path' => explode('/', $reports[$index]['fileName'])[1],
                                                                                    ]) }}"
                                                target="_blank" class="btn btn-info">View</a>
                                            @can('update', $headReport)
                                                @if ($report['file'] == '')
                                                    <span x-show="changeFile"
                                                        class="btn btn-default btn-round btn-file">
                                                        <input type="file" name="reports[{{ $index }}][file]"
                                                            class="fileinput-new"
                                                            wire:model='reports.{{ $index }}.file' />
                                                    </span>
                                                @else
                                                    <button class="btn btn-primary" type="button"
                                                        x-show="changeFile" x-on:click="changeFile = false"
                                                        wire:click="update({{ $index }})">
                                                        UPLOAD
                                                    </button>
                                                @endif
                                                <button class="btn btn-danger" 
                                                    x-on:click="changeFile = false" x-show="changeFile"
                                                    wire:click="clearInput({{ $index }})">
                                                    Cancel</button>
                                                <button x-show="!changeFile" type="button" rel="tooltip" class="btn btn-warning"
                                                    x-on:click="changeFile = true">Change File</button>
                                                <button x-show="!changeFile" class="btn btn-danger" type="button"
                                                    wire:click="openModalDelete({{ $index }})">
                                                    Remove File
                                                </button>
                                            @endcan
                                        @else
                                            @can('update', $headReport)
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="">
                                                        @if ($report['file'] == '')
                                                            <span wire:loading.remove
                                                                wire:target="reports.{{ $index }}.file"
                                                                class="btn btn-default btn-round btn-file">
                                                                <input type="file" name="reports[{{ $index }}][file]"
                                                                    class="fileinput-new"
                                                                    wire:model='reports.{{ $index }}.file' />
                                                            </span>
                                                        @else
                                                            <button class="btn btn-primary"
                                                                wire:click="store({{ $index }})">
                                                                UPLOAD
                                                            </button>
                                                        @endif
                                                        <button class="btn btn-danger" type="button"
                                                            wire:click="removeReport({{ $index }})">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-danger">no files have been uploaded yet</p>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            @endforeach

            <x-ui.modal-confirm id="modalConfirmDelete">
                <x-slot name="body">
                    <p>Are You Sure Want To Remove This File ?
                        <strong class="text-danger">Keep In Mind This Action Cannot Be Undone</strong>
                    </p>
                </x-slot>
                <x-slot name="footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal"
                        wire:click.prevent="confirmDelete">Yes</button>
                </x-slot>
            </x-ui.modal-confirm>
        @endcan
    @endif
    <x-ui.action-message on="fileError" type="danger">
        File Not Found
    </x-ui.action-message>
    <x-ui.action-message on="prevLimit" type="danger">
        Please Fill The Empty Form First Before Adding A New One
    </x-ui.action-message>
    <x-ui.action-message on="removeReport" type="danger">
        Report Record Deleted
    </x-ui.action-message>
    <x-ui.action-message on="uploadReport" type="success">
        Report Record Uploaded
    </x-ui.action-message>
    @can('update', $headReport)
        <button class="btn btn-sm btn-secondary" wire:click="addReport">+ Add Scanned Report</button>
    @endcan
</div>

@push('scripts')
    <script>
        window.addEventListener('openModalConfirm', event => {
            $('#modalConfirmDelete').modal('show');
        });
        window.addEventListener('closeModalConfirm', event => {
            $('#modalConfirmDelete').modal('hide');
        });
    </script>
    <script type="text/javascript">
        /**
         * http://www.webcodingtech.com/javascript/limit-input-text.php
         * nilai max_len harus sama dengan nilai MAX pada validasi server 
         * pada file app/http/livewire/PrintedReport@validateFileNameChecks()
         */
        function limitInput (el) {
            var max_len = 30;
            if (el.value.length > max_len) {
                el.value = el.value.substr(0, max_len);
            }
            return true;
        }
    </script>
@endpush
