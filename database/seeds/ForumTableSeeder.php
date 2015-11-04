<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ForumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
        DB::table('forums')->insert([
            'forum_group_id' => 1,
            'title' => 'Announcements',
            'slug' => 'announcements',
            'description' => $faker->realText(200)
        ]);
        DB::table('forums')->insert([
            'forum_group_id' => 2,
            'title' => 'Off-topic',
            'slug' => 'off-topic',
            'description' => $faker->realText(200)
        ]);
        DB::table('forums')->insert([
            'forum_group_id' => 2,
            'title' => 'News',
            'slug' => 'news',
            'description' => $faker->realText(200)
        ]);
        DB::table('forums')->insert([
            'forum_group_id' => 3,
            'title' => 'Gaming',
            'slug' => 'gaming',
            'description' => $faker->realText(200)
        ]);
        DB::table('forums')->insert([
            'forum_group_id' => 3,
            'title' => 'TV & Movies',
            'slug' => 'tv-movies',
            'description' => $faker->realText(200)
        ]);

    }
}