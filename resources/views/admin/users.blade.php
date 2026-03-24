@extends('layouts.app')

@section('title', 'Management utilizatori — Nuva.ro')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h1 class="page-title" style="margin-bottom:0;">Management utilizatori</h1>
</div>

@if(session('success'))
    <div class="alert-success-custom">{{ session('success') }}</div>
@endif

<div class="glass-card">
    @if($users->isEmpty())
        <p style="color:var(--text-muted);text-align:center;padding:1rem;">Nu există utilizatori.</p>
    @else
        <div class="table-responsive">
            <table class="table table-borderless table-sm registru-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Status</th>
                        <th>Creat la</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email ?: '-' }}</td>
                            <td>{{ $user->role ?: 'user' }}</td>
                            <td>
                                @if($user->is_approved)
                                    <span class="badge-incasare">Validat</span>
                                @else
                                    <span class="new-user-badge">User nou</span>
                                @endif
                            </td>
                            <td>{{ optional($user->created_at)->format('d.m.Y H:i') }}</td>
                            <td class="text-end">
                                @if(!$user->is_approved)
                                    <form method="POST" action="{{ route('users.approve', $user->id) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-primary-custom" style="padding:0.35rem 0.75rem;font-size:12px;">
                                            Validează
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

