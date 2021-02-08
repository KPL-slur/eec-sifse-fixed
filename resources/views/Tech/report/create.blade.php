@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

{{-- IF entry_id not pm or cm will redirect to /tech --}}
@if ($_GET['entry_id'] == 'pm' or $_GET['entry_id'] == 'cm')

    @section('content')
        <div class="content">
            <div class="container-fluid">
                <h1>Create New {{ $_GET['entry_id'] === 'pm' ? 'Preventive' : 'Corective' }} Maintenance Report</h1>
                <div class="row">
                    <div class="col-md-12">
                        {{-- List of Form Name Inputs:
                        maintenance_type
                        radar_name
                        station_id
                        report_date_start
                        report_date_end
                        expertise1
                        expertise2
                        expertise3
                        expertise4
                        expertise5
                        expertise6
                        expertise7
                        expertise8
                        expertise9
                        expertise10
                        expertise_company1
                        expertise_company2
                        expertise_company3
                        expertise_company4
                        expertise_company5
                        expertise_company6
                        expertise_company7
                        expertise_company8
                        expertise_company9
                        expertise_company10 --}}
                        <form method="post" action="{{ url('/report') }}" class="form-horizontal">
                            @csrf

                            {{-- HIDDEN --}}
                            <input type="hidden" name="maintenance_type" value="{{ $_GET['entry_id'] }}">
                            {{-- END OF HIDDEN --}}

                            {{-- SUMMARY --}}
                            <div class="card ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                                </div>
                                {{-- DYNAMIC FIELDS --}}
                                <div class="card-body " id="dynamicField">
                                    @include('tech.report.layout.forms.summary-form', ['namaKolom'=>'radar_name', 'tipeForm'=>'text'])
                                    @include('tech.report.layout.forms.summary-form', ['namaKolom'=>'station_id', 'tipeForm'=>'text'])
                                    @include('tech.report.layout.forms.summary-form', ['namaKolom'=>'report_date_start',
                                    'tipeForm'=>'date'])
                                    @include('tech.report.layout.forms.summary-form', ['namaKolom'=>'report_date_end', 'tipeForm'=>'date'])

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label"
                                            for="inputInternalExpertise">{{ __('Internal Expertise') }}</label>
                                        @for ($i = 1; $i <= 3; $i++)
                                            <div class="form-group col-md-3 @error("expertise$i") label-floating has-danger @enderror">
                                                @error("expertise$i")
                                                    <label class="control-label force-has-danger">{{ $message }}</label>
                                                    <span class="material-icons form-control-feedback">clear</span>
                                                @enderror
                                                <select id="inputInternalExpertise{{ $i }}" class="form-control"
                                                    name="expertise{{ $i }}">
                                                    <option selected value="">Choose...</option>
                                                    @foreach ($technisians as $tech)
                                                        <option value="{{ $tech->name }}"
                                                            {{ old("expertise$i") == $tech->name ? 'selected' : '' }}>
                                                            {{ $tech->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" value="Era Elektra Corpora Indonesia"
                                                    name="expertise_company{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>

                                    {{-- FIELDS THAT CAN BE ADDED BY USER USING JS BELOW --}}
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label"
                                            for="inputExpertise">{{ __('External Expertise') }}</label>
                                        <div class="col-sm-4">
                                            <div class="form-group @error('expertise4') label-floating has-danger @enderror">
                                                @error('expertise4')
                                                    <label class="control-label">{{ $message }}</label>
                                                    <span class="material-icons form-control-feedback">clear</span>
                                                @enderror
                                                <input class="form-control" input type="text" name="expertise4"
                                                    id="inputExpertise4" placeholder="{{ __('Name') }}"
                                                    value="{{ old('expertise4') }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group @error('expertise_company4') label-floating has-danger @enderror">
                                                @error('expertise_company4')
                                                    <label class="control-label">{{ $message }}</label>
                                                    <span class="material-icons form-control-feedback">clear</span>
                                                @enderror
                                                <input class="form-control" input type="text" name="expertise_company4"
                                                    id="inputExpertiseCompany4"
                                                    placeholder="{{ __('Expertise Company') }}"
                                                    value="{{ old('expertise_company4') }}" />
                                            </div>
                                        </div>
                                        <button type="button" id="add" class="btn btn-primary">ADD</button>
                                        <button type="button" id="remove" class="btn btn-danger">DELETE LAST</button>
                                    </div>
                                    {{--  --}}
                                    @for ($i = 5; $i <= 10; $i++)

                                        @include('tech.report.layout.forms.external-expertise-form', ['iterasiKe'=>$i])

                                    @endfor
                                    {{--  --}}
                                </div>
                            </div>
                            {{-- END OF SUMMARY --}}

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

    <script src="{{ asset('user') }}/js/head-report.js" type="text/javascript"></script>
@else
    @php
        // redirect to /tech, replace, 
        // 301 Moved Permanently redirect status response code indicates that 
        // the resource requested has been definitively moved to the URL given by the Location headers
        header("location: ".url('/tech'), true, 301); 
        exit();
    @endphp
@endif

