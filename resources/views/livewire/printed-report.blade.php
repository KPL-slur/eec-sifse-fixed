<div>
    @if (empty($reports))
        <h5 class="text-danger">There are no attachment(s) yet. You can add a new one or click submit to skip</h5>
    @else
        @foreach ($reports as $index => $report)
            <div class="row">
                <div class="col table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>File Name</td>
                                <td>
                                    @error('reports.'.$index.'.fileName')
                                        <p class="text-danger">{{ $message }}</p>
                                    @else
                                        {{ explode("/", $reports[$index]['fileName'])[1] }}
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    @if ($report['uploaded'] === 1)
                                        <a type="button"
                                            href="{{ route('report.pdf.download', ['id' => $headReport->head_id, 'maintenance_type' => $maintenance_type, 'path' => explode("/", $reports[$index]['fileName'])[1] ]) }}"
                                            class="btn btn-success">Download</a>
                                        <a type="button"
                                            href="{{ route('report.pdf.show', ['id' => $headReport->head_id, 'maintenance_type' => $maintenance_type, 'path' => explode("/", $reports[$index]['fileName'])[1] ]) }}"
                                            target="_blank" class="btn btn-info">View</a>
                                        @can('update', $headReport)
                                            <button type="button" rel="tooltip" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modalUpload">Change File</button>
                                            <button class="btn btn-danger" type="button"
                                                wire:click="openModalDelete({{ $index }})">
                                                Remove File
                                            </button>
                                        @endcan
                                    @else
                                        @can('update', $headReport)
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="">
                                                    <span wire:loading.remove
                                                        wire:target="reports.{{ $index }}.fileName"
                                                        class="btn btn-default btn-round btn-file">
                                                        <input type="file" name="reports[{{ $index }}][fileName]"
                                                            class="fileinput-new"
                                                            wire:model='reports.{{ $index }}.fileName' />
                                                    </span>
                                                    @if ($report['fileName'] != '')
                                                        <button class="btn btn-primary" wire:click="store({{ $index }})">
                                                            UPLOAD
                                                        </button>
                                                    @endif
                                                    <button class="btn btn-danger" type="button"
                                                        wire:click="removeReport({{ $index }})">
                                                        Remove File
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
                <button type="submit" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="confirmDelete">Yes</button>
            </x-slot>
        </x-ui.modal-confirm>
    @endif
    <x-ui.action-message on="removeReport" type="danger">
        Report Record Deleted
    </x-ui.action-message>
    <x-ui.action-message on="uploadReport" type="success">
        Report Record Uploaded
    </x-ui.action-message>
    <button class="btn btn-sm btn-secondary" wire:click="addReport">+ Add Another
        Report</button>
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
@endpush