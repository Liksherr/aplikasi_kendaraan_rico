@extends('layouts.app')

@section('title', 'Ubah Antrian')

@section('content')
<div class="page-head"><div><h1>Ubah antrian #{{ $queue->queue_number }}</h1><p class="muted">Perbarui jadwal, kendaraan, atau status.</p></div></div>
<section class="card form-card">
    <form method="post" action="{{ route('queues.update', $queue) }}">
        @csrf @method('PUT')
        <label for="vehicle_id">Kendaraan</label>
        <select id="vehicle_id" name="vehicle_id" required>
            @foreach ($vehicles as $vehicle)<option value="{{ $vehicle->id }}" @selected(old('vehicle_id', $queue->vehicle_id) == $vehicle->id)>{{ $vehicle->plate_number }} — {{ $vehicle->vehicle_type }} ({{ $vehicle->owner_name }})</option>@endforeach
        </select>
        <label for="queue_number">Nomor antrian</label>
        <input id="queue_number" name="queue_number" type="number" min="1" value="{{ old('queue_number', $queue->queue_number) }}" required>
        <label for="queue_date">Tanggal</label>
        <input id="queue_date" name="queue_date" type="date" value="{{ old('queue_date', $queue->queue_date->toDateString()) }}" required>
        <label for="queue_time">Waktu</label>
        <input id="queue_time" name="queue_time" type="time" value="{{ old('queue_time', substr($queue->queue_time, 0, 5)) }}" required>
        <label for="status">Status antrian</label>
        <select id="status" name="status" required>@foreach (\App\Models\QueueEntry::STATUSES as $status)<option value="{{ $status }}" @selected(old('status', $queue->status) === $status)>{{ $status }}</option>@endforeach</select>
        <div class="form-actions"><button class="btn" type="submit">Simpan perubahan</button><a class="btn secondary" href="{{ route('queues.index') }}">Batal</a></div>
    </form>
</section>
@endsection
