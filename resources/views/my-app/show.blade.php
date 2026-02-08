@extends('layouts.app')

@section('title', 'My App')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i><b>My App</b> mimics real-world
                    applications—unexpected failures can occur at
                    any
                    time. In this module, you can choose a chaos profile and observe controlled failures. This setup enables
                    testing Gemini AI as an incident agent, analyzing root causes, and generating mitigation plans for
                    incidents.</div>
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">My App</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My App</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="card card-danger card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header">
                                <div class="card-title">Chaos Profile</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-2">
                                    <!--begin::Col-->
                                    <div class="col-12 col-lg-9">
                                        <select name="chaos-profile" id="chaos-profile" class="form-select">
                                            <option disabled selected>Select a profile</option>
                                            @foreach ($profiles as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12 col-lg-3 d-grid">
                                        <button id="dispatch-job" class="btn btn-primary">Dispatch</button>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3 id="active-jobs">0</h3>
                                <p>Active Jobs</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                                </path>
                            </svg>
                            <a href="#"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 4-->
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3 id="failed-jobs">0</h3>
                                <p>Failed Jobs</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                                </path>
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                                </path>
                            </svg>
                            <a href="#"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 4-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-5 connectedSortable">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Job Status</h3>
                            </div>
                            <div class="card-body">
                                <div id="job-chart"></div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.Start col -->
                    <div class="col-lg-7">
                        <!-- /.card -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Error Log</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table id="failure-logs" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Error</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

    <script>
        $('#dispatch-job').click(function() {
            let profileId = $('#chaos-profile').val();

            $.ajax({
                url: "{{ route('myapp.dispatch') }}",
                type: 'POST',
                data: {
                    id: profileId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response.data);
                    Swal.fire("Dispatched " + response.data.name);
                },
                error: function(err) {
                    console.error(err);
                    Swal.fire('Something went wrong!');
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initial empty series
            var options = {
                chart: {
                    height: 200,
                    type: 'area',
                    toolbar: {
                        show: false,
                    },
                },
                legend: {
                    show: true,
                },
                colors: ['#0d6efd', '#dc3545'],
                dataLabels: {
                    enabled: false,
                },
                series: [{
                    name: 'Active Jobs',
                    data: [] // start empty
                }, {
                    name: 'Failed Jobs',
                    data: []
                }],
                xaxis: {
                    type: 'datetime',
                    labels: {
                        show: false,
                    }
                },
                stroke: {
                    curve: 'smooth'
                },
                tooltip: {
                    x: {
                        format: 'HH:mm:ss'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#job-chart"), options);
            chart.render();

            // Function to fetch counts
            function fetchJobCounts() {
                $.get("{{ route('job.active-count') }}", function(activeRes) {
                    $.get("{{ route('job.failed-count') }}", function(failedRes) {
                        var now = new Date().getTime(); // timestamp

                        // Add new point for active jobs
                        chart.appendData([{
                            data: [
                                [now, activeRes.count]
                            ]
                        }, {
                            data: [
                                [now, failedRes.count]
                            ]
                        }]);

                        $('#active-jobs').text(activeRes.count);
                        $('#failed-jobs').text(failedRes.count);
                    });
                });
            }

            fetchJobCounts();

            // Fetch every 2 seconds
            setInterval(fetchJobCounts, 2000);
        });
    </script>

    <script>
        const statusStyles = {
            open: {
                label: 'Open',
                color: 'bg-danger'
            },
            analyzed: {
                label: 'Analyzed',
                color: 'bg-primary'
            },
            escalated: {
                label: 'Escalated',
                color: 'bg-warning'
            },
            resolved: {
                label: 'Resolved',
                color: 'bg-success'
            }
        };

        function loadLogs() {
            $.get("{{ route('job.failure-logs') }}", function(data) {
                let tbody = $('#failure-logs tbody');
                tbody.empty(); // clear old rows
                data.forEach(log => {
                    const style = statusStyles[log.status] || {
                        label: log.status,
                        color: 'gray'
                    };

                    tbody.append(`
                        <tr>
                            <td>${log.id}</td>
                            <td>${log.error.length > 24 ? log.error.slice(0, 24) + '…' : log.error}</td>
                            <td>
                                <span class="badge ${style.color}">
                                    ${style.label}
                                </span>
                            </td>
                            <td>${log.created_at}</td>
                        </tr>
                    `);
                });
            });
        }

        loadLogs(); // initial load

        // Poll every 3 seconds
        setInterval(loadLogs, 3000);
    </script>
@endsection
