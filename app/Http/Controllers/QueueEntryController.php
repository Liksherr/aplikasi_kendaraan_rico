<?php

namespace App\Http\Controllers;

use App\Models\QueueEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class QueueEntryController extends Controller
{
    public function index(Request $request): View
    {
        return view('queues.index', [
            'queues' => $request->user()->queueEntries()->with('vehicle')
                ->orderByDesc('queue_date')->orderBy('queue_time')->paginate(10),
        ]);
    }

    public function create(Request $request): View
    {
        return view('queues.create', [
            'vehicles' => $request->user()->vehicles()->orderBy('plate_number')->get(),
            'nextQueueNumber' => $this->nextQueueNumber($request),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateQueue($request);
        $request->user()->vehicles()->findOrFail($validated['vehicle_id']);
        $request->user()->queueEntries()->create($validated);

        return redirect()->route('queues.index')->with('success', 'Antrian berhasil ditambahkan.');
    }

    public function edit(Request $request, QueueEntry $queue): View
    {
        $this->ensureOwner($request, $queue);

        return view('queues.edit', [
            'queue' => $queue,
            'vehicles' => $request->user()->vehicles()->orderBy('plate_number')->get(),
        ]);
    }

    public function update(Request $request, QueueEntry $queue): RedirectResponse
    {
        $this->ensureOwner($request, $queue);
        $validated = $this->validateQueue($request, $queue);
        $request->user()->vehicles()->findOrFail($validated['vehicle_id']);
        $queue->update($validated);

        return redirect()->route('queues.index')->with('success', 'Data antrian berhasil diperbarui.');
    }

    public function destroy(Request $request, QueueEntry $queue): RedirectResponse
    {
        $this->ensureOwner($request, $queue);
        $queue->delete();

        return redirect()->route('queues.index')->with('success', 'Antrian berhasil dihapus.');
    }

    private function validateQueue(Request $request, ?QueueEntry $queue = null): array
    {
        $validated = $request->validate([
            'vehicle_id' => [
                'required',
                'integer',
                Rule::exists('vehicles', 'id')->where('user_id', $request->user()->id),
            ],
            'queue_number' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('queue_entries')->where('user_id', $request->user()->id)
                    ->where('queue_date', $request->input('queue_date'))->ignore($queue?->id),
            ],
            'queue_date' => ['required', 'date'],
            'queue_time' => ['required', 'date_format:H:i'],
            'status' => ['required', Rule::in(QueueEntry::STATUSES)],
        ]);

        return $validated;
    }

    private function nextQueueNumber(Request $request): int
    {
        return (int) $request->user()->queueEntries()->whereDate('queue_date', today())->max('queue_number') + 1;
    }

    private function ensureOwner(Request $request, QueueEntry $queue): void
    {
        abort_unless($queue->user_id === $request->user()->id, 404);
    }
}
