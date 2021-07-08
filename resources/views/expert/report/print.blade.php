<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Print ' . strtoupper($headReport->maintenance_type) . ' ' . $headReport->site->station_id) }} |
        EECID
    </title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('user') }}/img/eecidfix.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link href="{{ asset('user') }}/css/frameworks/gutenberg.css" rel="stylesheet" />
    <link href="{{ asset('user') }}/css/print.css" rel="stylesheet" />
    <script type="module" src="{{ asset('user') }}/js/plugins/alpine.js"></script>
    <script nomodule src="{{ asset('user') }}/js/plugins/alpine-ie11.js" defer></script>
</head>

<body>
    <table>

        <thead class="header">
            <tr>
                <td>
                    <!--place holder for the fixed-position header-->
                    <div class="page-header-space">
                        <img class="" src="{{ asset('user') }}/img/kop.png" width="300px" height="100px" />
                        <p class="text-tiny">
                            Head Office : Eightyeight@Kasablanka Tower A 26D floor. Jl. Raya Casablanca Kav. 88 Jakarta
                            Selatan - 12870<br>
                            Operational Office : Grand Palace Rukan A-16. Jl. Benyamin Suaeb No.5 - Kemayoran. Jakarta
                            Pusat - 10630<br>
                            Phone : 62-21-22606878, Email : eecindonesia@eecindonesia.co.id<br>
                        </p>
                    </div>
                </td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    <!--*** CONTENT GOES HERE ***-->
                    <main>
                        <h4 class="text-center">WEATHER RADAR {{ $headReport->site->radar_name }} SERVICE REPORT</h4>

                        <!----------------------------------------------------------------------------------------- HEAD -->
                        <Table class="report head-report">
                            <tr>
                                <td>
                                    <strong>
                                        STATION ID
                                    </strong>
                                </td>
                                <td colspan="2">
                                    {{ $headReport->site->station_id }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        DATE
                                    </strong>
                                </td>
                                <td colspan="2">
                                    {{ $date }}
                                </td>
                            </tr>
                            @foreach ($headReport->experts as $expert)
                                @if ($loop->first)
                                    <tr>
                                        <td rowspan="{{ $loop->count }}">
                                            <strong>
                                                EXPERTISE
                                            </strong>
                                        </td>
                                        <td id="expertName{{ $loop->iteration }}">{{ $expert->name }}</td>
                                        <td class="text-right" id="expertCompany{{ $loop->iteration }}">
                                            {{ $expert->expert_company }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td id="expertName{{ $loop->iteration }}">{{ $expert->name }}</td>
                                        <td class="text-right" id="expertCompany{{ $loop->iteration }}">
                                            {{ $expert->expert_company }}</td>
                                        <td class="text-right not-print" style="width: 100px">
                                            <button class="btn-up" data-index="{{ $loop->iteration }}">swap
                                                up</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </Table>
                        <!----------------------------------------------------------------------------------------- BODY -->
                        @if ($headReport->maintenance_type == 'pm')
                            <!----------------------------------------------------------------------------------------- GENERAL -->
                            <table class="report body-report">
                                <thead>
                                    <tr>
                                        <th>General</th>
                                        <th>Pass</th>
                                        <th>Fail</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <x-pm.print-row label="Visual Inspection"
                                        radio="{{ $headReport->pmBodyReport->radio_general_visual }}"
                                        remark="{{ $headReport->pmBodyReport->general_visual }}" />
                                    <x-pm.print-row label="RCMS Control And Monitoring Test"
                                        radio="{{ $headReport->pmBodyReport->radio_rcms }}"
                                        remark="{{ $headReport->pmBodyReport->rcms }}" />
                                    <x-pm.print-row label="Wipe down external surface"
                                        radio="{{ $headReport->pmBodyReport->radio_wipe_down }}"
                                        remark="{{ $headReport->pmBodyReport->wipe_down }}" />
                                    <x-pm.print-row label="Inspect inside all cabinets for vermin ingres"
                                        radio="{{ $headReport->pmBodyReport->radio_inspect_all }}"
                                        remark="{{ $headReport->pmBodyReport->inspect_all }}" />
                                </tbody>
                            </table>
                            <!----------------------------------------------------------------------------------------- COMPRESSOR -->
                            <table class="report body-report">
                                <thead>
                                    <tr>
                                        <th>Compressor</th>
                                        <th>Pass</th>
                                        <th>Fail</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <x-pm.print-row label="Visual Inspection"
                                        radio="{{ $headReport->pmBodyReport->radio_compressor_visual }}"
                                        remark="{{ $headReport->pmBodyReport->compressor_visual }}" />
                                    <x-pm.print-row label="Duty Cycle"
                                        radio="{{ $headReport->pmBodyReport->radio_duty_cycle }}"
                                        remark="{{ $headReport->pmBodyReport->duty_cycle }}" />
                                </tbody>
                            </table>
                            <!----------------------------------------------------------------------------------------- TRANSMITTER -->
                            <table class="report body-report">
                                <thead>
                                    <tr>
                                        <th>TRANSMITTER</th>
                                        <th>Pass</th>
                                        <th>Fail</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <x-pm.print-row label="Visual Inspection"
                                        radio="{{ $headReport->pmBodyReport->radio_transmitter_visual }}"
                                        remark="{{ $headReport->pmBodyReport->transmitter_visual }}" />
                                    <x-pm.print-row label="Running Time" satuan="hrs"
                                        radio="{{ $headReport->pmBodyReport->radio_running_time }}"
                                        remark="{{ $headReport->pmBodyReport->running_time }}" />
                                    <x-pm.print-row label="Radiate Time" satuan="hrs"
                                        radio="{{ $headReport->pmBodyReport->radio_radiate_time }}"
                                        remark="{{ $headReport->pmBodyReport->radiate_time }}" />
                                    <tr>
                                        <td>Pulse Width</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td rowspan="5" style="padding: 0">
                                            <table class="nested-table">
                                                <tr>
                                                    <th>HVPS_V</th>
                                                    <th>HVPS_I</th>
                                                    <th>Mag_I</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $headReport->pmBodyReport->hvps_v_0_4us }} V</td>
                                                    <td>{{ $headReport->pmBodyReport->hvps_i_0_4us }} A</td>
                                                    <td>{{ $headReport->pmBodyReport->mag_i_0_4us }} mA</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $headReport->pmBodyReport->hvps_v_0_8us }} V</td>
                                                    <td>{{ $headReport->pmBodyReport->hvps_i_0_8us }} A</td>
                                                    <td>{{ $headReport->pmBodyReport->mag_i_0_8us }} mA</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $headReport->pmBodyReport->hvps_v_1_0us }} V</td>
                                                    <td>{{ $headReport->pmBodyReport->hvps_i_1_0us }} A</td>
                                                    <td>{{ $headReport->pmBodyReport->mag_i_1_0us }} mA</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $headReport->pmBodyReport->hvps_v_2_0us }} V</td>
                                                    <td>{{ $headReport->pmBodyReport->hvps_i_2_0us }} A</td>
                                                    <td>{{ $headReport->pmBodyReport->mag_i_2_0us }} mA</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <x-pm.print-row label="0.4 us"
                                        radio="{{ $headReport->pmBodyReport->radio_0_4us }}" />
                                    <x-pm.print-row label="0.8 us"
                                        radio="{{ $headReport->pmBodyReport->radio_0_8us }}" />
                                    <x-pm.print-row label="1.0 us"
                                        radio="{{ $headReport->pmBodyReport->radio_1_0us }}" />
                                    <x-pm.print-row label="2.0 us"
                                        radio="{{ $headReport->pmBodyReport->radio_2_0us }}" />

                                    <x-pm.print-row label="Forward Power" satuan="dBm"
                                        radio="{{ $headReport->pmBodyReport->radio_forward_power }}"
                                        remark="{{ $headReport->pmBodyReport->forward_power }}" />
                                    <x-pm.print-row label="Reverse Power" satuan="dBm"
                                        radio="{{ $headReport->pmBodyReport->radio_reverse_power }}"
                                        remark="{{ $headReport->pmBodyReport->reverse_power }}" />
                                    <x-pm.print-row satuan=":1" label="VSWR"
                                        radio="{{ $headReport->pmBodyReport->radio_vswr }}"
                                        remark="{{ $headReport->pmBodyReport->vswr }}" />
                                </tbody>
                            </table>
                            <!----------------------------------------------------------------------------------------- RECEIVER -->
                            <table class="report body-report">
                                <thead>
                                    <tr>
                                        <th>Receiver</th>
                                        <th>Pass</th>
                                        <th>Fail</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <x-pm.print-row label="Visual Inspection"
                                        radio="{{ $headReport->pmBodyReport->radio_receiver_visual }}"
                                        remark="{{ $headReport->pmBodyReport->receiver_visual }}" />
                                    <x-pm.print-row label="Stalo Check"
                                        radio="{{ $headReport->pmBodyReport->radio_stalo_check }}"
                                        remark="{{ $headReport->pmBodyReport->stalo_check }}" />
                                    <x-pm.print-row label="AFC Check"
                                        radio="{{ $headReport->pmBodyReport->radio_afc_check }}"
                                        remark="{{ $headReport->pmBodyReport->afc_check }}" />
                                    <x-pm.print-row label="MRP Check"
                                        radio="{{ $headReport->pmBodyReport->radio_mrp_check }}"
                                        remark="{{ $headReport->pmBodyReport->mrp_check }}" />
                                    <x-pm.print-row label="RCU Check"
                                        radio="{{ $headReport->pmBodyReport->radio_rcu_check }}"
                                        remark="{{ $headReport->pmBodyReport->rcu_check }}" />
                                    <x-pm.print-row label="IQ2 Check"
                                        radio="{{ $headReport->pmBodyReport->radio_iq2_check }}"
                                        remark="{{ $headReport->pmBodyReport->iq2_check }}" />
                                </tbody>
                            </table>
                            <!----------------------------------------------------------------------------------------- ANTENNA/PEDESTAL -->
                            <table class="report body-report">
                                <thead>
                                    <tr>
                                        <th>Antenna/Pedestal</th>
                                        <th>Pass</th>
                                        <th>Fail</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <x-pm.print-row label="Visual Inspection"
                                        radio="{{ $headReport->pmBodyReport->radio_antenna_visual }}"
                                        remark="{{ $headReport->pmBodyReport->antenna_visual }}" />
                                    <x-pm.print-row label="Inspect Motor Drive"
                                        radio="{{ $headReport->pmBodyReport->radio_inspect_motor }}"
                                        remark="{{ $headReport->pmBodyReport->inspect_motor }}" />
                                    <x-pm.print-row label="Clean Slip-rings"
                                        radio="{{ $headReport->pmBodyReport->radio_clean_slip }}"
                                        remark="{{ $headReport->pmBodyReport->clean_slip }}" />
                                    <x-pm.print-row label="Grease Gears and Bearing"
                                        radio="{{ $headReport->pmBodyReport->radio_grease_gear }}"
                                        remark="{{ $headReport->pmBodyReport->grease_gear }}" />
                                </tbody>
                            </table>
                        @endif
                        <!----------------------------------------------------------------------------------------- REMARK -->
                        <hr>
                        <h5>Remark</h5>
                        <?php echo $bodyReport->remark; ?>
                        <hr>
                        <!----------------------------------------------------------------------------------------- RECOMMENDATIONS -->
                        <table class="report recommendation">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Recommendation Items</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recomendations as $recomendation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $recomendation['name'] }}</td>
                                        <td>{{ $recomendation['jumlah_unit_needed'] }}</td>
                                    </tr>
                                @endforeach
                            <tbody>
                        </table>
                        <!----------------------------------------------------------------------------------------- TTD PENGESAHAN -->
                        <div class="avoid-break-inside">
                            <table class="report ttd">
                                @foreach ($headReport->experts as $expert)
                                    <tr>
                                        <td id="expertNameNip{{ $loop->iteration }}">
                                            {{ $expert->name }}<br>
                                            {{ $expert->nip }}
                                        </td>
                                        <td id="expertCompanyRole{{ $loop->iteration }}">
                                            {{ $expert->pivot->role }}<br>
                                            {{ $expert->expert_company }}
                                        </td>
                                        <td>&nbsp;</td>
                                        <td class="text-right not-print" style="width: 100px">
                                            @if (!$loop->first)
                                                <button class="btn-up2" data-index="{{ $loop->iteration }}">swap
                                                    up</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <!----------------------------------------------------------------------------------------- TTD PENGESAHAN -->
                            <div class="m-center text-center">
                                <p>
                                    Mengetahui,<br>
                                    Kepala Statsiun Meteorologi {{ $headReport->site->station_id }}
                                </p>
                                <div>&nbsp;</div>
                                <div>&nbsp;</div>
                                <div>&nbsp;</div>
                                <p>
                                    <strong><u>{{ $headReport->kasat_name }}</u></strong><br>
                                    NIP. {{ $headReport->kasat_nip }}
                                </p>
                            </div>
                        </div>
                        <!----------------------------------------------------------------------------------------- LAMPIRAN -->
                        <h5 class="page-break-before">Lampiran Kegiatan</h5>
                        <table class="report no-margin">
                            <tr>
                                @foreach ($healthyFiles as $index => $reportImage)
                                    <td colspan="{{ $loop->last ? 2 : 1 }}" x-data="{height: 200}">
                                        <img src="{{ asset('storage/' . $reportImage->image) }}" width="350"
                                            height="200" class="m-center" alt="" id="image_{{ $index }}"
                                            x-bind:height="height">
                                        <p class="text-center no-margin" id="caption_{{ $index }}">
                                            {{ $reportImage->caption }}
                                        </p>
                                        <button class="not-print"
                                            x-on:click="height = (height == 'auto' ? 200 : 'auto')">Fit</button>
                                        <button class="not-print btn-swap" data-id="{{ $index }}">Swap</button>
                                    </td>
                                    @if ($loop->iteration % 2 == 0)
                            </tr>
                            <tr>
                        </table>
                        <table class="report no-margin">
                            @endif
                            @endforeach
                        </table>
                    </main>
                </td>
            </tr>
        </tbody>

    </table>

    <!-- Modal WArning -->
    @if ($zombieFiles)
        <div id="warning-modal" class="modal not-print">
            <div class="modal-content">
                <h2 class="text-warning">Warning</h2>
                <p>Warning, some attachment files are missing from storage.
                    <strong>Missing files are not included in this page.</strong>
                    Please remove or edit the attachment file at edit page.
                </p>
                <h6 class="list-heading">The following is a list of captions for the missing files</h6>
                <ul>
                    @foreach ($zombieFiles as $zombieFile)
                        <li>{{ $zombieFile }}</li>
                    @endforeach
                </ul>
                <p class="close">Dangerously Proceded To Print</p>
            </div>

        </div>
    @else
        <script>
            window.print();
        </script>
    @endif

    <script src="{{ asset('user') }}/js/print-report.js"></script>
</body>

</html>
