<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleTableSeeder extends Seeder
{
    public function run()
    {
        $roles = Role::all();

        $user1 = User::find(1);
        $user1->roles()->attach(1);

        $user2 = User::find(2);
        $user2->roles()->attach(2);
    }
}
