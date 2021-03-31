@props(['route'])
<button type="button" class="btn btn-warning btn-restore" data-id="{{ $slot }}" 
    data-toggle="modal" data-target="#modalRestore">
    <i class="material-icons">restore</i>
    <form action="{{ $route }}" 
        method="post" class="d-inline" id="form_restore_{{ $slot }}">
        @csrf
    </form>
</button>