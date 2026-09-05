@extends('backend.layouts.app')

@section('title', 'Contact Us Messages')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex flex-wrap justify-content-between align-items-center">
                <h5 class="card-title mb-2 mb-md-0">
                    <i class="fas fa-envelope-open-text me-2 text-warning"></i> Contact Us Client Messages
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge badge-light text-dark font-weight-bold px-3 py-2 mr-2">
                        Total: {{ count($messages) }}
                    </span>
                    <span class="badge badge-warning text-dark font-weight-bold px-3 py-2 mr-2">
                        <i class="fas fa-clock me-1"></i> Unread / Pending: {{ $messages->where('is_active', 0)->count() }}
                    </span>
                    <span class="badge badge-success px-3 py-2">
                        <i class="fas fa-check-circle me-1"></i> Read / Replied: {{ $messages->where('is_active', 1)->count() }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover align-middle" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 4%; text-align: center;">#</th>
                                <th style="width: 15%;">Sender</th>
                                <th style="width: 18%;">Email</th>
                                <th style="width: 18%;">Subject</th>
                                <th style="width: 23%;">Message Content</th>
                                <th style="width: 10%;">Received At</th>
                                <th style="width: 6%; text-align: center;">Status</th>
                                <th style="width: 6%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages as $key => $message)
                                <tr class="{{ $message->is_active == 0 ? 'bg-white font-weight-bold' : 'table-light' }}">
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center mr-2" style="width: 32px; height: 32px; font-size: 13px;">
                                                {{ strtoupper(substr($message->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong>{{ $message->name }}</strong>
                                                @if($message->is_active == 0)
                                                    <span class="badge badge-danger ml-1" style="font-size: 0.65rem;">NEW</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $message->email }}?subject=Re:%20{{ urlencode($message->subject ?? 'Your inquiry at Thai Spa') }}" class="text-primary text-decoration-none">
                                            <i class="far fa-envelope me-1"></i> {{ $message->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-dark">{{ $message->subject ?? 'No Subject' }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="text-secondary small" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $message->comments }}
                                            </div>
                                            <button type="button" class="btn btn-xs btn-outline-info ml-1" data-toggle="modal" data-target="#messageModal{{ $message->id }}" title="Read Full Message">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </div>

                                        <!-- Message Detail Modal -->
                                        <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-dark text-white">
                                                        <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">
                                                            <i class="fas fa-envelope-open me-2 text-warning"></i> Message from {{ $message->name }}
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-4 text-left">
                                                        <div class="mb-3 pb-2 border-bottom">
                                                            <div class="text-muted small">Sender Name:</div>
                                                            <div class="h6 font-weight-bold text-dark">{{ $message->name }}</div>
                                                        </div>
                                                        <div class="mb-3 pb-2 border-bottom">
                                                            <div class="text-muted small">Sender Email:</div>
                                                            <div>
                                                                <a href="mailto:{{ $message->email }}" class="h6 font-weight-bold text-primary">
                                                                    {{ $message->email }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 pb-2 border-bottom">
                                                            <div class="text-muted small">Subject:</div>
                                                            <div class="h6 font-weight-bold text-dark">{{ $message->subject ?? 'No Subject' }}</div>
                                                        </div>
                                                        <div class="mb-3 pb-2 border-bottom">
                                                            <div class="text-muted small">Received On:</div>
                                                            <div class="text-dark small">{{ date('F d, Y \a\t h:i A', strtotime($message->created_at ?? 'now')) }}</div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <div class="text-muted small mb-1">Full Message:</div>
                                                            <div class="p-3 bg-light rounded border text-dark" style="white-space: pre-wrap; line-height: 1.6;">
                                                                {{ $message->comments }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <div>
                                                            @if($message->is_active == 0)
                                                                <a href="{{ route('admin.setting.contact_messages.status', $message->id) }}" class="btn btn-sm btn-success">
                                                                    <i class="fas fa-check me-1"></i> Mark as Read
                                                                </a>
                                                            @else
                                                                <a href="{{ route('admin.setting.contact_messages.status', $message->id) }}" class="btn btn-sm btn-outline-warning text-dark">
                                                                    <i class="fas fa-undo me-1"></i> Mark as Unread
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <a href="mailto:{{ $message->email }}?subject=Re:%20{{ urlencode($message->subject ?? 'Your Inquiry') }}" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-reply me-1"></i> Reply via Email
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ date('M d, Y', strtotime($message->created_at ?? 'now')) }}<br>
                                            {{ date('h:i A', strtotime($message->created_at ?? 'now')) }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        @if ($message->is_active == 1)
                                            <a href="{{ route('admin.setting.contact_messages.status', $message->id) }}"
                                               class="btn btn-success btn-xs px-2 py-1 text-white shadow-sm"
                                               title="Click to mark as Unread">
                                                <i class="fas fa-check-circle me-1"></i> Read
                                            </a>
                                        @else
                                            <a href="{{ route('admin.setting.contact_messages.status', $message->id) }}"
                                               class="btn btn-warning btn-xs px-2 py-1 text-dark font-weight-bold shadow-sm"
                                               title="Click to mark as Read">
                                                <i class="fas fa-envelope me-1"></i> Unread
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.setting.contact_messages.delete', $message->id) }}"
                                           class="btn btn-danger btn-xs px-2 py-1 shadow-sm"
                                           onclick="return confirm('Are you sure you want to permanently delete this contact message?')"
                                           title="Delete Message">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="far fa-envelope-open fa-3x mb-3 text-secondary"></i>
                                            <h5>No Contact Messages Found</h5>
                                            <p class="small mb-0">Messages submitted through the Contact Us form will appear here.</p>
                                        </div>
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
