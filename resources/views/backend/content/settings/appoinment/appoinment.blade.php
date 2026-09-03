@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex flex-wrap justify-content-between align-items-center">
                <h5 class="card-title mb-2 mb-md-0">
                    <i class="fas fa-calendar-check me-2 text-warning"></i> Client Appointments & Online Bookings
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge badge-light text-dark font-weight-bold px-3 py-2 mr-2">
                        Total: {{ count($appointments) }}
                    </span>
                    <span class="badge badge-success px-3 py-2 mr-2">
                        <i class="fas fa-check-circle me-1"></i> Connected: {{ $appointments->where('is_connect', 1)->count() }}
                    </span>
                    <span class="badge badge-warning text-dark px-3 py-2">
                        <i class="fas fa-phone me-1"></i> Pending: {{ $appointments->where('is_connect', 0)->count() }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover align-middle" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 4%; text-align: center;">#</th>
                                <th style="width: 16%;">Service / Treatment</th>
                                <th style="width: 14%;">Date & Time</th>
                                <th style="width: 16%;">Client Info</th>
                                <th style="width: 14%;">Contact</th>
                                <th style="width: 17%;">Special Notes / Message</th>
                                <th style="width: 11%; text-align: center;">Connection Status</th>
                                <th style="width: 8%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $key => $appointment)
                                <tr class="{{ $appointment->is_connect == 1 ? 'table-light' : '' }}">
                                    <td class="text-center font-weight-bold">{{ $key + 1 }}</td>
                                    <td>
                                        @if(optional($appointment->rel_to_service)->title)
                                            <span class="badge badge-primary px-2 py-1" style="font-size: 0.85rem;">
                                                <i class="fas fa-spa me-1"></i> {{ $appointment->rel_to_service->title }}
                                            </span>
                                        @elseif($appointment->appointment_service)
                                            <span class="badge badge-secondary px-2 py-1" style="font-size: 0.85rem;">
                                                Service #{{ $appointment->appointment_service }}
                                            </span>
                                        @else
                                            <span class="badge badge-info px-2 py-1">General Booking</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <i class="far fa-calendar-alt text-primary me-1"></i>
                                            <strong>{{ $appointment->appointment_date ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="text-muted small mt-1">
                                            <i class="far fa-clock text-secondary me-1"></i>
                                            {{ $appointment->appointment_time ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-bold">{{ $appointment->name }}</div>
                                        <small class="text-muted">Booked: {{ date('M d, Y h:i A', strtotime($appointment->created_at ?? 'now')) }}</small>
                                    </td>
                                    <td>
                                        <div>
                                            @if($appointment->number)
                                                <a href="tel:{{ $appointment->number }}" class="text-dark font-weight-bold text-decoration-none">
                                                    <i class="fas fa-phone-alt text-success me-1"></i> {{ $appointment->number }}
                                                </a>
                                            @else
                                                <span class="text-muted">No phone</span>
                                            @endif
                                        </div>
                                        @if($appointment->email)
                                            <div class="small mt-1">
                                                <a href="mailto:{{ $appointment->email }}" class="text-muted text-decoration-none">
                                                    <i class="far fa-envelope text-info me-1"></i> {{ $appointment->email }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($appointment->message))
                                            <div class="p-2 rounded bg-light border" style="max-height: 80px; overflow-y: auto; font-size: 0.88rem;">
                                                {{ $appointment->message }}
                                            </div>
                                        @else
                                            <span class="text-muted font-italic small">No additional notes</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($appointment->is_connect == 1)
                                            <a href="{{ route('admin.setting.appointment.status', $appointment->id) }}"
                                               class="btn btn-success btn-sm px-2 py-1 text-white text-nowrap shadow-sm"
                                               title="Click to toggle status to Not Connected">
                                                <i class="fas fa-check-circle me-1"></i> Connected
                                            </a>
                                        @else
                                            <a href="{{ route('admin.setting.appointment.status', $appointment->id) }}"
                                               class="btn btn-outline-warning text-dark font-weight-bold btn-sm px-2 py-1 text-nowrap shadow-sm"
                                               title="Click to mark client as Connected">
                                                <i class="fas fa-phone-volume me-1 text-warning"></i> Not Connected
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.setting.appointment.delete', $appointment->id) }}"
                                           class="btn btn-danger btn-sm px-2 py-1"
                                           onclick="return confirm('Are you sure you want to delete this appointment booking?')">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-calendar-times fa-2x mb-2 d-block"></i>
                                        No appointments or booking requests found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

