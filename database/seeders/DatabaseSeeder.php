<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\UserSeeder;
use Database\Seeders\ConnectionSeeder;
use Database\Seeders\InvitationSeeder;

use Database\Seeders\ConnectionsInCommonSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserSeeder::class);
        // $this->call(ConnectionSeeder::class);
        // $this->call(InvitationSeeder::class);
    }
}
