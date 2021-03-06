<!-- 
    Modal Confirm
    an anonymous laravel component
    just give it id and x-slot for title,body
 -->
 <div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="modalDelete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteHeader">{{ $title ?? 'Just to Make Sure' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-secondary" id="btn-delete-yes">Yes</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(".btn-delete").on('click', function (e) {
            id =  $(this).data("id");
        });
        $("#btn-delete-yes").on('click', function (e) {
            $(`#form_delete_${id}`).submit();
        });
    </script>
@endpush