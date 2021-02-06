<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create(['group'=>'Design']);
        Group::create(['group'=>'Web Development']);
        Group::create(['group'=>'Mobile App Development']);
        Group::create(['group'=>'Extraordinary Work Experiences']);
        Group::create(['group'=>'My Opinion on Tech']);
    }
}
