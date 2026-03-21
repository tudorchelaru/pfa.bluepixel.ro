@extends('layouts.app')
@section('title', 'Contul meu — PFA Expenses')

@section('content')
<div class="page-content">
    <div style="max-width:860px; margin:0 auto;">

        <h2 style="color:var(--text); font-weight:700; font-size:1.6rem; margin-bottom:1.75rem;">
            Contul meu
        </h2>

        {{-- ── Tab nav ────────────────────────────────── --}}
        @php $tab = session('tab', 'profil'); @endphp
        <div style="display:flex; gap:0.5rem; margin-bottom:1.5rem; border-bottom:1px solid var(--border); padding-bottom:0;">
            @foreach(['profil'=>'Profil', 'parola'=>'Parola', 'firme'=>'Firmele mele'] as $key=>$label)
            <button onclick="switchTab('{{ $key }}')" id="tab-btn-{{ $key }}"
                style="padding:0.6rem 1.25rem; border:none; background:none; font-weight:600; font-size:0.95rem;
                       cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-1px;
                       color:var(--text-muted); transition:color .2s, border-color .2s;">
                {{ $label }}
            </button>
            @endforeach
        </div>

        {{-- ── Mesaje globale ─────────────────────────── --}}
        @foreach(['success_profil','success_parola','success_firma'] as $msg)
            @if(session($msg))
            <div class="alert-success-custom">{{ session($msg) }}</div>
            @endif
        @endforeach

        @if($errors->any() && !session('tab'))
        <div class="alert-danger-custom">{{ $errors->first() }}</div>
        @endif

        {{-- ══════════════════════════════════════════════
             TAB 1 — PROFIL
        ══════════════════════════════════════════════════ --}}
        <div id="tab-profil" class="account-tab glass-card" style="margin-bottom:1.5rem;">
            <h5 style="color:var(--text); font-weight:700; margin-bottom:1.25rem;">Date profil</h5>

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

        {{-- ══════════════════════════════════════════════
             TAB 2 — PAROLĂ
        ══════════════════════════════════════════════════ --}}
        <div id="tab-parola" class="account-tab glass-card" style="margin-bottom:1.5rem; display:none;">
            <h5 style="color:var(--text); font-weight:700; margin-bottom:1.25rem;">Schimbă parola</h5>

            @if($errors->has('parola_curenta'))
            <div class="alert-danger-custom">{{ $errors->first('parola_curenta') }}</div>
            @endif

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

        {{-- ══════════════════════════════════════════════
             TAB 3 — FIRME
        ══════════════════════════════════════════════════ --}}
        <div id="tab-firme" class="account-tab" style="display:none;">

            {{-- Lista firme existente --}}
            @forelse($firme as $firma)
            <div class="glass-card" style="margin-bottom:1rem; position:relative;">
                {{-- Badge default --}}
                @if($firma->is_default)
                <span style="position:absolute; top:1rem; right:1rem;
                             background:rgba(59,130,246,0.18); border:1px solid rgba(59,130,246,0.4);
                             color:#93c5fd; font-size:0.72rem; font-weight:700;
                             padding:0.2rem 0.6rem; border-radius:20px;">
                    PRINCIPALĂ
                </span>
                @endif

                <details>
                    <summary style="cursor:pointer; list-style:none; color:var(--text);
                                    font-weight:700; font-size:1rem; padding-right:5rem;">
                        {{ $firma->nume }}
                        @if($firma->cui)
                            <span style="font-weight:400; color:var(--text-muted); font-size:0.85rem;">
                                — CUI {{ $firma->cui }}
                            </span>
                        @endif
                    </summary>

                    <div style="margin-top:1.25rem;">
                        <form method="POST" action="{{ route('account.firma.update', $firma) }}">
                            @csrf @method('PATCH')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Denumire firmă *</label>
                                    <input type="text" name="nume" class="form-control"
                                           value="{{ $firma->nume }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">CUI</label>
                                    <input type="text" name="cui" class="form-control"
                                           value="{{ $firma->cui }}" placeholder="RO12345678">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Nr. Reg. Com. (J)</label>
                                    <input type="text" name="nr_reg_com" class="form-control"
                                           value="{{ $firma->nr_reg_com }}" placeholder="J40/123/2020">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Adresă</label>
                                    <input type="text" name="adresa" class="form-control"
                                           value="{{ $firma->adresa }}" placeholder="Str. Exemplu nr.1, București">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Bancă</label>
                                    <input type="text" name="banca" class="form-control"
                                           value="{{ $firma->banca }}" placeholder="BCR / BRD / UniCredit...">
                                </div>
                                <div class="col-md-7">
                                    <label class="form-label">IBAN</label>
                                    <input type="text" name="iban" class="form-control"
                                           value="{{ $firma->iban }}" placeholder="RO49AAAA1B31007593840000">
                                </div>
                                <div class="col-12" style="display:flex; align-items:center; gap:0.5rem;">
                                    <input type="checkbox" name="is_default" id="def_{{ $firma->id }}"
                                           value="1" {{ $firma->is_default ? 'checked' : '' }}
                                           style="width:16px;height:16px;accent-color:var(--accent);">
                                    <label for="def_{{ $firma->id }}" class="form-label" style="margin:0; cursor:pointer;">
                                        Firmă principală (apare în antetul PDF)
                                    </label>
                                </div>
                            </div>
                            <div style="margin-top:1rem; display:flex; gap:0.75rem; flex-wrap:wrap;">
                                <button type="submit" class="btn-primary-custom" style="padding:0.5rem 1.25rem;">
                                    Salvează
                                </button>
                            </div>
                        </form>

                        <div style="margin-top:0.75rem; display:flex; gap:0.75rem; flex-wrap:wrap; border-top:1px solid var(--border); padding-top:0.75rem;">
                            @if(!$firma->is_default)
                            <form method="POST" action="{{ route('account.firma.default', $firma) }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    style="background:rgba(59,130,246,0.12); border:1px solid rgba(59,130,246,0.35);
                                           color:#93c5fd; border-radius:8px; padding:0.4rem 1rem;
                                           font-size:0.85rem; cursor:pointer;">
                                    Setează ca principală
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('account.firma.destroy', $firma) }}"
                                  onsubmit="return confirm('Ștergi firma {{ addslashes($firma->nume) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    style="background:var(--btn-logout-bg); border:1px solid var(--btn-logout-border);
                                           color:#fca5a5; border-radius:8px; padding:0.4rem 1rem;
                                           font-size:0.85rem; cursor:pointer;">
                                    Șterge firma
                                </button>
                            </form>
                        </div>
                    </div>
                </details>
            </div>
            @empty
            <div class="glass-card" style="text-align:center; padding:2rem; color:var(--text-muted); margin-bottom:1rem;">
                Nu ai adăugat nicio firmă încă. Adaugă una mai jos.
            </div>
            @endforelse

            {{-- Formular adaugă firmă nouă --}}
            <div class="glass-card" style="border:1px dashed var(--accent); margin-bottom:1.5rem;">
                <h6 style="color:var(--accent); font-weight:700; margin-bottom:1.25rem;">+ Adaugă firmă nouă</h6>

                <form method="POST" action="{{ route('account.firma.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Denumire firmă *</label>
                            <input type="text" name="nume" class="form-control"
                                   value="{{ old('nume') }}" required placeholder="PFA Ion Popescu">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">CUI</label>
                            <input type="text" name="cui" class="form-control"
                                   value="{{ old('cui') }}" placeholder="RO12345678">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nr. Reg. Com. (J)</label>
                            <input type="text" name="nr_reg_com" class="form-control"
                                   value="{{ old('nr_reg_com') }}" placeholder="J40/123/2020">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Adresă</label>
                            <input type="text" name="adresa" class="form-control"
                                   value="{{ old('adresa') }}" placeholder="Str. Exemplu nr.1, București">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Bancă</label>
                            <input type="text" name="banca" class="form-control"
                                   value="{{ old('banca') }}" placeholder="BCR / BRD / UniCredit...">
                        </div>
                        <div class="col-md-7">
                            <label class="form-label">IBAN</label>
                            <input type="text" name="iban" class="form-control"
                                   value="{{ old('iban') }}" placeholder="RO49AAAA1B31007593840000">
                        </div>
                        <div class="col-12" style="display:flex; align-items:center; gap:0.5rem;">
                            <input type="checkbox" name="is_default" id="new_default"
                                   value="1" {{ $firme->isEmpty() ? 'checked' : '' }}
                                   style="width:16px;height:16px;accent-color:var(--accent);">
                            <label for="new_default" class="form-label" style="margin:0; cursor:pointer;">
                                Firmă principală (apare în antetul PDF)
                            </label>
                        </div>
                    </div>
                    <div style="margin-top:1.25rem;">
                        <button type="submit" class="btn-primary-custom">Adaugă firma</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
var activeTab = '{{ session('tab', 'profil') }}';

function switchTab(name) {
    document.querySelectorAll('.account-tab').forEach(function(el) {
        el.style.display = 'none';
    });
    document.querySelectorAll('[id^="tab-btn-"]').forEach(function(btn) {
        btn.style.color = 'var(--text-muted)';
        btn.style.borderBottomColor = 'transparent';
    });
    var el = document.getElementById('tab-' + name);
    if (el) el.style.display = 'block';
    var btn = document.getElementById('tab-btn-' + name);
    if (btn) {
        btn.style.color = 'var(--accent)';
        btn.style.borderBottomColor = 'var(--accent)';
    }
    activeTab = name;
}

switchTab(activeTab);
</script>
@endsection
