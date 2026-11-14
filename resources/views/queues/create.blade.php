@extends('layouts.app')

@section('title', 'Buat Antrian')

@section('content')
<div class="page-head"><div><h1>Buat antrian</h1><p class="muted">Nomor antrian berikutnya hari ini: {{ $nextQueueNumber }}.</p></div></div>
@if ($vehicles->isEmpty())
    <section class="card"><p>Tambahkan kendaraan sebelum membuat antrian.</p><a class="btn" href="{{ route('vehicles.create') }}">Tambah kendaraan</a></section>
@else
    <section class="card form-card">
        <form method="post" action="{{ route('queues.store') }}">
            @csrf
            <label for="vehicle_id">Kendaraan</label>
            <select id="vehicle_id" name="vehicle_id" required>
                <option value="">Pilih kendaraan</option>
                @foreach ($vehicles as $vehicle)<option value="{{ $vehicle->id }}" @selected(old('vehicle_id') == $vehicle->id)>{{ $vehicle->plate_number }} — {{ $vehicle->vehicle_type }} ({{ $vehicle->owner_name }})</option>@endforeach
            </select>
            <label for="queue_number">Nomor antrian</label>
            <input id="queue_number" name="queue_number" type="number" min="1" value="{{ old('queue_number', $nextQueueNumber) }}" required>
            <label for="queue_date">Tanggal</label>
            <input id="queue_date" name="queue_date" type="date" value="{{ old('queue_date', today()->toDateString()) }}" required>
            <label for="queue_time">Waktu</label>
            <input id="queue_time" name="queue_time" type="time" value="{{ old('queue_time', now()->format('H:i')) }}" required>
            <label for="status">Status antrian</label>
            <select id="status" name="status" required>@foreach (\App\Models\QueueEntry::STATUSES as $status)<option value="{{ $status }}" @selected(old('status', 'Menunggu') === $status)>{{ $status }}</option>@endforeach</select>
            <div class="form-actions"><button class="btn" type="submit">Simpan antrian</button><a class="btn secondary" href="{{ route('queues.index') }}">Batal</a></div>
        </form>
    </section>
@endif
@endsection
