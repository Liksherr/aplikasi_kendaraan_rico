@extends('layouts.app')

@section('title', 'Tambah Kendaraan')

@section('content')
<div class="page-head"><div><h1>Tambah kendaraan</h1><p class="muted">Lengkapi identitas kendaraan.</p></div></div>
<section class="card form-card">
    <form method="post" action="{{ route('vehicles.store') }}">
        @csrf
        <label for="plate_number">Nomor polisi</label>
        <input id="plate_number" name="plate_number" value="{{ old('plate_number') }}" placeholder="Contoh: B 1234 ABC" required maxlength="20">
        <label for="vehicle_type">Jenis kendaraan</label>
        <input id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type') }}" placeholder="Contoh: Mobil, Motor" required maxlength="100">
        <label for="owner_name">Nama pemilik</label>
        <input id="owner_name" name="owner_name" value="{{ old('owner_name', auth()->user()->name) }}" required maxlength="255">
        <div class="form-actions"><button class="btn" type="submit">Simpan kendaraan</button><a class="btn secondary" href="{{ route('vehicles.index') }}">Batal</a></div>
    </form>
</section>
@endsection
