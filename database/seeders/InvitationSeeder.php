<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invitation;

class InvitationSeeder extends Seeder
{
    public function run()
    {
        Invitation::factory()->count(10)->create();
    }
}
