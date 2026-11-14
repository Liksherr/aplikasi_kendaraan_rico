<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        return view('vehicles.index', [
            'vehicles' => $request->user()->vehicles()->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('vehicles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'plate_number' => ['required', 'string', 'max:20', Rule::unique('vehicles')->where('user_id', $request->user()->id)],
            'vehicle_type' => ['required', 'string', 'max:100'],
            'owner_name' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->vehicles()->create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    public function edit(Request $request, Vehicle $vehicle): View
    {
        $this->ensureOwner($request, $vehicle);

        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $this->ensureOwner($request, $vehicle);
        $validated = $request->validate([
            'plate_number' => ['required', 'string', 'max:20', Rule::unique('vehicles')->where('user_id', $request->user()->id)->ignore($vehicle->id)],
            'vehicle_type' => ['required', 'string', 'max:100'],
            'owner_name' => ['required', 'string', 'max:255'],
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $this->ensureOwner($request, $vehicle);
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Data kendaraan berhasil dihapus.');
    }

    private function ensureOwner(Request $request, Vehicle $vehicle): void
    {
        abort_unless($vehicle->user_id === $request->user()->id, 404);
    }
}
