<?php

namespace Tests\Feature;

use App\Models\QueueEntry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleQueueTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_access_the_dashboard(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Pemilik Kendaraan',
            'email' => 'pemilik@example.test',
            'password' => 'password-rahasia',
            'password_confirmation' => 'password-rahasia',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
        $this->get(route('dashboard'))->assertOk()->assertSee('Pemilik Kendaraan');
    }

    public function test_user_can_manage_vehicles_and_queue_entries_and_download_reports(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('vehicles.store'), [
            'plate_number' => 'B 1234 ABC',
            'vehicle_type' => 'Mobil',
            'owner_name' => 'Pemilik Kendaraan',
        ])->assertRedirect(route('vehicles.index'));

        $vehicle = $user->vehicles()->firstOrFail();
        $this->assertSame($user->id, $vehicle->user_id);
        $this->get(route('vehicles.index'))->assertOk()->assertSee('B 1234 ABC');

        $this->post(route('queues.store'), [
            'vehicle_id' => $vehicle->id,
            'queue_number' => 1,
            'queue_date' => today()->toDateString(),
            'queue_time' => '09:30',
            'status' => 'Menunggu',
        ])->assertRedirect(route('queues.index'));

        $queue = $user->queueEntries()->firstOrFail();
        $this->assertSame($vehicle->id, $queue->vehicle_id);
        $this->get(route('queues.index'))->assertOk()->assertSee('B 1234 ABC')->assertSee('Menunggu');
        $this->get(route('reports.vehicles'))->assertOk()->assertHeader('content-type', 'application/pdf');
        $this->get(route('reports.queues'))->assertOk()->assertHeader('content-type', 'application/pdf');

        $this->put(route('queues.update', $queue), [
            'vehicle_id' => $vehicle->id,
            'queue_number' => 1,
            'queue_date' => today()->toDateString(),
            'queue_time' => '10:15',
            'status' => 'Diproses',
        ])->assertRedirect(route('queues.index'));

        $this->put(route('vehicles.update', $vehicle), [
            'plate_number' => 'B 5678 DEF',
            'vehicle_type' => 'Mobil',
            'owner_name' => 'Pemilik Baru',
        ])->assertRedirect(route('vehicles.index'));

        $this->delete(route('queues.destroy', $queue))->assertRedirect(route('queues.index'));
        $this->delete(route('vehicles.destroy', $vehicle))->assertRedirect(route('vehicles.index'));
        $this->assertDatabaseMissing('vehicles', ['id' => $vehicle->id]);
        $this->assertDatabaseMissing('queue_entries', ['id' => $queue->id]);
    }

    public function test_users_cannot_access_another_users_vehicle_or_queue(): void
    {
        $owner = User::factory()->create();
        $vehicle = $owner->vehicles()->create([
            'plate_number' => 'D 1 ABC',
            'vehicle_type' => 'Motor',
            'owner_name' => $owner->name,
        ]);
        $queue = $owner->queueEntries()->create([
            'vehicle_id' => $vehicle->id,
            'queue_number' => 1,
            'queue_date' => today()->toDateString(),
            'queue_time' => '08:00',
            'status' => QueueEntry::STATUSES[0],
        ]);

        $this->actingAs(User::factory()->create());

        $this->get(route('vehicles.edit', $vehicle))->assertNotFound();
        $this->get(route('queues.edit', $queue))->assertNotFound();
        $this->post(route('queues.store'), [
            'vehicle_id' => $vehicle->id,
            'queue_number' => 2,
            'queue_date' => today()->toDateString(),
            'queue_time' => '08:30',
            'status' => 'Menunggu',
        ])->assertSessionHasErrors('vehicle_id');
    }
}
