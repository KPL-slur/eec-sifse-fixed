<!-- 
    Modal Confirm
    an anonymous laravel component
    just give it id and x-slot for title,body,and footer(usualy btn)
 -->
<div class="modal" tabindex="-1" role="dialog" aria-hidden="true" {{ $attributes }}>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteHeader">{{ $title ?? 'Just to Make Sure' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $body }}
            </div>
            <div class="modal-footer">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>