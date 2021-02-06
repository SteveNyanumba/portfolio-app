<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 4; $i++) {
            Blog::create([
                'title'=>'Test Title'.$i,
                'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, laudantium veniam quos doloribus, earum dolores tenetur non veritatis',
                'image'=>'default.png',
                'group_id'=> 2
            ]);
        }
    }
}
