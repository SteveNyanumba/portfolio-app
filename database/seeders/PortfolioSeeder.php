<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 4; $i++) {
            Portfolio::create([
                'title'=>'Test Title'.$i,
                'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, laudantium veniam quos doloribus, earum dolores tenetur non veritatis',
                'link'=>'https://github.com/SteveNyanumba',
                'completion'=> Date('Y-m-d', strtotime('2020-11-'.$i)),
                'category_id'=> 3
            ]);
        }
    }
}
