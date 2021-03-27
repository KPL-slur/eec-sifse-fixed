{{-- 
    An anônima component. Will show notification on js event.
    support slot for custom message.
    Need js event, or
    https://laravel-livewire.com/docs/2.x/events#firing-events

    @params on      a js event name
    @params type    optional, the type of the element. eg. success, warning, danger
    --}}
@props(['on', 'type' => 'success'])

<div x-data x-init="@this.on('{{ $on }}', () => {
                                            showNotification(
                                                                'top', 
                                                                'right', 
                                                                '<?php echo $type ?>' ,
                                                                '<?php echo $slot->isEmpty() ? 'Saved.' : $slot ?>'
                                                            );
                                        }
                    )"
></div>