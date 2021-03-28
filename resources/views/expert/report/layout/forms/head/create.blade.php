{{-- SUMMARY --}}
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
    </div>
    {{-- DYNAMIC FIELDS --}}
    <div class="card-body " id="dynamicField">

        {{-- SELECT SITE AND RADAR --}}
        <div class="row">
            <label class="col-sm-2 col-form-label" for="inputstation_id">Station Id</label>
            <div class="col-sm-8">
                <div class='@error('site_id') label-floating has-danger @enderror'>
                    @error('site_id')
                        <label class="control-label force-has-danger">{{ $message }}</label>
                        <span class="material-icons form-control-feedback">clear</span>
                    @enderror
                    <select name="site_id" wire:change="setRecommends"
                        id="inputsite_id"
                        wire:model="site_id" class="form-control">
                        <option value="">-- choose station --</option>
                        @foreach ($sites as $site)
                            <option value="{{ $site->site_id }}">
                                {{ $site->station_id }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 col-form-label" for="inputradar_name">Radar Name</label>
            <div class="col-sm-8">
                <div class="form-group @error('radar_name') label-floating has-danger @enderror">
                    @error('radar_name')
                    <label class="control-label force-has-danger">{{ $message }}</label>
                    <span class="material-icons form-control-feedback">clear</span>
                    @enderror
                    <input class="form-control " wire:model="radar" disabled
                    type="text" name="radar_name" id="inputradar_name"
                    />
                </div>
            </div>
        </div>
        {{-- END OF SELECT SITE AND RADAR --}}
        
        {{-- DATE SELECTOR --}}
        <div class="row">
            <label class="col-sm-2 col-form-label" for="input_report_date_start">Report Date Start</label>
            <div class="col-sm-8">
                <div class="form-group @error('report_date_start') label-floating has-danger @enderror">
                    @error('report_date_start')
                    <label class="control-label force-has-danger">{{ $message }}</label>
                    <span class="material-icons form-control-feedback">clear</span>
                    @enderror
                    <input class="form-control " wire:model.defer="report_date_start"
                        type="date" name="report_date_start" id="input_report_date_start"
                        placeholder="Report Date Start" />
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 col-form-label" for="input_report_date_end">Report Date End</label>
            <div class="col-sm-8">
                <div class="form-group @error('report_date_end') label-floating has-danger @enderror">
                    @error('report_date_end')
                    <label class="control-label force-has-danger">{{ $message }}</label>
                    <span class="material-icons form-control-feedback">clear</span>
                    @enderror
                    <input class="form-control " wire:model.defer="report_date_end"
                        type="date" name="report_date_end" id="input_report_date_end"
                        placeholder="Report Date End" />
                </div>
            </div>
        </div>
        {{-- END OF DATE SELECTOR --}}

        {{-- START OF EXPERTS FORMS --}}
        @include('expert.report.layout.forms.experts')
    </div>
</div>
