@extends('layouts.master')
@section('title')
    {{ __('sentence.follow') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <form method="post" action="{{ route('prescription.store') }}">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.follow') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-md-5 ">
                            <div class=" chart-statistic mb-4">
                                <div class="mt-5"><canvas id="myDoughnutChart" width="100%" height="40%"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                {{-- drug list --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Drugs list') }}</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> {{ __('sentence.Add Drug') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                {{-- drug list end --}}
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.multiselect-search').select2();

            // Get references to the patient and test select elements
            const patientSelect = $('#PatientID');
            const testSelect = $('#test');

            // Store the original test options
            const originalTestOptions = testSelect.html();

            // Function to update test options based on the selected patient
            function updateTestOptions() {
                const selectedPatientName = patientSelect.find('option:selected').text();

                // Clear and restore original test options
                testSelect.empty().html(originalTestOptions);

                // Filter and show test options based on the selected patient
                testSelect.find('option').each(function() {
                    const optionText = $(this).text();
                    if (optionText.includes(selectedPatientName)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Trigger the Select2 plugin to update the dropdown
                testSelect.trigger('change');
            }

            // Attach a change event listener to the patient select element
            patientSelect.on('change', function() {
                updateTestOptions();
            });
        });
    </script>

    <script type="text/template" id="drugs_labels">
        <section class="field-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group-custom">
                                            <input type="text" class="form-control"
                                            name="type[]" id="task_{?}" placeholder="{{ __('sentence.Type') }}"
                                            class="ui-autocomplete-input" style="
                                                                                color: #28a745;
                                                                                background-color: transparent;
                                                                                border-color: #28a745;"
                                            value="new" autocomplete="off" @readonly(true)>
                                            <label class="control-label"></label><i class="bar"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <select class="form-control multiselect-drug" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                                            @if (@empty($drugs))
                                                <option value="" disabled selected>{{ __('sentence.Select Drug') }}...</option>
                                            @else
                                                @foreach($drugs as $drug)
                                                    <option value="{{ $drug->id }}">{{ $drug->trade_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div id="genericNames"></div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group-custom">
                                            <input type="number" min="0" id="dose" name="dose[]" class="form-control" placeholder="{{ __('sentence.Dose') }}">
                                            <label class="control-label"></label><i class="bar"></i>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group-custom">
                                            <input type="date" id="duration" name="duration[]" class="form-control" placeholder="{{ __('sentence.Duration') }}">
                                            <small id="startDate" class="form-text text-muted">Definir la period du suivi</small>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <div class="form-group-custom">
                                            <input type="date" id="strength" name="strength[]"  class="form-control" placeholder="{{ __('sentence.Duration') }}">
                                            <small id="startDate" class="form-text text-muted">Select date to view time slots available</small>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group-custom">
                                            <input type="text" id="drug_advice" name="drug_advice[]" class="form-control" placeholder="{{ __('sentence.Advice_Comment') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                            <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                                    </div>
                                    <div class="col-12">
                                            <hr color="#a1f1d4">
                                    </div>
                                </div>
            </section>
    </script>
@endsection

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript">
        $('#trade_name').multiselect();
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard/vendor/chart.js/Chart.bundle.js"></script>
    <script type="text/javascript">
        var _ydata = JSON.parse('{!! json_encode($months) !!}');
        var _xdata = JSON.parse('{!! json_encode($totalAmounts) !!}');
    </script>
    <script src="{{ asset('assets/demo/chart-doughnut-demo.js') }}"></script>

    <script>
        $(function() {
            $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });
        });
    </script>
@endsection