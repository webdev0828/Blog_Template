<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder {

    public function run() {
        User::create(array('name' => 'admin', 'email' => 'admin@gmail.com', 'password' => '12345678', 'role' => 'admin'));
    }

}