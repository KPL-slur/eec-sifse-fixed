@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Create New Preventive Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    {{-- List of Form Name Inputs:

                        radio_general_visual
                        radio_rcms
                        radio_wipe_down
                        radio_inspect_all

                        radio_compressor_visual
                        radio_duty_cycle

                        radio_transmitter_visual
                        radio_running_time
                        radio_radiate_time
                        radio_0_4us
                        radio_0_8us
                        radio_1_0us
                        radio_2_0us
                        radio_forward_power
                        radio_reverse_power
                        radio_vswr
                        
                        radio_receiver_visual
                        radio_stalo_check
                        radio_afc_check
                        radio_mrp_check
                        radio_rcu_check
                        radio_iq2_check

                        radio_antenna_visual
                        radio_inspect_motor
                        radio_clean_slip
                        radio_grease_gear

                        general_visual
                        rcms
                        wipe_down
                        inspect_all

                        compressor_visual
                        duty_cycle

                        transmitter_visual
                        running_time
                        radiate_time

                        hvps_v_0_4us
                        hvps_i_0_4us
                        mag_i_0_4us
                        hvps_v_0_8us
                        hvps_i_0_8us
                        mag_i_0_8us
                        hvps_v_1_0us
                        hvps_i_1_0us
                        mag_i_1_0us
                        hvps_v_2_0us
                        hvps_i_2_0us
                        mag_i_2_0us

                        forward_power
                        reverse_power
                        vswr

                        receiver_visual
                        stalo_check
                        afc_check
                        mrp_check
                        rcu_check
                        iq2_check

                        antenna_visual
                        inspect_motor
                        clean_slip
                        grease_gear --}}
                    <form method="post" action="/report/pm" class="form-horizontal">
                        @csrf

                        {{-- HIDDEN --}}
                        <input type="hidden" name="head_id" value="{{ $headId }}">
                        {{-- END OF HIDDEN --}}

                        {{-- GENERAL CHECK --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('General') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'general_visual'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'rcms'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'wipe_down'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'inspect_all'])

                            </div>
                        </div>
                        {{-- END OF GENERAL CHECK --}}

                        {{-- COMPRESSOR --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Compressor') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'compressor_visual'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'duty_cycle'])

                            </div>
                        </div>
                        {{-- END OF COMPRESSOR --}}

                        {{-- TRANSMITTER --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Transmitter') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'transmitter_visual'])
                                @include('tech.report.layout.forms.pm-appended-form', ['namaKolom' => 'running_time', 'satuan' => 'hrs'])
                                @include('tech.report.layout.forms.pm-appended-form', ['namaKolom' => 'radiate_time', 'satuan' => 'hrs'])

                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="">{{ __('Pulse Width') }}</label>
                                </div>
                                @include('tech.report.layout.forms.pm-pulse-form', ['namaKolom' => '0_4us'])
                                @include('tech.report.layout.forms.pm-pulse-form', ['namaKolom' => '0_8us'])
                                @include('tech.report.layout.forms.pm-pulse-form', ['namaKolom' => '1_0us'])
                                @include('tech.report.layout.forms.pm-pulse-form', ['namaKolom' => '2_0us'])

                                @include('tech.report.layout.forms.pm-appended-form', ['namaKolom' => 'forward_power', 'satuan' => 'dBm'])
                                @include('tech.report.layout.forms.pm-appended-form', ['namaKolom' => 'reverse_power', 'satuan' => 'dBm'])
                                @include('tech.report.layout.forms.pm-appended-form', ['namaKolom' => 'vswr', 'satuan' => ':1'])

                            </div>
                        </div>
                        {{-- END OF TRANSMITTER --}}

                        {{-- RECEIVER --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Receiver') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'receiver_visual'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'stalo_check'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'afc_check'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'mrp_check'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'rcu_check'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'iq2_check'])

                            </div>
                        </div>
                        {{-- END OF RECEIVER --}}

                        {{-- ANTENNA/PEDESTAL --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Antenna/Pedestal') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'antenna_visual'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'inspect_motor'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'clean_slip'])
                                @include('tech.report.layout.forms.pm-form', ['namaKolom' => 'grease_gear'])

                            </div>
                        </div>
                        {{-- END OF ANTENNA/PEDESTAL --}}

                        {{-- CKEDITOR REMARK --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('REMARK') }}</h4>
                            </div>

                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea class="editor" name="remark" id="editor" cols="50" rows="10"
                                                class="form-control"
                                                placeholder="@error('remark') {{ $message }} @enderror">
                                                {{ old('remark') }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END OF CKEDITOR REMARK --}}

                        {{-- BUTTON GROUP --}}
                        <div class="d-flex justify-content-end">
                            <a type="button" class="btn btn-info" href="{{ url('tech') }}">BACK</a>
                            <button type="submit" value='submit' class="btn btn-primary mx-5">SUBMIT</button>
                        </div>
                        {{-- END OF BUTTON GROUP --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    window.onload = function() {
        /*
         *   FUNGSI MEMANGGIL CKEDITOR
         */
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    };

</script>
