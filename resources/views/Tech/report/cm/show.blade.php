@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@foreach ($HeadReport as $hr)

    @section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                    </div>
                    <div class="card-body ">
                        <a type="button" class="btn btn-info" href="{{ url('tech') }}">BACK</a>
                        <a type="button" class="btn btn-primary" href="{{ url('tech') }}">EDIT</a>
                        <a type="button" class="btn btn-danger" href="{{ url('tech') }}">DELETE</a>
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ $hr->radar_name }}</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Station Id</td>
                                                    <td>{{ $hr->station_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td>{{ $hr->report_date_start }}</td>
                                                    <td>s.d</td>
                                                    <td>{{ $hr->report_date_end }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Internal Expertise</td>
                                                    <td>{{ $hr->expertise1 }} </td>
                                                    <td>{{ $hr->expertise2 }}</td>
                                                    <td>{{ $hr->expertise3 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>External Expertise</td>
                                                    @for ($i = 4; $i <= 10; $i++)
                                                        @php
                                                            $externalExpertise = 'expertise' . $i;
                                                        @endphp
                                                        <td>{{ $hr->$externalExpertise }}</td>
                                                    @endfor
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END OF HEAD AND START OF BODY --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('REMARK') }}</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="container">
                                        <?php echo $cmBodyReport->remark ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@endforeach
