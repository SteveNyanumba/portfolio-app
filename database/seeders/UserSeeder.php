<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Steve Nyanumba';
        $user->email = 'reach@stevenyanumba.com';
        $user->password = Hash::make(env('ADMIN_PASSWORD'));
        $user->is_admin = true;
        $user->profile_photo_path = 'images/admin/profile.jpg';

        $user->save();
    }
}
