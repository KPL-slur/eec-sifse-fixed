{{-- GENERAL CHECK --}}
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('General') }}</h4>
    </div>
    <div class="card-body " id="">
        <x-forms.pm-check namaKolom="general_visual">Visual Inspection</x-forms.pm-check>
        <x-forms.pm-check namaKolom="rcms">RCMS Control And Monitoring Test</x-forms.pm-check>
        <x-forms.pm-check namaKolom="wipe_down">Wipe down external surface</x-forms.pm-check>
        <x-forms.pm-check namaKolom="inspect_all">Inspect inside all cabinets for vermin ingres</x-forms.pm-check>
    </div>
</div>
{{-- END OF GENERAL CHECK --}}

{{-- COMPRESSOR --}}
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Compressor') }}</h4>
    </div>
    <div class="card-body " id="">
        <x-forms.pm-check namaKolom="compressor_visual">Visual Inspection</x-forms.pm-check>
        <x-forms.pm-check namaKolom="duty_cycle">Duty Cycle</x-forms.pm-check>
    </div>
</div>
{{-- END OF COMPRESSOR --}}

{{-- TRANSMITTER --}}
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Transmitter') }}</h4>
    </div>
    <div class="card-body " id="">
        <x-forms.pm-check namaKolom="transmitter_visual">Visual Inspection</x-forms.pm-check>
        <x-forms.pm-check namaKolom="running_time" satuan="hrs">Running Time</x-forms.pm-check>
        <x-forms.pm-check namaKolom="radiate_time" satuan="hrs">Radiate Time</x-forms.pm-check>

        <div class="row">
            <label class="col-sm-2 col-form-label" for="">{{ __('Pulse Width') }}</label>
        </div>
        <x-forms.pm-check namaKolom="0_4us" type="pulse">0.4 us</x-forms.pm-check>
        <x-forms.pm-check namaKolom="0_8us" type="pulse">0.8 us</x-forms.pm-check>
        <x-forms.pm-check namaKolom="1_0us" type="pulse">1.0 us</x-forms.pm-check>
        <x-forms.pm-check namaKolom="2_0us" type="pulse">2.0 us</x-forms.pm-check>

        <x-forms.pm-check namaKolom="forward_power" satuan="dBm">Forward Power</x-forms.pm-check>
        <x-forms.pm-check namaKolom="reverse_power" satuan="dBm">Reverse Power</x-forms.pm-check>
        <x-forms.pm-check namaKolom="vswr" satuan=":1">VSWR</x-forms.pm-check>
    </div>
</div>
{{-- END OF TRANSMITTER --}}

{{-- RECEIVER --}}
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Receiver') }}</h4>
    </div>
    <div class="card-body " id="">
        <x-forms.pm-check namaKolom="receiver_visual">Visual Inspection</x-forms.pm-check>
        <x-forms.pm-check namaKolom="stalo_check">Stalo Check</x-forms.pm-check>
        <x-forms.pm-check namaKolom="afc_check">AFC Check</x-forms.pm-check>
        <x-forms.pm-check namaKolom="mrp_check">MRP Check</x-forms.pm-check>
        <x-forms.pm-check namaKolom="rcu_check">RCU Check</x-forms.pm-check>
        <x-forms.pm-check namaKolom="iq2_check">IQ2 Check</x-forms.pm-check>
    </div>
</div>
{{-- END OF RECEIVER --}}

{{-- ANTENNA/PEDESTAL --}}
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Antenna/Pedestal') }}</h4>
    </div>
    <div class="card-body " id="">
        <x-forms.pm-check namaKolom="antenna_visual">Visual Inspection</x-forms.pm-check>
        <x-forms.pm-check namaKolom="inspect_motor">Inspect Motor Drive</x-forms.pm-check>
        <x-forms.pm-check namaKolom="clean_slip">Clean Slip-rings</x-forms.pm-check>
        <x-forms.pm-check namaKolom="grease_gear">Grease Gears and Bearing</x-forms.pm-check>
    </div>
</div>
{{-- END OF ANTENNA/PEDESTAL --}}