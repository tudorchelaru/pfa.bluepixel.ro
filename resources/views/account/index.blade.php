@extends('layouts.app')
@section('title', 'Contul meu — PFA Expenses')

@section('content')
<div class="page-content">
    <div style="max-width:860px; margin:0 auto;">

        <h2 class="page-title">Contul meu</h2>

        {{-- ── Tab nav ────────────────────────────────── --}}
        @php $tab = session('tab', 'profil'); @endphp
        <div style="display:flex; gap:0.5rem; margin-bottom:1.5rem; border-bottom:1px solid var(--border); padding-bottom:0;">
            @foreach(['profil'=>'Profil', 'parola'=>'Parolă', 'firma'=>'Datele firmei'] as $key=>$label)
            <button onclick="switchTab('{{ $key }}')" id="tab-btn-{{ $key }}"
                style="padding:0.6rem 1.25rem; border:none; background:none; font-family:'DM Sans',sans-serif; font-weight:300; font-size:13px; letter-spacing:.04em;
                       cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-1px;
                       color:var(--text-muted); transition:color .2s, border-color .2s;">
                {{ $label }}
            </button>
            @endforeach
        </div>

        {{-- ── Mesaje ──────────────────────────────────── --}}
        @foreach(['success_profil','success_parola','success_firma'] as $msg)
            @if(session($msg))
            <div class="alert-success-custom">{{ session($msg) }}</div>
            @endif
        @endforeach
        @if($errors->any())
        <div class="alert-danger-custom">{{ $errors->first() }}</div>
        @endif

        {{-- ══ TAB 1 — PROFIL ════════════════════════════ --}}
        <div id="tab-profil" class="account-tab glass-card" style="margin-bottom:1.5rem;">
            <h5 style="color:var(--text); font-family:'DM Sans',sans-serif; font-weight:400; font-size:15px; margin-bottom:1.25rem;">Date profil</h5>
            <form method="POST" action="{{ route('account.profil') }}">
                @csrf @method('PATCH')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control"
                               value="{{ old('username', $user->username) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $user->email) }}" placeholder="adresa@email.ro">
                    </div>
                </div>
                <div style="margin-top:1.25rem;">
                    <button type="submit" class="btn-primary-custom">Salvează profilul</button>
                </div>
            </form>
        </div>

        {{-- ══ TAB 2 — PAROLĂ ════════════════════════════ --}}
        <div id="tab-parola" class="account-tab glass-card" style="margin-bottom:1.5rem; display:none;">
            <h5 style="color:var(--text); font-family:'DM Sans',sans-serif; font-weight:400; font-size:15px; margin-bottom:1.25rem;">Schimbă parola</h5>
            <form method="POST" action="{{ route('account.parola') }}">
                @csrf @method('PATCH')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Parola curentă</label>
                        <input type="password" name="parola_curenta" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Parola nouă</label>
                        <input type="password" name="parola_noua" class="form-control" required minlength="6">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Confirmă parola</label>
                        <input type="password" name="parola_noua_confirmation" class="form-control" required>
                    </div>
                </div>
                <div style="margin-top:1.25rem;">
                    <button type="submit" class="btn-primary-custom">Schimbă parola</button>
                </div>
            </form>
        </div>

        {{-- ══ TAB 3 — FIRMA ═════════════════════════════ --}}
        <div id="tab-firma" class="account-tab glass-card" style="margin-bottom:1.5rem; display:none;">
            <h5 style="color:var(--text); font-family:'DM Sans',sans-serif; font-weight:400; font-size:15px; margin-bottom:1.25rem;">Datele firmei</h5>
            <p style="color:var(--text-muted); font-family:'DM Sans',sans-serif; font-weight:300; font-size:13px; margin-bottom:1.25rem;">
                Aceste date apar ca antet în PDF-ul registrului generat.
            </p>

            <form method="POST" action="{{ route('account.firma.save') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Denumire firmă *</label>
                        <input type="text" name="nume" class="form-control"
                               value="{{ old('nume', $firma?->nume) }}" required placeholder="PFA Ion Popescu">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">CUI</label>
                        <input type="text" name="cui" class="form-control"
                               value="{{ old('cui', $firma?->cui) }}" placeholder="RO12345678">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nr. Reg. Com. (J)</label>
                        <input type="text" name="nr_reg_com" class="form-control"
                               value="{{ old('nr_reg_com', $firma?->nr_reg_com) }}" placeholder="J40/123/2020">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Adresă</label>
                        <input type="text" name="adresa" class="form-control"
                               value="{{ old('adresa', $firma?->adresa) }}" placeholder="Str. Exemplu nr.1, București">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Bancă</label>
                        <input type="text" name="banca" class="form-control"
                               value="{{ old('banca', $firma?->banca) }}" placeholder="BCR / BRD / UniCredit...">
                    </div>
                    <div class="col-md-7">
                        <label class="form-label">IBAN</label>
                        <input type="text" name="iban" class="form-control"
                               value="{{ old('iban', $firma?->iban) }}" placeholder="RO49AAAA1B31007593840000">
                    </div>
                </div>
                <div style="margin-top:1.25rem;">
                    <button type="submit" class="btn-primary-custom">Salvează datele firmei</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
var activeTab = '{{ session('tab', 'profil') }}';
function switchTab(name) {
    document.querySelectorAll('.account-tab').forEach(function(el) { el.style.display = 'none'; });
    document.querySelectorAll('[id^="tab-btn-"]').forEach(function(btn) {
        btn.style.color = 'var(--text-muted)';
        btn.style.borderBottomColor = 'transparent';
    });
    var el = document.getElementById('tab-' + name);
    if (el) el.style.display = 'block';
    var btn = document.getElementById('tab-btn-' + name);
    if (btn) { btn.style.color = 'var(--accent)'; btn.style.borderBottomColor = 'var(--accent)'; }
}
switchTab(activeTab);
</script>
@endsection
