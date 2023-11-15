<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::new()->count(20)->create();

        User::create([
            'id' => 21,
            'name' => '52',
            'email' => '52@gmail.com',
            'phone' => '525252525252',
            'password' => Hash::make('11111'),
        ]);
    }
}
