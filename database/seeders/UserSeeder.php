<?php

namespace Database\Seeders;

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
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('admin')
        ]);

        User::create([
            'name' => 'admin2',
            'username' => 'admin2',
            'password' => bcrypt('admin2')
        ]);

        User::create([
            'name' => 'admin3',
            'username' => 'admin3',
            'password' => bcrypt('admin3')
        ]);

        User::create([
            'name' => 'admin4',
            'username' => 'admin4',
            'password' => bcrypt('admin4')
        ]);
    }
}
