<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            $faker = \Faker\Factory::create();

            foreach (range(1,50) as $index) {
                $user = \App\User::create([
                    'username' => str_replace('.', ' ', $faker->username),
                    'email' => $faker->email,
                    'password' => bcrypt('password'),
                    'remember_token' => str_random(10)
                    ]);
                \App\Profile::create([
                    'user_id'=>$user->id
                    ]);
            };
        
        Model::reguard();
    }
}