{{-- 
    FLOATING MENU
    an anonymous laravel component
    just give itu list item of link or btn before the closing tag
    this component already add back btn
     --}}
<div class="">
    <button href="#" class="btn btn-primary btn-fab btn-lg btn-float" id="menu-share">
        <i class="material-icons">menu</i>
    </button>
    <ul class="btn-float-list">
        {{ $slot }}
        <li>
            <a href="{{ url()->previous() }}" class="btn btn-info btn-fab btn-round">
                <i class="material-icons">arrow_back</i>
            </a>
        </li>
    </ul>
</div>