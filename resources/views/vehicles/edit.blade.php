@extends('layouts.app')

@section('title', 'Ubah Kendaraan')

@section('content')
<div class="page-head"><div><h1>Ubah kendaraan</h1><p class="muted">Perbarui informasi kendaraan {{ $vehicle->plate_number }}.</p></div></div>
<section class="card form-card">
    <form method="post" action="{{ route('vehicles.update', $vehicle) }}">
        @csrf @method('PUT')
        <label for="plate_number">Nomor polisi</label>
        <input id="plate_number" name="plate_number" value="{{ old('plate_number', $vehicle->plate_number) }}" required maxlength="20">
        <label for="vehicle_type">Jenis kendaraan</label>
        <input id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type', $vehicle->vehicle_type) }}" required maxlength="100">
        <label for="owner_name">Nama pemilik</label>
        <input id="owner_name" name="owner_name" value="{{ old('owner_name', $vehicle->owner_name) }}" required maxlength="255">
        <div class="form-actions"><button class="btn" type="submit">Simpan perubahan</button><a class="btn secondary" href="{{ route('vehicles.index') }}">Batal</a></div>
    </form>
</section>
@endsection
