@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
                        @csrf
                        @method('put')

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
                                                required />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputReportDate">{{ __('Date') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="date" name="reportDate"
                                                id="inputReportDate" placeholder="{{ __('Date') }}" value=""
                                                required />
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
                                                required />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputExpertise">{{ __('Expertise') }}</label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="expertise"
                                                id="inputExpertise" placeholder="{{ __('Expertise') }}" value=""
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="expertiseCompany"
                                                id="inputExpertiseCompany" placeholder="{{ __('Expertise Company') }}"
                                                value="" required />
                                        </div>
                                    </div>
                                    <button type="button" id="add" class="btn btn-primary">ADD</button>
                                    <button type="button" id="remove" class="btn btn-danger">DELETE LAST</button>
                                </div>
                            </div>
                        </div>
                        {{-- END OF FIRST --}}

                        {{-- GENERAL CHECK --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('GENERAL') }}</h4>
                            </div>
                            <div class="card-body " id="">
                                {{--  --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputVisualInspection">{{ __('Visual Inspection') }}</label>
                                    <div class="col-sm-2">
                                        {{--  --}}
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radioVisualInspection"
                                                    id="inputVisualInspection1" value="1"> PASS
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radioVisualInspection"
                                                    id="inputVisualInspection0" value="0"> FAIL
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        {{--  --}}
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="visualInspection"
                                                id="inputVisualInspection" placeholder="{{ __('REMARK') }}" value=""
                                                required />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputRCMS">{{ __('RCMS Control And Monitoring Test') }}</label>
                                    <div class="col-sm-2">
                                        {{--  --}}
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radioRCMS"
                                                    id="inputRCMS1" value="1"> PASS
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radioRCMS"
                                                    id="inputRCMS0" value="0"> FAIL
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        {{--  --}}
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="RCMS" id="inputRCMS"
                                                placeholder="{{ __('REMARK') }}" value="" required />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputWipe">{{ __('Wipe Down External Surface') }}</label>
                                    <div class="col-sm-2">
                                        {{--  --}}
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radioWipe"
                                                    id="inputWipe1" value="1"> PASS
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radioWipe"
                                                    id="inputWipe0" value="0"> FAIL
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        {{--  --}}
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="wipe" id="inputWipe"
                                                placeholder="{{ __('REMARK') }}" value="" required />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="inputInspect">{{ __('Inspect Inside All Cabinets For Vermin Ingres') }}</label>
                                    <div class="col-sm-2">
                                        {{--  --}}
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radioInspect"
                                                    id="inputRadioInspect1" value="1"> PASS
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radioInspect"
                                                    id="inputRadioInspect0" value="0"> FAIL
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        {{--  --}}
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="inspect" id="inputInspect"
                                                placeholder="{{ __('REMARK') }}" value="" required />
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                            </div>
                        </div>
                        {{-- END OF GENERAL CHECK --}}

                        {{-- REKOMENDASI --}}
                        
                        {{-- END OF REKOMENDASI --}}

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
                                                required /> --}}
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
                            <button type="button" class="btn btn-primary mx-5">SUBMIT</button>
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
                    '" placeholder="{{ __('Expertise') }}" value="" required /></div></div><div class="col-sm-3"><div class="form-group"><input class="form-control" input type="text" name="expertiseCompany' +
                    $i + '" id="inputExpertiseCompany' + $i +
                    '" placeholder="{{ __('Expertise Company') }}" value="" required /></div></div></div>'
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
