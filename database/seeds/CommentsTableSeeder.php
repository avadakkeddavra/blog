<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        $faker =  Faker::create();

        for($i = 0; $i < 100; $i ++){
            if($i%10 == 0){
                $parent_id = null;
            }else{
                 $parent_id = $faker->numberBetween($min = 1, $max = $i);
            }
        	DB::table('comments')->insert([
                'id' => $i+1,
        		'text' => $faker->text,
        		'user_id' => $faker->numberBetween($min = 1, $max = 10),
        		'post_id' => $faker->numberBetween($min = 1, $max = 10),
        		'parent_id' => $parent_id,
        		'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null) 
        	]);
        }
    }
}
