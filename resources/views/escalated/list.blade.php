@extends('layouts.app')

@section('title', 'Escalated Incident')

@php
    use App\Enums\FailureLogStatusEnum;
@endphp

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Escalated Incident</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Escalated Incident</li>
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
                            <div class="card-header">
                                <h3 class="card-title">Incident Log</h3>
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
                                        <tbody>
                                            @foreach ($escalatedLogs as $log)
                                                <tr>
                                                    <td>{{ $log->job }}</td>
                                                    <td>{{ $log->error }}<br><small
                                                            class="text-muted">{{ $log->exception }}</small></td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ FailureLogStatusEnum::from($log->status)->color() }}">
                                                            {{ FailureLogStatusEnum::from($log->status)->label() }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $log->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('mp.resolved', ['id' => $log->id]) }}"
                                                            class="btn btn-outline-primary btn-resolve">
                                                            Resolved
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.resolve-btn').on('click', function(e) {
            e.preventDefault();

            const href = $(this).attr('href');

            Swal.fire({
                title: "Mark this incident as resolved?",
                text: "Are you sure you want to mark this incident as resolved?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, mark as resolved",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        });
    </script>
@endsection
