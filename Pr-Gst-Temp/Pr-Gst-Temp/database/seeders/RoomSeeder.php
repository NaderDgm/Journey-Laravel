<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $rooms = [

            ['name' => 'A1', 'location' => 'Bâtiment A - Étage 1'],
            ['name' => 'A2', 'location' => 'Bâtiment A - Étage 1'],
            ['name' => 'A3', 'location' => 'Bâtiment A - Étage 2'],
            ['name' => 'A4', 'location' => 'Bâtiment A - Étage 2'],

            ['name' => 'B1', 'location' => 'Bâtiment B - Étage 1'],
            ['name' => 'B2', 'location' => 'Bâtiment B - Étage 1'],
            ['name' => 'B3', 'location' => 'Bâtiment B - Étage 2'],
            ['name' => 'B4', 'location' => 'Bâtiment B - Étage 2'],

            ['name' => 'C1', 'location' => 'Bâtiment C - Étage 1'],
            ['name' => 'C2', 'location' => 'Bâtiment C - Étage 1'],
            ['name' => 'C3', 'location' => 'Bâtiment C - Étage 2'],
            ['name' => 'C4', 'location' => 'Bâtiment C - Étage 2'],

            ['name' => 'D1', 'location' => 'Bâtiment D - Étage 1'],
            ['name' => 'D2', 'location' => 'Bâtiment D - Étage 1'],
            ['name' => 'D3', 'location' => 'Bâtiment D - Étage 2'],
            ['name' => 'D4', 'location' => 'Bâtiment D - Étage 2'],

            ['name' => 'E1', 'location' => 'Bâtiment E - Étage 1'],
            ['name' => 'E2', 'location' => 'Bâtiment E - Étage 1'],
            ['name' => 'E3', 'location' => 'Bâtiment E - Rez-de-chaussée'],
            ['name' => 'E4', 'location' => 'Bâtiment E - Rez-de-chaussée'],

            ['name' => 'F1', 'location' => 'Bâtiment F - Étage 1'],
            ['name' => 'F2', 'location' => 'Bâtiment F - Étage 1'],
            ['name' => 'F3', 'location' => 'Bâtiment F - Étage 2'],

            ['name' => 'G1', 'location' => 'Bâtiment G - Étage 1'],
            ['name' => 'G2', 'location' => 'Bâtiment G - Étage 1'],

            ['name' => 'H1', 'location' => 'Bâtiment H - Étage 1'],
            ['name' => 'H2', 'location' => 'Bâtiment H - Étage 1'],

            ['name' => 'I1', 'location' => 'Bâtiment I - Étage 1'],
            ['name' => 'I2', 'location' => 'Bâtiment I - Étage 1'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}