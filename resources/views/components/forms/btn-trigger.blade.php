@props(['route', 'modalId'])
<button type="button" class="btn btn-danger btn-delete" data-id="{{ $slot }}" 
    data-toggle="modal" data-target="#{{ $modalId }}">
    <i class="material-icons">close</i>
    <form action="{{ $route }}" 
        method="post" class="d-inline" id="form_{{ $slot }}">
        @csrf
        @method('delete')
    </form>
</button>