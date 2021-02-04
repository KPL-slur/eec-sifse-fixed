@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Create New Preventive Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="/report/pm" class="form-horizontal">
                        @csrf

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                            </div>
                            {{-- DYNAMIC FIELDS, FIELDS THAT CAN BE ADDED BY USER USING JS BELOW --}}
                            <div class="card-body " id="dynamicField">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputRadarName">{{ __('Radar Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="radarName"
                                                id="inputRadarName" placeholder="{{ __('Radar Name') }}" value=""
                                                 />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="inputReportDate">{{ __('Date') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="date" name="reportDate"
                                                id="inputReportDate" placeholder="{{ __('Date') }}" value=""   />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputStationId">{{ __('Station ID') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="stationId"
                                                id="inputStationId" placeholder="{{ __('Station ID') }}" value=""
                                                  />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                {{-- <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputExpertise">{{ __('Expertise') }}</label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="expertise"
                                                id="inputExpertise" placeholder="{{ __('Expertise') }}" value=""
                                                  />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="expertiseCompany"
                                                id="inputExpertiseCompany" placeholder="{{ __('Expertise Company') }}"
                                                value=""   />
                                        </div>
                                    </div>
                                    <button type="button" id="add" class="btn btn-primary">ADD</button>
                                    <button type="button" id="remove" class="btn btn-danger">DELETE LAST</button>
                                </div> --}}
                            </div>
                        </div>
                        {{-- END OF FIRST --}}

                        {{-- GENERAL CHECK --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('General') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.pmForm', ['namaKolom' => 'generalVisual'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'RCMS'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'wipeDown'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'inspectAll'])
                                
                            </div>
                        </div>
                        {{-- END OF GENERAL CHECK --}}

                        {{-- COMPRESSOR --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Compressor') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.pmForm', ['namaKolom' => 'compressorVisual'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'runningTime'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'radiateTime'])
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="">{{ __('Pulse Width') }}</label>
                                </div>
                                @include('tech.forms.pmPulseForm', ['namaKolom' => '0_4us'])
                                @include('tech.forms.pmPulseForm', ['namaKolom' => '0_8us'])
                                @include('tech.forms.pmPulseForm', ['namaKolom' => '1_0us'])
                                @include('tech.forms.pmPulseForm', ['namaKolom' => '2_0us'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'forwardPower'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'reversePower'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'VSWR'])
                                
                            </div>
                        </div>
                        {{-- END OF COMPRESSOR --}}

                        {{-- RECEIVER --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Receiver') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.pmForm', ['namaKolom' => 'receiverVisual'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'STALOCheck'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'AFCCheck'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'MRPCheck'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'RCUCheck'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'IQ2Check'])
                                
                            </div>
                        </div>
                        {{-- END OF RECEIVER --}}

                        {{-- ANTENNA/PEDESTAL --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Antenna/Pedestal') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                @include('tech.forms.pmForm', ['namaKolom' => 'antennaVisual'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'inspectMotor'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'cleanSlip'])
                                @include('tech.forms.pmForm', ['namaKolom' => 'greaseGear'])
                                
                            </div>
                        </div>
                        {{-- END OF ANTENNA/PEDESTAL --}}

                        {{-- SPAREPART RECOMENDATION --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Sparepart Recomendation') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                {{-- @include('tech.forms.rekomendasi') --}}
                            </div>
                        </div>
                        {{-- END OF SPAREPART RECOMENDATION --}}

                        {{-- CKEDITOR REMARK --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('REMARK') }}</h4>
                            </div>

                            <div class="card-body " id="dynamicField">
                                <div class="row">
                                    {{-- <label class="col-sm-2 col-form-label"
                                        for="inputRemark">{{ __('Remark') }}</label> --}}
                                    <div class="col-sm-7">
                                        <div class="form-group" id="editor">
                                            {{-- <input class="form-control" type="text" name="remark"
                                                id="inputRemark" placeholder="{{ __('Remark') }}" value=""
                                                  /> --}}
                                            <textarea class="editor" name="remark" id="inputRemark" cols="50" rows="10"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            if ($i <= 5) {
                $i++;
                $('#dynamicField').append(
                    '<div class="row" id="dynamicField' + $i +
                    '"><label class="col-sm-2 col-form-label" for="inputExpertise' + $i +
                    '">Expertise ' + $i +
                    '</label><div class="col-sm-4"><div class="form-group"><input class="form-control" input type="text" name="expertise' +
                    $i + '" id="inputExpertise' + $i +
                    '" placeholder="{{ __('Expertise') }}" value=""   /></div></div><div class="col-sm-3"><div class="form-group"><input class="form-control" input type="text" name="expertiseCompany' +
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
