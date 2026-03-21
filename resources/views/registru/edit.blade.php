@extends('layouts.app')

@section('title', 'Editeaza inregistrare - PFA Expenses')

@section('content')
<div style="max-width:700px;margin:0 auto;">
    <div class="glass-card">
        <h1 class="page-title" style="text-align:center;">Editeaza inregistrare</h1>

        @if($errors->any())
            <div class="alert-danger-custom">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('registru.update', $entry->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Data</label>
                <input type="date" class="form-control" name="data"
                    value="{{ old('data', $entry->data->format('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tip</label>
                <div class="d-flex gap-3">
                    <label style="cursor:pointer;display:flex;align-items:center;gap:0.5rem;">
                        <input type="radio" name="tip" value="incasare" {{ old('tip', $entry->tip) === 'incasare' ? 'checked' : '' }}>
                        <span>Incasare</span>
                    </label>
                    <label style="cursor:pointer;display:flex;align-items:center;gap:0.5rem;">
                        <input type="radio" name="tip" value="plata" {{ old('tip', $entry->tip) === 'plata' ? 'checked' : '' }}>
                        <span>Plata</span>
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Metoda</label>
                <div class="d-flex gap-3">
                    <label style="cursor:pointer;display:flex;align-items:center;gap:0.5rem;">
                        <input type="radio" name="metoda" value="numerar" {{ old('metoda', $entry->metoda) === 'numerar' ? 'checked' : '' }}>
                        <span>Numerar</span>
                    </label>
                    <label style="cursor:pointer;display:flex;align-items:center;gap:0.5rem;">
                        <input type="radio" name="metoda" value="banca" {{ old('metoda', $entry->metoda) === 'banca' ? 'checked' : '' }}>
                        <span>Banca</span>
                    </label>
                </div>
            </div>

            <div id="plata_fields" style="display:none;background:rgba(102,126,234,0.15);padding:1.25rem;border-radius:14px;border:1px solid rgba(102,126,234,0.3);margin-bottom:1rem;">
                <div class="mb-3">
                    <label class="form-label">Tip cheltuiala</label>
                    <select name="tip_cheltuiala" id="tip_cheltuiala" class="form-select" disabled>
                        <option value="diverse" {{ old('tip_cheltuiala', $entry->tip_cheltuiala) === 'diverse' ? 'selected' : '' }}>Diverse</option>
                        <option value="cincizeci_la_suta" {{ old('tip_cheltuiala', $entry->tip_cheltuiala) === 'cincizeci_la_suta' ? 'selected' : '' }}>50%</option>
                        <option value="rata_leasing" {{ old('tip_cheltuiala', $entry->tip_cheltuiala) === 'rata_leasing' ? 'selected' : '' }}>Rata leasing</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deductibilitate (%)</label>
                    <select name="deductibilitate" id="deductibilitate" class="form-select" disabled>
                        <option value="100" {{ old('deductibilitate', $entry->deductibilitate) == 100 ? 'selected' : '' }}>100%</option>
                        <option value="50" {{ old('deductibilitate', $entry->deductibilitate) == 50 ? 'selected' : '' }}>50%</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Document</label>
                <input type="text" class="form-control" name="document"
                    value="{{ old('document', $entry->document) }}" required>
            </div>

            <input type="hidden" name="valuta" value="{{ $entry->valuta }}">

            <div class="mb-3">
                <label class="form-label">Suma ({{ $entry->valuta }})</label>
                <input type="text" class="form-control" name="suma"
                    value="{{ old('suma', $entry->suma) }}" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn-primary-custom flex-grow-1" style="text-align:center;">Salveaza</button>
                <a href="{{ route('registru.index') }}" class="btn-edit-custom" style="display:flex;align-items:center;">Anuleaza</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePlataFields() {
    const isPlata = document.querySelector('input[name="tip"][value="plata"]')?.checked;
    const plataFields = document.getElementById('plata_fields');
    const tipCheltuiala = document.getElementById('tip_cheltuiala');
    const deductibilitate = document.getElementById('deductibilitate');

    if (isPlata) {
        plataFields.style.display = 'block';
        tipCheltuiala.disabled = false;
        deductibilitate.disabled = false;
    } else {
        plataFields.style.display = 'none';
        tipCheltuiala.disabled = true;
        deductibilitate.disabled = true;
    }
}

document.querySelectorAll('input[name="tip"]').forEach(el => {
    el.addEventListener('change', togglePlataFields);
});

togglePlataFields();
</script>
@endpush
