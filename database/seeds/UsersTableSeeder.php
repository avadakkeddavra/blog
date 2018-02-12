<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $faker =  Faker::create();

        for($i = 0; $i < 10; $i++){
        	DB::table('users')->insert([
        		'id' => $i+1,
        		'name' => $faker->name,
        		'email' => $faker->email,
                'img' => 'img/user.png',
        		'password' => $faker->password,
        		'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null) 
        	]);
        }
    }
}
