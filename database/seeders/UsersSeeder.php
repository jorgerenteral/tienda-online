<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'type' => 'admin',
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
        ];

        if (!User::whereEmail($admin['email'])->exists()) {
            User::create($admin);
        }

        foreach (range(3, 120) as $number) {
            User::factory(1)->hasPurchases(rand(5, 18))->create();
        }
    }
}
