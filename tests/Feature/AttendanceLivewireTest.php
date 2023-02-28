<?php

namespace Tests\Feature;

use App\Http\Livewire\Attendance;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Livewire\Livewire;
use Tests\TestCase;

class AttendanceLivewireTest extends TestCase
{

    use DatabaseMigrations;

    public function testNotTimeOutWhenDateIsSame()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $carbon = now();

        $user->attendance()->create([
            'current_lat' => '24.2323423',
            'current_lng' => '67.2323423',
            'time'        => $carbon->format('h:i:s a'),
            'date'        => $carbon->format('Y-m-d'),
            'in'          => 1
        ]);

        $this->assertDatabaseCount('attendances', 1);

        Livewire::test(Attendance::class);

        $this->assertDatabaseCount('attendances', 1);
    }

    public function testTimeOutWhenDateIsNotSame()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $carbon = now()->subDay();

        $user->attendance()->create([
            'current_lat' => '24.2323423',
            'current_lng' => '67.2323423',
            'time'        => $carbon->format('h:i:s a'),
            'date'        => $carbon->format('Y-m-d'),
            'in'          => 1
        ]);

        $this->assertDatabaseCount('attendances', 1);

        Livewire::test(Attendance::class);

        $this->assertDatabaseCount('attendances', 2);
    }

}
