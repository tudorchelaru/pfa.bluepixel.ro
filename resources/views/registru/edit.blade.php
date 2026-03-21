@extends('layouts.app')

@section('title', 'Editeaza inregistrare - PFA Expenses')

@section('content')
<div style="max-width:700px;margin:0 auto;">
    <div class="glass-card">
        <h1 class="page-title" style="text-align:center;">Editeaza inregistrare</h1>

        @if($errors->any())
            <div class="alert-danger-custom">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('registru.update', $entry->id) }}" enctype="multipart/form-data">
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

            <div id="plata_fields" class="plata-fields-box" style="display:none;">
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

            <div class="mb-3">
                <label class="form-label">Bon / Factura (optional)</label>
                <div style="border:1px dashed var(--border-input);border-radius:12px;padding:1rem;background:var(--bg-input);">
                    @if($entry->bon_imagine)
                        <div id="bon_existent" style="text-align:center;margin-bottom:0.75rem;">
                            @if($entry->bon_mime === 'application/pdf')
                                <a href="{{ route('registru.bon', $entry->id) }}" target="_blank"
                                   style="display:inline-flex;flex-direction:column;align-items:center;gap:0.5rem;text-decoration:none;color:var(--badge-plata-text);background:var(--badge-plata-bg);border:1px solid var(--badge-plata-border);border-radius:10px;padding:1rem 2rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="rgba(255,100,100,0.9)" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/></svg>
                                    <span style="font-size:0.82rem;color:var(--text-muted);">Document PDF existent — click pentru a deschide</span>
                                </a>
                            @else
                                <img src="{{ route('registru.bon', $entry->id) }}" alt="Bon existent"
                                    style="max-width:100%;max-height:220px;border-radius:8px;object-fit:contain;">
                                <p style="color:var(--text-muted);font-size:0.8rem;margin-top:0.4rem;">Poza existenta</p>
                            @endif
                        </div>
                        <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;margin-bottom:0.75rem;">
                            <input type="checkbox" name="sterge_bon" value="1" onchange="toggleStergeBon(this)">
                            <span style="font-size:0.88rem;color:var(--badge-plata-text);">Sterge {{ $entry->bon_mime === 'application/pdf' ? 'documentul' : 'poza' }} existent</span>
                        </label>
                    @endif
                    <div class="d-flex gap-2 mb-2 flex-wrap">
                        <label class="btn-edit-custom" style="cursor:pointer;display:flex;align-items:center;gap:0.4rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/></svg>
                            Camera
                            <input type="file" id="bon_camera" accept="image/*" capture="environment" style="display:none;" onchange="cameraSelected(this)">
                        </label>
                        <label class="btn-edit-custom" style="cursor:pointer;display:flex;align-items:center;gap:0.4rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/></svg>
                            Incarca fisier
                            <input type="file" id="bon_fisier" name="bon_imagine" accept="image/*,application/pdf,.pdf" style="display:none;" onchange="previewBon(this)">
                        </label>
                    </div>
                    <div id="bon_preview" style="display:none;text-align:center;">
                        <img id="bon_img" src="" alt="Preview bon" style="max-width:100%;max-height:250px;border-radius:8px;object-fit:contain;">
                        <div style="margin-top:0.5rem;">
                            <button type="button" onclick="stergeBon()" style="background:rgba(220,53,69,0.3);border:1px solid rgba(220,53,69,0.5);color:#fff;padding:0.25rem 0.75rem;border-radius:6px;cursor:pointer;font-size:0.85rem;">Anuleaza selectia</button>
                        </div>
                    </div>
                    <div id="bon_pdf_preview" style="display:none;text-align:center;padding:1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="rgba(255,100,100,0.8)" viewBox="0 0 16 16"><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/></svg>
                        <p id="bon_pdf_name" style="margin:0.5rem 0 0;font-size:0.85rem;color:rgba(255,255,255,0.8);"></p>
                        <button type="button" onclick="stergeBon()" style="margin-top:0.5rem;background:rgba(220,53,69,0.3);border:1px solid rgba(220,53,69,0.5);color:#fff;padding:0.25rem 0.75rem;border-radius:6px;cursor:pointer;font-size:0.85rem;">Anuleaza selectia</button>
                    </div>
                    <p id="bon_hint" style="color:var(--text-muted);font-size:0.82rem;margin:0;">{{ $entry->bon_imagine ? 'Incarca o poza noua sau un PDF pentru a-l inlocui.' : 'Fa o poza cu camera, incarca o imagine sau un PDF.' }}</p>
                </div>
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

// bon_fisier are name="bon_imagine" - se trimite direct, fara copiere
function previewBon(input) {
    if (!input.files || !input.files[0]) return;
    const stergeBonCb = document.querySelector('input[name="sterge_bon"]');
    if (stergeBonCb) stergeBonCb.checked = false;
    showPreview(input.files[0]);
}

function cameraSelected(camInput) {
    if (!camInput.files || !camInput.files[0]) return;
    const file = camInput.files[0];
    const dt = new DataTransfer();
    dt.items.add(file);
    document.getElementById('bon_fisier').files = dt.files;
    const stergeBonCb = document.querySelector('input[name="sterge_bon"]');
    if (stergeBonCb) stergeBonCb.checked = false;
    showPreview(file);
}

function showPreview(file) {
    document.getElementById('bon_hint').style.display = 'none';
    if (file.type === 'application/pdf') {
        document.getElementById('bon_preview').style.display = 'none';
        document.getElementById('bon_pdf_preview').style.display = 'block';
        document.getElementById('bon_pdf_name').textContent = file.name;
    } else {
        document.getElementById('bon_pdf_preview').style.display = 'none';
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('bon_img').src = e.target.result;
            document.getElementById('bon_preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

function stergeBon() {
    document.getElementById('bon_fisier').value = '';
    document.getElementById('bon_camera').value = '';
    document.getElementById('bon_preview').style.display = 'none';
    document.getElementById('bon_pdf_preview').style.display = 'none';
    document.getElementById('bon_hint').style.display = 'block';
}

function toggleStergeBon(cb) {
    if (cb.checked) {
        // Daca sterge, resetam selectia noua
        stergeBon();
    }
    const bonExistent = document.getElementById('bon_existent');
    if (bonExistent) {
        bonExistent.style.opacity = cb.checked ? '0.3' : '1';
    }
}
</script>
@endpush
