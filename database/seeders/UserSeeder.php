<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user1',
            'username' => 'user1',
            'password' => bcrypt('user1')
        ]);

        User::create([
            'name' => 'user2',
            'username' => 'user2',
            'password' => bcrypt('user2')
        ]);

        // $user_id_1 = User::where('username', 'user1')->first()->id;
        // $user_id_2 = User::where('username', 'user2')->first()->id;
        // Contact::create([

        // ]);
    }
}
