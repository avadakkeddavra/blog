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

        $faker =  Faker::create();

        for($i = 0; $i < 100; $i ++){
        	DB::table('posts')->insert([
                'id' => $i+1,
        		'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        		'text' => $faker->text,
        		'user_id' => $faker->numberBetween($min = 1, $max = 10),
        		'img' => asset('img/post_images').'/images.jpg',
        		'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null) 
        	]);
        }
    }
}
