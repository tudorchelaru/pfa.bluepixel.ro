@extends('layouts.app')

@section('title', 'Schimba parola - Nuva.ro — Evidență financiară pentru profesioniști independenți')

@section('content')
<div style="max-width:500px;margin:0 auto;">
    <div class="glass-card">
        <h1 class="page-title" style="text-align:center;">Schimba parola</h1>

        @if($errors->any())
            <div class="alert-danger-custom">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('profile.change-password.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Parola curenta</label>
                <input type="password" class="form-control" name="current_password" required placeholder="••••••••">
            </div>

            <div class="mb-3">
                <label class="form-label">Parola noua</label>
                <input type="password" class="form-control" name="password" required placeholder="minim 6 caractere">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirma parola noua</label>
                <input type="password" class="form-control" name="password_confirmation" required placeholder="••••••••">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn-primary-custom flex-grow-1" style="text-align:center;">Salveaza parola</button>
                <a href="{{ route('dashboard') }}" class="btn-edit-custom" style="display:flex;align-items:center;">Anuleaza</a>
            </div>
        </form>
    </div>
</div>
@endsection
