<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        	$users = \App\User::lists('id')->all();
        	$threads = \App\Thread::lists('id')->all();
        	$faker = \Faker\Factory::create();

        	foreach (range(1,500) as $index) {
				$text = $faker->paragraphs(mt_rand(1,5));
				$paragraphs = '';
				foreach ($text as $index=>$t) {
					$paragraphs .= $t;
					if ($index != count($text)-1) {
						$paragraphs .= "\n\n";
					}
				}
		       	\App\Post::create([
			        'user_id' => $faker->randomElement($users),
			        'thread_id' => $faker->randomElement($threads),
			        'post' => $paragraphs
	        		]);
        	}

        Model::reguard();
    }
}
