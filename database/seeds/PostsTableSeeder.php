<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *image($dir = '/tmp', $width = 640, $height = 480)
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        DB::table('comments')->delete();
        $faker =  Faker::create();

        for($i = 0; $i < 100; $i ++){
        	DB::table('posts')->insert([
                'id' => $i+1,
        		'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        		'text' => $faker->text,
        		'user_id' => $faker->numberBetween($min = 1, $max = 10),
        		'img' => 'img/post_images/008ef7a.jpg',
        		'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null) 
        	]);
            for($j = 0; $j < 2; $j++)
            {
                if($j == 0)
                {
                    $parent_id = null;
                }else{
                    $parent_id = (($i+1)*2)-1;
                }
                $comment = DB::table('comments')->insert([
                    'text' => $faker->text,
                    'user_id' => $faker->numberBetween($min = 1, $max = 10),
                    'post_id' => $i+1,
                    'parent_id' => $parent_id,
                    'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null) 
                ]);
                
            }

        }
    }
}
