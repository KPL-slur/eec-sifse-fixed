@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Create New Preventive Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="/report/pm" class="form-horizontal">
                        @csrf

                        {{-- SUMMARY --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                            </div>
                            {{-- DYNAMIC FIELDS --}}
                            <div class="card-body " id="dynamicField">
                                @include('tech.forms.summaryForm', ['namaKolom'=>'radar_name', 'tipeForm'=>'text'])
                                @include('tech.forms.summaryForm', ['namaKolom'=>'station_id', 'tipeForm'=>'text'])
                                @include('tech.forms.summaryForm', ['namaKolom'=>'report_date_start', 'tipeForm'=>'date'])
                                @include('tech.forms.summaryForm', ['namaKolom'=>'report_date_end', 'tipeForm'=>'date'])
                                {{-- FIELDS THAT CAN BE ADDED BY USER USING JS BELOW --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputExpertise">{{ __('Expertise') }}</label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="expertise1"
                                                id="inputExpertise" placeholder="{{ __('Expertise') }}" value=""
                                                  />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="expertise_company1"
                                                id="inputExpertiseCompany" placeholder="{{ __('Expertise Company') }}"
                                                value=""   />
                                        </div>
                                    </div>
                                    <button type="button" id="add" class="btn btn-primary">ADD</button>
                                    <button type="button" id="remove" class="btn btn-danger">DELETE LAST</button>
                                </div>
                                {{--  --}}
                            </div>
                        </div>
                        {{-- END OF SUMMARY --}}

                        {{-- GENERAL CHECK --}}
                        {{-- <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('General') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.pmForm', ['namaKolom' => 'general_visual'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'rcms'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'wipe_down'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'inspect_all'])
                                
                            </div>
                        </div> --}}
                        {{-- END OF GENERAL CHECK --}}

                        {{-- COMPRESSOR --}}
                        {{-- <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Compressor') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.pmForm', ['namaKolom' => 'compressor_visual'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'running_time'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'radiate_time'])

                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="">{{ __('Pulse Width') }}</label>
                                </div>
                                @include('tech.forms.pmPulseForm', ['namaKolom' => '0_4us'])
                                @include('tech.forms.pmPulseForm', ['namaKolom' => '0_8us'])
                                @include('tech.forms.pmPulseForm', ['namaKolom' => '1_0us'])
                                @include('tech.forms.pmPulseForm', ['namaKolom' => '2_0us'])

                                @include('tech.forms.pmForm', ['namaKolom' => 'forward_power'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'reverse_power'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'vswr'])
                                
                            </div>
                        </div> --}}
                        {{-- END OF COMPRESSOR --}}

                        {{-- RECEIVER --}}
                        {{-- <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Receiver') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.pmForm', ['namaKolom' => 'receiver_visual'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'stalo_check'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'afc_check'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'mrp_check'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'rcu_check'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'iq2_heck'])
                                
                            </div>
                        </div> --}}
                        {{-- END OF RECEIVER --}}

                        {{-- ANTENNA/PEDESTAL --}}
                        {{-- <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Antenna/Pedestal') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.pmForm', ['namaKolom' => 'antenna_visual'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'inspect_motor'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'clean_slip'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'grease_gear'])
                                
                            </div>
                        </div> --}}
                        {{-- END OF ANTENNA/PEDESTAL --}}

                        {{-- SPAREPART RECOMENDATION --}}
                        {{-- <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Sparepart Recomendation') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.rekomendasi')
                            </div>
                        </div> --}}
                        {{-- END OF SPAREPART RECOMENDATION --}}

                        {{-- CKEDITOR REMARK --}}
                        {{-- <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('REMARK') }}</h4>
                            </div>

                            <div class="card-body " id="dynamicField">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group" id="editor">
                                            <textarea class="editor" name="remark" id="inputRemark" cols="50" rows="10"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- END OF CKEDITOR REMARK --}}

                        {{-- BUTTON GROUP --}}
                        <div class="d-flex justify-content-end">
                            <a type="button" class="btn btn-info" href="{{ url('tech') }}">BACK</a>
                            <button type="submit" class="btn btn-primary mx-5">SUBMIT</button>
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
         *   FUNGSI MENAMBAHKAN INPUT FIELD BARU
         */
        var $i = 1;
        $('#add').click(function() {
            if ($i < 10) {
                $i++;
                $('#dynamicField').append(
                    '<div class="row" id="dynamicField' + $i +
                    '"><label class="col-sm-2 col-form-label" for="inputExpertise' + $i +
                    '">Expertise ' + $i +
                    '</label><div class="col-sm-4"><div class="form-group"><input class="form-control" input type="text" name="expertise' +
                    $i + '" id="inputExpertise' + $i +
                    '" placeholder="{{ __('Expertise') }}" value=""   /></div></div><div class="col-sm-3"><div class="form-group"><input class="form-control" input type="text" name="expertise_company' +
                    $i + '" id="inputExpertiseCompany' + $i +
                    '" placeholder="{{ __('Expertise Company') }}" value=""   /></div></div></div>'
                );
            }
        });
        /*
         *   FUNGSI MENGAHPUS INPUT FIELD  YANG BARU DITAMBAHKAN
         */
        $('#remove').click(function() {
            if (!($i <= 1)) {
                $('#dynamicField' + $i + '').detach();
                $i--;
            }
        });

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
{{-- IMPORT CKEDITOR, NANTI DIPINDAHIN KARENA DIPANGGIL JUGA DI CM --}}
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
