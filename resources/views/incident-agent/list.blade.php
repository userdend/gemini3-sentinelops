@extends('layouts.app')

@section('title', 'Incident Agent')

@php
    use App\Enums\FailureLogStatusEnum;
@endphp

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Incident agent <b>powered by Gemini AI</b>
                    – receives failure logs, analyzes
                    root
                    causes, and generates mitigation plans.</div>
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Incident Agent</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Incident Agent</li>
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
                    <div class="col-lg-12">
                        <!-- /.card -->
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center">
                                <h3 class="card-title mb-0">Incident Log</h3>
                                <div class="ms-auto">
                                    <button id="scan-all" class="btn btn-outline-primary">Scan All</button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="failure-logs" class="table table-striped table-bordered">
                                        <thead class="text-nowrap align-middle">
                                            <tr>
                                                <th>Job</th>
                                                <th>Error<br><small class="text-muted">Exception</small></th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
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

        $(document).ready(function() {
            function loadLogs() {
                $.get("{{ route('job.incident-logs') }}", function(data) {
                    let tbody = $('#failure-logs tbody');
                    tbody.empty(); // clear old rows

                    if (!data || data.length === 0) {
                        $('#scan-all').prop('disabled', true);
                    } else {
                        $('#scan-all').prop('disabled', false);
                    }

                    data.forEach(log => {
                        const style = statusStyles[log.status] || {
                            label: log.status,
                            color: 'gray'
                        };

                        tbody.append(`
                            <tr data-id="${log.id}">
                                <td>${log.job}</td>
                                <td>${log.error}<br><small class="text-muted">${log.exception}</small></td>
                                <td>
                                    <span class="badge ${style.color}">
                                        ${style.label}
                                    </span>
                                </td>
                                <td>${log.created_at}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-outline-primary incident-resolve">Resolve</button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });
                });
            }

            loadLogs();

            $(document).on('click', '.incident-resolve', function() {
                Swal.fire({
                    title: "Resolve this incident manually?",
                    text: "This will mark the error as resolved.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, resolve manually"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('job.resolve-manually') }}`,
                            method: 'POST',
                            data: {
                                id: $(this).closest('tr').data('id'),
                                _token: "{{ csrf_token() }}"
                            },
                            beforeSend() {
                                Swal.fire({
                                    title: "Resolving...",
                                    text: "Please wait",
                                    allowOutsideClick: false,
                                    didOpen: () => Swal.showLoading()
                                });
                            },
                            success() {
                                Swal.fire({
                                    title: "Resolved!",
                                    text: "The incident has been marked as resolved.",
                                    icon: "success"
                                });

                                loadLogs();
                            },
                            error() {
                                Swal.fire({
                                    title: "Error",
                                    text: "Failed to resolve the incident.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });

            $('#scan-all').on('click', function() {
                const $btn = $(this);
                $('.incident-scan').prop('disabled', true);
                $btn.prop('disabled', true);

                Swal.fire({
                    title: "Scan and send incident logs to Gemini AI?",
                    text: "This will analyze all current incident logs and generate mitigation plans automatically. Make sure you’re ready to send them.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, send them",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('gemini.scan') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            beforeSend() {
                                Swal.fire({
                                    title: "Waiting for Gemini...",
                                    text: "Please wait",
                                    allowOutsideClick: false,
                                    didOpen: () => Swal.showLoading()
                                });
                            },
                            success() {
                                Swal.fire({
                                    title: "Gemini has returned!",
                                    text: "The incident has been marked as analyzed, check the mitigation plan page.",
                                    icon: "success"
                                });
                                loadLogs();
                            },
                            error() {
                                Swal.fire({
                                    title: "Error",
                                    text: "Something went wrong when sending to Gemini.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                }).finally(() => {
                    $('.incident-scan').prop('disabled', false);
                    $btn.prop('disabled', false);
                });
            });
        });
    </script>
@endsection
