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
                        <th>Nume</th>
                        <th>Prenume</th>
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
                            <td>{{ $user->first_name ?: '-' }}</td>
                            <td>{{ $user->last_name ?: '-' }}</td>
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
                            <td class="text-end" style="white-space:nowrap;">
                                @if(!$user->is_approved)
                                    <form method="POST" action="{{ route('users.approve', $user->id) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-primary-custom" style="padding:0.35rem 0.75rem;font-size:12px;">
                                            Validează
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('users.destroy-pending', $user->id) }}" class="d-inline ms-1"
                                          onsubmit="return confirm('Ștergi utilizatorul nevalidat {{ $user->username }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-custom" style="padding:0.35rem 0.75rem;font-size:12px;">
                                            Șterge
                                        </button>
                                    </form>
                                @elseif(strtolower($user->username) !== 'tudor')
                                    <form method="POST" action="{{ route('users.revoke', $user->id) }}" class="d-inline"
                                          onsubmit="return confirm('Devalidezi utilizatorul {{ $user->username }}?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-edit-custom" style="padding:0.35rem 0.75rem;font-size:12px;">
                                            Devalidează
                                        </button>
                                    </form>
                                    <button type="button" class="btn-primary-custom ms-1"
                                            style="padding:0.35rem 0.75rem;font-size:12px;"
                                            onclick="openPasswordModal({{ $user->id }}, '{{ addslashes($user->username) }}')">
                                        Schimbă parola
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
{{-- Modal schimbare parolă --}}
<div id="passwordModal" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.45);align-items:center;justify-content:center;padding:1rem;">
    <div class="glass-card" style="max-width:420px;width:100%;">
        <h5 style="color:var(--text);font-family:'DM Sans',sans-serif;font-weight:400;font-size:15px;margin-bottom:1.5rem;">
            Schimbă parola — <span id="modalUsername" style="font-weight:600;"></span>
        </h5>

        @if($errors->has('parola_noua') || $errors->has('parola_noua_confirmation'))
            <div class="alert-danger-custom" style="margin-bottom:1rem;">
                @foreach($errors->get('parola_noua') as $e)<div>{{ $e }}</div>@endforeach
                @foreach($errors->get('parola_noua_confirmation') as $e)<div>{{ $e }}</div>@endforeach
            </div>
        @endif

        <form method="POST" id="passwordForm" action="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="_modal_user_id" id="modalUserId" value="{{ old('_modal_user_id') }}">
            <input type="hidden" name="_modal_username" id="modalUsernameInput" value="{{ old('_modal_username') }}">
            <div class="row g-3" style="margin-bottom:1.25rem;">
                <div class="col-12">
                    <label class="form-label">Parolă nouă</label>
                    <input type="password" name="parola_noua" class="form-control" required minlength="6" autocomplete="new-password">
                </div>
                <div class="col-12">
                    <label class="form-label">Confirmă parola nouă</label>
                    <input type="password" name="parola_noua_confirmation" class="form-control" required autocomplete="new-password">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn-primary-custom">Salvează</button>
                <button type="button" class="btn-edit-custom" onclick="closePasswordModal()">Anulează</button>
            </div>
        </form>
    </div>
</div>

<script>
function openPasswordModal(userId, username) {
    document.getElementById('modalUsername').textContent = username;
    document.getElementById('modalUserId').value = userId;
    document.getElementById('modalUsernameInput').value = username;
    document.getElementById('passwordForm').action = '/management-users/' + userId + '/change-password';
    document.getElementById('passwordModal').style.display = 'flex';
}
function closePasswordModal() {
    document.getElementById('passwordModal').style.display = 'none';
}
document.getElementById('passwordModal').addEventListener('click', function(e) {
    if (e.target === this) closePasswordModal();
});
@if($errors->has('parola_noua') || $errors->has('parola_noua_confirmation'))
(function() {
    var uid = document.getElementById('modalUserId').value;
    var uname = document.getElementById('modalUsernameInput').value;
    if (uid) openPasswordModal(uid, uname);
})();
@endif
</script>
@endsection
