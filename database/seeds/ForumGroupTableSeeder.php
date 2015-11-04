<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ForumGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
        DB::table('forum_groups')->insert([
            'title' => 'Site news',
        ]);
        DB::table('forum_groups')->insert([
            'title' => 'General',
        ]);
        DB::table('forum_groups')->insert([
            'title' => 'Media',
        ]);
    }
}