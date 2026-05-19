@extends('layouts.app')

@section('content')
    <h2 class="section-title" style="color: var(--danger);">// <span>Support</span> Tickets</h2>

    <div style="margin-bottom: 2rem;">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">&laquo; Back to Dashboard</a>
    </div>

    @if($tickets->isEmpty())
        <p style="color: var(--text-muted); font-family: monospace;">No support tickets found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reference</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td style="font-family: monospace; color: var(--accent);">#{{ $ticket->id }}</td>
                        <td>{{ $ticket->name }}</td>
                        <td style="font-family: monospace; font-size: 0.85rem;">{{ $ticket->email }}</td>
                        <td style="font-family: monospace;">{{ $ticket->reference_id ?? '—' }}</td>
                        <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Str::limit($ticket->message, 80) }}</td>
                        <td>{{ $ticket->created_at->format('d M Y') }}</td>
                        <td>
                            @if($ticket->status === 'resolved')
                                <span class="status status-ok">RESOLVED</span>
                            @elseif($ticket->status === 'in_progress')
                                <span class="status status-warn">IN PROGRESS</span>
                            @else
                                <span class="status" style="color: var(--accent); border-color: var(--accent);">OPEN</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}" style="display: flex; gap: 0.5rem; align-items: center;">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control" style="width: auto; margin-bottom: 0; padding: 0.4rem 0.6rem; font-size: 0.8rem;">
                                    <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                                <button type="submit" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 1rem;">
            {{ $tickets->links('partials.pagination') }}
        </div>
    @endif
@endsection
