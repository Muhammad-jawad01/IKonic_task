<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\Invitation;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => 'ali' . rand(1, 3000),
                'email' => 'admin' . rand(1, 100000) . '@admin.com',
                'password' => bcrypt('password'),
            ]);

            array_push($users, $user);
        }

        $min = 0;
        $max = 9;

        foreach ($users as $user) {
            // Get an array of user ids excluding the current user's id
            $availableUserIds = array_diff(array_column($users, 'id'), [$user->id]);

            // Get a random invited_user_id from the availableUserIds
            $invitedUserId = $availableUserIds[array_rand($availableUserIds)];

            // Create an invitation
            Invitation::create([
                'user_id' => $user->id,
                'invited_user_id' => $invitedUserId,
            ]);

            // Get an array of user ids excluding the current user's id and the already selected invited_user_id
            $availableConnectionIds = array_diff($availableUserIds, [$invitedUserId]);

            // Get a random connected_user_id from the availableConnectionIds
            $connectedUserId = $availableConnectionIds[array_rand($availableConnectionIds)];

            // Create a connection
            Connection::create([
                'user_id' => $user->id,
                'connected_user_id' => $connectedUserId,
            ]);
        }
    }
}
