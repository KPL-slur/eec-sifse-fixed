@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Edit '.strtoupper($maintenance_type).' Report')])

@section('content')
    <div class="content">
        <div class="container">
            {{-- <h1>Edit {{ $maintenance_type == 'pm' ? 'Prevetive' : 'Corrective' }} Maintenance Report</h1> --}}
            <div class="row">
                <div class="col-md-12">
                    @switch($maintenance_type)
                        @case('pm')

                            @livewire('pm-report', ['id' => $id])

                            @break
                        @case('cm')

                            @livewire('cm-report', ['id' => $id])

                            @break
                        @default
                            
                    @endswitch
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection