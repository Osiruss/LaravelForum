<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ThreadTableSeeder extends Seeder
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
			$forums = \App\Forum::lists('id')->all();
			$faker = \Faker\Factory::create();

			foreach (range(1,200) as $index) {
				$user_id = $faker->randomElement($users);
				$thread = \App\Thread::create([
					'user_id'=>$user_id,
					'forum_id'=>$faker->randomElement($forums),
					'title' => $faker->sentence(6),
					'slug' => $faker->slug
					]);
			
				$text = $faker->paragraphs(mt_rand(1,5));
				$paragraphs = '';
				foreach ($text as $index=>$t) {
					$paragraphs .= $t;
					if ($index != count($text)-1) {
						$paragraphs .= "\n\n";
					}
				}

				\App\Post::create([
					'user_id' => $user_id,
					'thread_id' => $thread->id,
					'thread_first' => $thread->id,
					'post' => $paragraphs
					]);
			}
		
		Model::reguard();
	}
}
