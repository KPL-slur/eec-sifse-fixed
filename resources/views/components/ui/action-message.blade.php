{{-- 
    An anônima component. Will show notification on js event.
    support slot for custom message.
    Need js event, or
    https://laravel-livewire.com/docs/2.x/events#firing-events

    @params on      a js event name
    @params type    optional, the type of the element. eg. success, warning, danger
    --}}
@props(['on', 'type' => 'success'])
<div></div>
<div x-cloak x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 4000);  })"
    x-show.transition.opacity.duration.1500ms="shown"
    role="alert"
    {{ $attributes->merge(["class" => "toast-top-right alert alert-$type"]) }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
</div>