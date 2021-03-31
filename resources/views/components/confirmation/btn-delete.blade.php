@props(['route'])
<button type="button" class="btn btn-danger btn-delete" data-id="{{ $slot }}" 
    data-toggle="modal" data-target="#modalDelete">
    <i class="material-icons">delete</i>
    <form action="{{ $route }}" 
        method="post" class="d-inline" id="form_delete{{ $slot }}">
        @csrf
        @method('delete')
    </form>
</button>